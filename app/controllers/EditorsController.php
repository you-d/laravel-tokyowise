<?php

class EditorsController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// editors.blade.php
				$output = 'editors';
				break;
		}

		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'editors';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><editors></editors></tokyowise>
		return 'editors';
	}
	/* Shows editors.blade.php */
	public function editors() {
		// Get the setting value for this page
		$this->getXmlConfig($this->getXmlNodeLabel());

		return View::make( $this->getViewName("hub") )->with('featureModuleEntries',$this->getFeaturesModuleEntries())
												 	  										  ->with('newsModuleEntries',$this->getNewsModuleEntries())
												 	  											->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
												 	  											->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());
	}
	/* Redirect back to editors.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}
}
