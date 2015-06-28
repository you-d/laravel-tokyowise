<?php

class FeaturesCmsController extends FeaturesController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
			// features-cms.blade.php
			$output = "features-cms";
			break;	
		}
		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'featuresCms';
	}
	/* Shows public/cms/features-cms.blade.php */
	public function featuresCms() {
		// Get the setting values for this page		
		$this->getXmlConfig($this->getXmlNodeLabel());
		
		// Data fetching operations
		$featureCategories = parent::featuresPageFeaturesCategoriesDbQuery();
		$featurePosts = parent::featuresPageFeaturesPostsDbQuery();
		
		$viewFile = $this->getCmsViewFolder() . $this->getViewName("hub");
		return View::make($viewFile)->with('featureCategories', $featureCategories)
									->with('featurePosts', $featurePosts)
									->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
									->with('newsModuleEntries',$this->getNewsModuleEntries())
									->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());	
	}
	/* Handle POST */
	public function postFeaturesCms() {
		switch (Input::get("category")) {
			case "features-news-module":
				$this->setXmlConfig("features", "news", intval(Input::get("arg1")));
				Cache::forget('module-news');
				
				break;
			case "features-rensai-module":
				$this->setXmlConfig("features", "rensai", intval(Input::get("arg1")));
				Cache::forget('module-rensai');
				
				break;
			case "features-gadgets-module":
				$this->setXmlConfig("features", "gadgets", intval(Input::get("arg1")));
				Cache::forget('module-gadgets');
				
				break;			
		}
	}
}
