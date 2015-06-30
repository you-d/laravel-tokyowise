<?php

class HowToController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// howto.blade.php
				$output = 'howto';
				break;
		}

		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'howto';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><howto></howto></tokyowise>
		return 'howto';
	}
  /* Redirect back to contributors.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}
	/* Shows howto.blade.php */
	public function howto() {
      return View::make($this->getViewName("hub"));
  }
}
