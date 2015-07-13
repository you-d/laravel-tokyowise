<?php
use Illuminate\Routing\Controller;

class ApiController extends Controller {
    // the static var below is accessed by the OAuthController & the app/start/global.php
    static public $apiVersions = array("v1" => "api/v1");

    // the static function below is used by app/start/global.php
    static public function apiErrorHandler($href, $statusCode) {
        switch($statusCode) {
            case 400 :
                return self::jsonResponseTemplate($href, $statusCode, "Bad Request.", null);
                break;
            case 403 :
                return self::jsonResponseTemplate($href, $statusCode, "Forbidden.", null);
                break;
            case 404 :
                return self::jsonResponseTemplate($href, $statusCode, "Not Found.", null);
                break;
            case 500 :
                return self::jsonResponseTemplate($href, $statusCode, "Server Error.", null);
                break;
            default :
                return self::jsonResponseTemplate($href, $statusCode, "Misc.", null);
        }
    }

    static public function jsonResponseTemplate($href, $statusCode, $errMsg, $data) {
        return Response::json(array('meta' => array('href' => $href,
                                                    'statusCode' => $statusCode,
                                                    'contentType' => 'application/json'),
                                    'error' => $errMsg,
                                    'thedata' => $data),
                              $statusCode);
    }
}
