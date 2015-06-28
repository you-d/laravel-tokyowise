<?php

class ContributorsController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// contributors.blade.php
				$output = 'contributors';
				break;
		}

		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'contributors';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><contributors></contributors></tokyowise>
		return 'contributors';
	}
  /* Redirect back to contributors.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}
	/* Shows contributors.blade.php */
	public function contributors() {
      // shows errors/underConstruction.blade.php
      return View::make("errors" . DIRECTORY_SEPARATOR . "underConstruction");
  }
}
