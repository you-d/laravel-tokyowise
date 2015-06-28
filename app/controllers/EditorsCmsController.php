<?php

class EditorsCmsController extends EditorsController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// editors-cms.blade.php
				$output = 'editors-cms';
				break;
		}

		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'editorsCms';
	}
	/* Shows public/cms/editors-cms.blade.php */
	public function editorsCms() {
		// Get the setting value for this page
		$this->getXmlConfig($this->getXmlNodeLabel());

		$viewFile = $this->getCmsViewFolder() . $this->getViewName("hub");
		return View::make( $viewFile )->with('featureModuleEntries',$this->getFeaturesModuleEntries())
									  ->with('newsModuleEntries',$this->getNewsModuleEntries())
									  ->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
									  ->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());
	}
	/* Handle POST */
	public function postEditorsCms() {
		switch (Input::get("category")) {
			case "editors-news-module":
				$this->setXmlConfig("editors", "news", intval(Input::get("arg1")));
				Cache::forget('module-news');

				break;
			case "editors-rensai-module":
				$this->setXmlConfig("editors", "rensai", intval(Input::get("arg1")));
				Cache::forget('module-rensai');

				break;
			case "editors-features-module":
				$this->setXmlConfig("editors", "features", intval(Input::get("arg1")));
				Cache::forget('module-features');

				break;
			case "editors-gadgets-module":
				$this->setXmlConfig("editors", "gadgets", intval(Input::get("arg1")));
				Cache::forget('module-gadgets');

				break;
		}
	}
}
