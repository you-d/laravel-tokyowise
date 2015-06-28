<?php

class HomeController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// home.blade.php
				$output = "home";
				break;	
		}
		
		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'home';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><home></home></tokyowise>
		return 'home';
	}
	/* Shows home.blade.php */
	public function home() {
		// Get the setting value for this page	
		$this->getXmlConfig($this->getXmlNodeLabel());		
		
		// For the headlines section, populate the headlineEntries array
		if (Cache::has('home-headlineEntries')) {
			$headlineEntries = Cache::get('home-headlineEntries');
		} else {								
			$headlineEntries = array();
			$this->populateHeadlineEntriesArray($headlineEntries);
			Cache::add('home-headlineEntries', $headlineEntries, $this->cacheTimeLimit);
		}
		
		// For the features section, grab most recent posts from the latest category
		if (Cache::has('home-featureCategory')) {
			$featureCategory = Cache::get('home-featureCategory');
		} else {
			$featureCategory = $this->featureCategoryDbQuery();
			Cache::add('home-featureCategory', $featureCategory, $this->cacheTimeLimit);
		}
		if (Cache::has('home-featurePosts')) {
			$featurePosts = Cache::get('home-featurePosts');
		} else {
			$featurePosts = $this->featurePostsDbQuery();
			Cache::add('home-featurePosts', $featurePosts, $this->cacheTimeLimit);					 
		}
		
		// The Home page has News, Rensai, & Gadgets modules on its page. 	
		return View::make( $this->getViewName("hub") )->with('featureCategory', $featureCategory)
												 	 ->with('featurePosts', $featurePosts)
												 	 ->with('headlineEntries', $headlineEntries)
												 	 ->with('wideHeaderImg', $this->xmlOutputArray["wideHeaderImg"])
												 	 ->with('narrowHeaderImg', $this->xmlOutputArray["narrowHeaderImg"])
												 	 ->with('newsModuleEntries',$this->getNewsModuleEntries())
									  			 	 ->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
									  			 	 ->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());	
	}
	/* Redirect back to home.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}
	/* A Helper function for both the home() & homeCms() function (Handle the "features highlight" section) */
	protected function featureCategoryDbQuery() {
		$featureCategory = FeatureCategory::find($this->xmlOutputArray["latestFeatureCatId"]);
		return $featureCategory;
	}
	/* A Helper function for both the home() & homeCms() function (Handle the "features highlight" section) */
	protected function featurePostsDbQuery() {
		$featurePosts = FeaturePost::where('category_id', '=', $this->xmlOutputArray["latestFeatureCatId"])->
									 orderBy('posting_date','desc')->
									 orderBy('id','desc')->
									 take($this->xmlOutputArray["totalEntries"])->
									 get();
		return $featurePosts;							 
	}
	/* A Helper function for both the home() & homeCms() function (Handle the "headline entries section" section) */
	protected function populateHeadlineEntriesArray(&$headlineEntries) {
		foreach($this->xmlOutputArray["headlineEntries"] as $headlineEntry) {		
			$this->getHeadlineEntry($headlineEntry [0], $headlineEntry [1], $headlineEntries);
		}
	}
	/* A Helper function of the populateHeadlineEntriesArray() function. 
	   Note we pass the 3rd param by reference. */
	private function getHeadlineEntry($headlinePageType, $headlineRecordId, &$headlineEntries) {
		switch ($headlinePageType) {
			case "features":
				$entry =  DB::table('feature_post')->
								join('feature_category', 
									'feature_post.category_id', '=', 'feature_category.id')->
								select('feature_post.id', 'feature_post.category_id', 
									   'feature_post.post_id', 'feature_post.post_title', 
									   'feature_post.primary_img', 'feature_category.category_name',
									   'feature_post.posting_date')->
								where('feature_post.id', '=', $headlineRecordId)->
								first();	
				$imagePath = "images" . DIRECTORY_SEPARATOR . "features" . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR;	
				$urlPath = "/features/" . $entry->post_id;
				$entryTitle = "Features > " . $entry->category_name;	
				$pageType = "Features";													
			break;
			case "rensai":
				$entry =  DB::table('rensai_post')->
								join('rensai_category', 
									'rensai_post.category_id', '=', 'rensai_category.id')->
								select('rensai_post.id', 'rensai_post.category_id', 'rensai_post.post_id',  
									   'rensai_post.primary_img', 'rensai_post.posting_date', 
									   'rensai_post.post_title', 'rensai_category.category_name')->
								where('rensai_post.id', '=', $headlineRecordId)->
								first();	
				$imagePath = "images" . DIRECTORY_SEPARATOR . "rensai" . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR;	
				$urlPath = "/rensai/" . $entry->category_id . '/' . $entry->post_id;
				$entryTitle = "Rensai > " . $entry->category_name;
				$pageType = "Rensai";											
			break;
			case "gadgets":
				$entry =  DB::table('gadgets_post')->
								select('id', 'post_title', 'primary_img', 
									   'posting_date')->
								where('id', '=', $headlineRecordId)->
								first();	
				$imagePath = "images" . DIRECTORY_SEPARATOR . "gadgets" . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR;
				$urlPath = "/gadgets/no" . $entry->id;	
				$entryTitle = "Gadgets > no" . $entry->id;	
				$pageType = "Gadgets";										
			break;
			case "news":
				$entry =  DB::table('news_post')->
								select('id', 'post_title', 'primary_img', 
									   'posting_date')->
								where('id', '=', $headlineRecordId)->
								first();
				$imagePath = "images" . DIRECTORY_SEPARATOR . "news" . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR;	
				$urlPath = "/news/" . $entry->id;	
				$entryTitle = "News";
				$pageType = "News";											
			break;
			case "editors":
				$pageType = "Editors";
			break;
		}
		if (isset($entry)) {
			array_push($headlineEntries, array ($entry, $imagePath, $urlPath, $entryTitle, $pageType));
		}
	}
}
