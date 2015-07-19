<?php
use Illuminate\Routing\Controller;

class AngularJSViewPagesMapper extends Controller {
    private function getAngularJSViewFolderName() {
        return "angular_js_views";
    }

    public function showTestPage($pageName) {
        switch ($pageName) {
            case "home" :
                return $this->home();
                break;
        }
    }

    public function home() {
        return View::make( $this->getAngularJSViewFolderName() . "/home" );
    }
}
