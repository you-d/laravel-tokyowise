<?php
use Illuminate\Routing\Controller;

class ApiController extends Controller {
    // the static var below is accessed by the OAuthController & the app/start/global.php
    static public $apiVersions = array("v1" => "api/v1");
}
