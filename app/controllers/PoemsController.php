<?php

class PoemsController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// poems.blade.php
				$output = 'poems';
				break;
		}

		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'poems';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><poems></poems></tokyowise>
		return 'poems';
	}
  /* Redirect back to poems.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}
	/* Shows poems.blade.php */
	public function poems() {
      // shows errors/underConstruction.blade.php
      return View::make("errors" . DIRECTORY_SEPARATOR . "underConstruction");
  }
}
