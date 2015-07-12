<?php
use Illuminate\Routing\Controller;

class AngularJSViewPagesMapper extends Controller {
    private function getAngularJSViewFolderName() {
        return "angular_js_views";
    }

    public function showTestPage($pageName) {
        switch ($pageName) {
            case "test1" :
                return $this->test1();
                break;
            case "test2" :
                return $this->test2();
        }
    }

    public function test1() {
        return View::make( $this->getAngularJSViewFolderName() . "/test1" );
    }

    public function test2() {
        return View::make( $this->getAngularJSViewFolderName() . "/test2" );
    }
}
