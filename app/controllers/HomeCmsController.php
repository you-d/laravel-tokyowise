<?php

class HomeCmsController extends HomeController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// home-cms.blade.php
				$output = 'home-cms';
				break;
		}
		
		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'homeCms';
	}
	/* Shows public/cms/home-cms.blade.php */
	public function homeCms() {
		// Get the setting value for this page	
		$this->getXmlConfig($this->getXmlNodeLabel());
		
		// For the headlines section, populate the headlineEntries array
		$headlineEntries = array();
		parent::populateHeadlineEntriesArray($headlineEntries);
		
		// [CMS] Get the date & time of the most recent change on the header image section
		// in the xml config file
		$headerImgLastUpdate = $this->xmlOutputArray["headerImgLastUpdate"];
		// [CMS] Get all type of categories in this site together with each category's
		// members. (Limit 10 posts for each category)
		$cmsHeadlineCategories = array("Features", "Rensai", "News", "Gadgets");
		
		$cmsHeadlineFeaturesPosts = array();
		$cmsHeadlineRensaiPosts = array();
		$cmsHeadlineNewsPosts = array();
		$cmsHeadlineGadgetsPosts = array();
		$this->handleCmsHeadlinePosts($cmsHeadlineFeaturesPosts,
									  $cmsHeadlineRensaiPosts,
									  $cmsHeadlineNewsPosts,
									  $cmsHeadlineGadgetsPosts);
		
		// For the features section, grab most recent posts from the latest category
		$featureCategory = parent::featureCategoryDbQuery();
		$featurePosts = parent::featurePostsDbQuery();					 
		
		$viewFile = $this->getCmsViewFolder() . $this->getViewName("hub");
		return View::make($viewFile)->with('featureCategory', $featureCategory)
									->with('featurePosts', $featurePosts)
									->with('headlineEntries', $headlineEntries)
									->with('wideHeaderImg', $this->xmlOutputArray["wideHeaderImg"])
									->with('narrowHeaderImg', $this->xmlOutputArray["narrowHeaderImg"])
									->with('headerImgLastUpdate', $headerImgLastUpdate)
									->with('newsModuleEntries', $this->getNewsModuleEntries())
									->with('rensaiModuleEntries', $this->getRensaiModuleEntries())
									->with('gadgetsModuleEntries', $this->getGadgetsModuleEntries())
									->with('cmsHeadlineCategories', $cmsHeadlineCategories)
									->with('cmsHeadlineFeaturesPosts', $cmsHeadlineFeaturesPosts)
									->with('cmsHeadlineRensaiPosts', $cmsHeadlineRensaiPosts)
									->with('cmsHeadlineNewsPosts', $cmsHeadlineNewsPosts)
									->with('cmsHeadlineGadgetsPosts', $cmsHeadlineGadgetsPosts);
	}
	/* Handle POST */
	public function postHomeCms() {
		switch (Input::get("category")) {
			case "home-header-img":
				$this->handleHomeHeaderImgSubmission();
				break;
			case "home-headline-0":
				$this->handleHomeHeadlineSubmission("0");
				break;
			case "home-headline-1":
				$this->handleHomeHeadlineSubmission("1");
				break;	
			case "home-headline-2":
				$this->handleHomeHeadlineSubmission("2");
				break;	
			case "home-headline-3":
				$this->handleHomeHeadlineSubmission("3");
				break;	
			case "home-headline-4":
				$this->handleHomeHeadlineSubmission("4");
				break;	
			case "home-features-highlight":
				// Note : 
				// Features highlight will always show the latest volume. Therefore,
				// we can only change the number of displayed entries from the cms panel
				// of this column. 
				$this->setXmlConfig("home", "features-highlight", intval(Input::get("arg1")));
				Cache::forget('home-featurePosts');
				
				break;
			case "home-news-module":
				$this->setXmlConfig("home", "news", intval(Input::get("arg1")));
				Cache::forget('module-news');
				
				break;
			case "home-rensai-module":
				$this->setXmlConfig("home", "rensai", intval(Input::get("arg1")));
				Cache::forget('module-rensai');
				
				break;
			case "home-gadgets-module":
				$this->setXmlConfig("home", "gadgets", intval(Input::get("arg1")));
				Cache::forget('module-gadgets');
				
				break;			
		}
	}
	private function handleCmsHeadlinePosts(&$cmsHeadlineFeaturesPosts,
											&$cmsHeadlineRensaiPosts,
											&$cmsHeadlineNewsPosts,
											&$cmsHeadlineGadgetsPosts) {
		$postRecordLimit = 10;
		// Features
		$cmsHeadlineFeaturesPosts = DB::table('feature_post')->
										join('feature_category', 
											 'feature_post.category_id', '=', 'feature_category.id')->
										select('feature_post.id', 
											   'feature_post.post_title', 
											   'feature_category.category_name')->
										orderBy('feature_post.id', 'desc')->
										take($postRecordLimit)->
										get();									 
		// Rensai
		$cmsHeadlineRensaiPosts = DB::table('rensai_post')->
										join('rensai_category', 
											 'rensai_post.category_id', '=', 'rensai_category.id')->
										select('rensai_post.id', 
											   'rensai_post.post_title', 
											   'rensai_category.category_name')->
										orderBy('rensai_post.id', 'desc')->
										take($postRecordLimit)->
										get();	
		// News
		$cmsHeadlineNewsPosts = DB::table('news_post')->
										select('id', 'post_title')->
						  				orderBy('id', 'desc')->
						  				take($postRecordLimit)->
						  				get();		
		// Gadgets
		$cmsHeadlineGadgetsPosts = DB::table('gadgets_post')->
										select('id', 'post_title')->
						  				orderBy('id', 'desc')->
						  				take($postRecordLimit)->
						  				get();			
	}
	private function handleHomeHeadlineSubmission($idx) {
		// $param[0] = headline idx , $param[1] = record type , $param[2] = record id
		$dissectedArg = explode(" ", Input::get("arg1"));
		$param = array($idx, $dissectedArg[0], $dissectedArg[1]);
		$this->setXmlConfig("home", "headline", $param);
		Cache::forget('home-headlineEntries');
	}
	private function handleHomeHeaderImgSubmission() {
		$wideHeaderImg = Input::file("wide-img-input");
		$narrowHeaderImg = Input::file("narrow-img-input");
		// Validate Inputs
		$messages = array('wide-img-input.required' => '<b>[Wide Image]</b> This field is required.',
						  'narrow-img-input.required' => '<b>[Narrow Image]</b> This field is required.',
						  'wide-img-input.image' => '<b>[Wide Image]</b> File format is not recognisable.',
						  'narrow-img-input.image' => '<b>[Narrow Image]</b> File format is not recognisable.',
						  'wide-img-input.mimes' => '<b>[Wide Image]</b> Accepted image extension : png, jpg, jpeg.',
						  'narrow-img-input.mimes' => '<b>[Narrow Image]</b> Accepted image extension : png, jpg, jpeg.',
						  'wide-img-input.max' => '<b>[Wide Image]</b> Maximum image size must not exceed 3Mb',
						  'narrow-img-input.max' => '<b>[Narrow Image]</b> Maximum image size must not exceed 3Mb',);
		$inputs = array('wide-img-input' => $wideHeaderImg,
					   'narrow-img-input' => $narrowHeaderImg);				
		$rules = array(
			"wide-img-input" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								 max: 3072', 
			"narrow-img-input" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								   max: 3072' 
		);
		// 'custom_required_img_dimension:776,116' 
		// 'custom_required_img_dimension:641,230' 
		$validator = Validator::make($inputs, $rules, $messages);
		if ($validator->fails()) {
			echo 'Error:';
			echo '<ul>';
			foreach ($validator->errors()->all() as $message) {
				echo '<li> - ' . $message . '</li>';
			}
			echo '</ul>';
		} else {
			// Move the uploaded file into the public/images/home/ folder
			// Note : To save the valuable space, the current images will be overwritten by these newly
			// uploaded images. 
			$destinationPath = public_path().sprintf("/images/home");
			$wideHeaderImg->move($destinationPath, 'header-img-featurevol6.' . $wideHeaderImg->getClientOriginalExtension());
			$narrowHeaderImg->move($destinationPath, 'header-img-featurevol6-sp.' . $wideHeaderImg->getClientOriginalExtension());
			// Update the last update label
			$param = date("d/m/Y - h:i:s a");
			$this->setXmlConfig("home", "headerimg", $param);
			echo 'ok';
		}
	} 
}