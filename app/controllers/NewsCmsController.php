<?php

class NewsCmsController extends NewsController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// news-cms.blade.php
				$output = 'news-cms';
				break;
		}
		
		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'newsCms';
	}
	/* Shows public/cms/news-cms.blade.php */
	public function newsCms() {
		// Get the setting values for this page		
		$this->getXmlConfig($this->getXmlNodeLabel());
		
		// Data fetching operations
		$newsPosts = $this->newsPageNewsPostDbQuery();
		
		$viewFile = $this->getCmsViewFolder() . $this->getViewName("hub");
		return View::make($viewFile)->with('newsPosts', $newsPosts)
									->with('featureModuleEntries',$this->getFeaturesModuleEntries())
									->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
									->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());	
	}
	/* Handle POST */
	public function postNewsCms() {
		switch (Input::get("category")) {
			case "news-features-module":
				$this->setXmlConfig("news", "features", intval(Input::get("arg1")));
				Cache::forget('module-features');
				
				break;
			case "news-rensai-module":
				$this->setXmlConfig("news", "rensai", intval(Input::get("arg1")));
				Cache::forget('module-rensai');
				
				break;
			case "news-gadgets-module":
				$this->setXmlConfig("news", "gadgets", intval(Input::get("arg1")));
				Cache::forget('module-gadgets');
				
				break;			
		}
	}
}