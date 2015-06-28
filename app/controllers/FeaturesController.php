<?php

class FeaturesController extends BaseController {	
	/* view file name */
	public function getViewName($pageType) {
		switch($pageType) {
			case "hub" :
				// features.blade.php
				$output = 'features';
				break;
			case "post" :
				// features-post.blade.php
				$output = 'features-post';
				break;		
		}
		
		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'features';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><features></features></tokyowise>
		return 'features';
	}
	/* Shows features.blade.php */
	public function features() {
		// Data fetching operations
		if (Cache::has('features-featureCategories')) {
			$featureCategories = Cache::get('features-featureCategories');	
		} else {
			$featureCategories = $this->featuresPageFeaturesCategoriesDbQuery();
			Cache::add('features-featureCategories', $featureCategories, $this->cacheTimeLimit);
		}	
		if (Cache::has('features-featurePosts')) {
			$featurePosts = Cache::get('features-featurePosts');
		} else {
			$featurePosts = $this->featuresPageFeaturesPostsDbQuery();
			Cache::add('features-featurePosts', $featurePosts, $this->cacheTimeLimit);
		}
		
		// Get the setting value for this page										
		$this->getXmlConfig($this->getXmlNodeLabel());	
		
		// The Features page has Rensai, News, & Gadgets modules on its page. 	
		return View::make( $this->getViewName("hub") )->with('featureCategories', $featureCategories)
											     	  ->with('featurePosts', $featurePosts)
											     	  ->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
									  	  		 	  ->with('newsModuleEntries',$this->getNewsModuleEntries())
									  	  		 	  ->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());	
	}
	/* Shows features-post.blade.php */
	public function featuresPost($postId) {		
		// url validation
		if (FeaturePost::where('post_id', '=', $postId)->count() == 0) {
			return Redirect::route($this->getAlias());
		}
		// Data fetching operations
		if (Cache::has('features-post-featurePost' . $postId)) {
			$featurePost = Cache::get('features-post-featurePost' . $postId);
		} else {
			$featurePost = FeaturePost::where('post_id', '=', $postId)->first();
			Cache::add('features-post-featurePost' . $postId, $featurePost, $this->cacheTimeLimit);
		}
		if (Cache::has('features-post-featureCategory' . $postId)) {
			$featureCategory = Cache::get('features-post-featureCategory' . $postId);
		} else {
			$featureCategory = FeatureCategory::find($featurePost->category_id);
			Cache::add('features-post-featureCategory' . $postId, $featureCategory, $this->cacheTimeLimit);
		}
		if (Cache::has('features-post-postArchives' . $postId)) {
			$postArchives = Cache::get('features-post-postArchives' . $postId);
		} else {
			// We also need to get all rows with a specific category_id to populate the post archive column 
			$postArchives = DB::table(FeaturePost::getDbTableName())->select('post_id','posting_date', 'post_title')
												 			  	  ->where('category_id', $featurePost->category_id)
												 			  	  ->get();
			Cache::add('features-post-postArchives' . $postId, $postArchives, $this->cacheTimeLimit);									 	 
		}
		
		// Determine the content of Post Prev & Next Links		
		if (Cache::has('features-post-prev-next-links' . $postId)) {
			$leftLink = Cache::get('features-post-prev-next-links' . $postId)["leftLink"];
			$rightLink = Cache::get('features-post-prev-next-links' . $postId)["rightLink"];
			$topThumbImg = Cache::get('features-post-prev-next-links' . $postId)["topThumbImg"];	
		} else {
			$prevNextLinks = $this->handlePrevNextLinks($featurePost);
			$leftLink = $prevNextLinks["leftLink"];
			$rightLink = $prevNextLinks["rightLink"];
			$topThumbImg = $prevNextLinks["topThumbImg"];
			Cache::add('features-post-prev-next-links' . $postId, $prevNextLinks, $this->cacheTimeLimit);
		}
		
		// Get the setting value for this page										
		$this->getXmlConfig($this->getXmlNodeLabel());	

		// The Features page has Rensai, News, & Gadgets modules on its page. 												 
		return View::make($this->getViewName("post"))->with('featureCategory', $featureCategory)
										  			 ->with('featurePost', $featurePost)
										  			 ->with('postArchives', $postArchives)
										  			 ->with('rensaiModuleEntries', $this->getRensaiModuleEntries())
									  	  			 ->with('newsModuleEntries', $this->getNewsModuleEntries())
									  	  			 ->with('gadgetsModuleEntries', $this->getGadgetsModuleEntries())
									  	  			 ->with('leftLink', $leftLink)
									  	  			 ->with('rightLink', $rightLink)
									  	  			 ->with('topThumbImg', $topThumbImg);			
	}
	/* Redirect back to features.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}	
	/* A Helper function for the features() & featuresCms() function */
	protected function featuresPageFeaturesCategoriesDbQuery() {
		$featureCategories = FeatureCategory::orderBy('id','desc')->get();
		return $featureCategories;
	}
	/* A Helper function for the features() & featuresCms() function */
	protected function featuresPageFeaturesPostsDbQuery() {
		$featurePosts = FeaturePost::orderBy('id','desc')->get();
		return $featurePosts;
	}
	/* Handle the Prev & Next Links of the features-post.blade.php */
	private function handlePrevNextLinks($featurePost) {
		$prevNextLinks = array(3);
		$featurePostIds = DB::table(FeaturePost::getDbTableName())->select('id', 'thumbnail_img')->get();									   
		if ($featurePost['id'] == $featurePostIds[0]->id) {
			// This record is the oldest record in the table
			// The left col will be the link to the newer article
			$leftLink =  DB::table(FeaturePost::getDbTableName())->select('post_id', 'post_title', 'thumbnail_img')
												  			   ->where('id', '=', $featurePostIds[1]->id)
												  			   ->first();									  						  
			// The right col will be the link to back to the parent page
			$rightLink = null;	
			$topThumbImg = $featurePostIds[count($featurePostIds) - 1]->thumbnail_img;
		} else if ($featurePost['id'] == $featurePostIds[count($featurePostIds) - 1]->id) {
			// This record is the newest record in the table
			// The left col will be the link to back to the parent page
			$leftLink = null;
			// The right col will be the link to the older article
			$rightLink =  DB::table(FeaturePost::getDbTableName())->select('post_id', 'post_title', 'thumbnail_img')
												   				->where('id', '=', $featurePostIds[count($featurePostIds) - 2]->id)
												   				->first();
			$topThumbImg = $featurePostIds[count($featurePostIds) - 1]->thumbnail_img;								   									  
		} else {
			// This record is neither the oldest nor the newest record in the table
			// Get the key of this $featurePost['id']
			$thisPostKey = -1;
			for ($i=0; $i<count($featurePostIds) - 1; $i++) {
				if ($featurePost['id'] == $featurePostIds[$i]->id) {
					$thisPostKey = $i;
					break;
				}
			}
			// The left col will be the link to the newer article
			$leftLink =  DB::table(FeaturePost::getDbTableName())->select('post_id', 'post_title', 'thumbnail_img')
												  			   ->where('id', '=', $featurePostIds[$thisPostKey + 1]->id)
												  			   ->first();	
			// The right col will be the link to the order article
			$rightLink =  DB::table(FeaturePost::getDbTableName())->select('post_id', 'post_title', 'thumbnail_img')
												   				->where('id', '=', $featurePostIds[$thisPostKey - 1]->id)
												   				->first();
			$topThumbImg = null;									   			
		}
		$prevNextLinks["leftLink"] = $leftLink;	
		$prevNextLinks["rightLink"] = $rightLink;
		$prevNextLinks["topThumbImg"] = $topThumbImg;
		
		return $prevNextLinks;
	}
}