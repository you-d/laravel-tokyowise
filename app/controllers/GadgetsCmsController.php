<?php

class GadgetsCmsController extends GadgetsController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// gadgets-cms.blade.php
				$output = 'gadgets-cms';
		}
		return $output;		
	}
	/* alias */
	public function getAlias() {
		return 'gadgetsCms';
	}
	/* Shows public/cms/gadgets-cms.blade.php */
	public function gadgetsCms() {
		// Get the setting values for this page		
		$this->getXmlConfig($this->getXmlNodeLabel());
		
		$gadgetPosts = parent::gadgetsPageGadgetsPostDbQuery();
		
		$viewFile = $this->getCmsViewFolder() . $this->getViewName("hub");
		return View::make( $viewFile )->with('gadgetPosts',$gadgetPosts)
									  ->with('featureModuleEntries',$this->getFeaturesModuleEntries())
									  ->with('newsModuleEntries',$this->getNewsModuleEntries())
									  ->with('rensaiModuleEntries',$this->getRensaiModuleEntries());
	}
	/* Handle POST */
	public function postGadgetsCms() {
		switch (Input::get("category")) {
			case "gadgets-news-module":
				$this->setXmlConfig("gadgets", "news", intval(Input::get("arg1")));
				Cache::forget('module-news');
				
				break;
			case "gadgets-rensai-module":
				$this->setXmlConfig("gadgets", "rensai", intval(Input::get("arg1")));
				Cache::forget('module-rensai');
				
				break;
			case "gadgets-features-module":
				$this->setXmlConfig("gadgets", "features", intval(Input::get("arg1")));
				Cache::forget('module-features');
				
				break;			
		}
	}
}