<?php
use Illuminate\Routing\Controller;

class ApiController extends Controller {
    // the static var below is accessed by the OAuthController & the app/start/global.php
    static public $apiVersions = array("v1" => "api/v1");

    static public function jsonResponseTemplate($href, $statusCode, $errMsg, $data) {
        return Response::json(array('meta' => array('href' => $href,
                                                    'statusCode' => $statusCode,
                                                    'contentType' => 'application/json'),
                                    'error' => $errMsg,
                                    'thedata' => $data),
                              $statusCode);
    }

    // oauth2 Laravel Testing page controller
    // IMPORTANT! The Request Header must contain "accept: application/json"
    // otherwise This Laravel app will handle the error of which it can't interpret,
    // thus returning error 500 instead.
    // Check app/start/global.php for better undestanding about this issue. 
    // Ref : http://fideloper.com/error-handling-with-content-negotiation
    public function oauthTest($grantType) {
        // internal triggers (use cURL or file_get_contents ?)
        $requestAccessTokenWithFileGetContents = false;
        $accessApiEndpointWithFileGetContents = false;

        // login credentials
        $consumerKey = "1";
        $consumerSecret = "ssshdonttellanybody";
        $username = "john.doe@example.com";
        $password = "password";
        // specify the oauth2 authorization url
        $oauth2url = url('api/oauth2');
        // prepare the credentials
        $basicCredentials = base64_encode(($consumerKey).':'.($consumerSecret));
        switch($grantType) {
            case "clientcredentials" :
              var_dump("TESTING CLIENT CREDENTIALS GRANT");echo "<br><br>";
              $authContextContents = array( "grant_type" => "client_credentials", );
              break;
            case "password" :
              var_dump("TESTING PASSWORD GRANT");echo "<br><br>";
              $authContextContents = array( "grant_type" => "password",
                                            "username" => $username,
                                            "password" => $password,
                                          );
              break;
            default :
              $authContextContents = array( "grant_type" => "client_credentials", );
        }

        if ($requestAccessTokenWithFileGetContents) {
            // Request access token with file_get_contents
            var_dump("[REQUESTING ACCESS TOKEN WITH FILE_GET_CONTENTS]");echo "<br><br>";
            try {
                $authContext = stream_context_create(
                    array(
                      'http' => array(
                          'method' => 'POST',
                          'header' => "Authorization: Basic " . $basicCredentials . "\r\n" .
                                      "Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n" .
                                      "accept: application/json\r\n",
                          'content' => http_build_query($authContextContents),
                      )
                    )
                );
                $preTokenResponse = file_get_contents($oauth2url, false, $authContext);
                var_dump("[REQUESTING ACCESS TOKEN IS SUCCESSFUL]");echo "<br><br>";
                $decodedResponse = json_decode($preTokenResponse, true);
                var_dump($decodedResponse["access_token"]);echo "<br><br>";
                var_dump("[GOT THE ACCESS TOKEN, NOW GET THE RESOURCE]");echo "<br><br>";
            } catch (Exception $e) {
                var_dump("[REQUESTING ACCESS TOKEN HAS FAILED]");echo "<br><br>";
                var_dump($http_response_header);echo "<br><br>";
            }
        } else {
            // Request access token with cURL
            var_dump("[REQUESTING ACCESS TOKEN WITH CURL]");echo "<br><br>";
            $ch = curl_init($oauth2url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded;charset=UTF-8',
                                                       'Authorization: Basic ' . $basicCredentials,
                                                       'accept: application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($authContextContents));
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            $preTokenResponse = curl_exec($ch);

            if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
                var_dump("[REQUESTING ACCESS TOKEN HAS FAILED]");echo "<br><br>";
                var_dump(curl_getinfo($ch, CURLINFO_HTTP_CODE));echo "<br><br>";
                var_dump(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));echo "<br><br>";
                var_dump(curl_getinfo($ch, CURLINFO_HEADER_OUT));echo "<br><br>";
                var_dump(curl_getinfo($ch, CURLINFO_CONTENT_TYPE));echo "<br><br>";
            } else {
                var_dump("[REQUESTING ACCESS TOKEN IS SUCCESSFUL]");echo "<br><br>";
                $decodedResponse = json_decode($preTokenResponse, true);
                var_dump($decodedResponse);echo "<br><br>";
                var_dump("[GOT THE ACCESS TOKEN, NOW GET THE RESOURCE]");echo "<br><br>";
            }
            curl_close($ch);
        }

        // WARNING :
        // There's a bug with how Symfony's http layer is implemented which will
        // generate a 400 "Bad Request" status code upon making an attempt to connect to
        // the web API endpoint by using the lucadegasperi's oauth2-server-laravel package.
        // solution -> https://github.com/lucadegasperi/oauth2-server-laravel/issues/206
        // supplying invalid access token -> https://github.com/lucadegasperi/oauth2-server-laravel/issues/85
        if (isset($decodedResponse["token_type"]) && $decodedResponse["token_type"] == "Bearer") {
            // specify the api endpoint url
            $api = url(self::$apiVersions["v1"]);
            // sample resource request url
            //$url = $api . "/rensai/posts";
            $url = $api . "/rensai/categories/3/posts";

            if ($accessApiEndpointWithFileGetContents) {
                // Trying to access API endpoint with file_get_contents
                var_dump("[TRYING TO ACCESS API ENDPOINT WITH FILE_GET_CONTENTS]");echo "<br><br>";
                try {
                    $context = stream_context_create(
                        array(
                          'http' => array(
                              'method'  => 'GET',
                              'header' => "Authorization: Bearer " . $decodedResponse["access_token"] . "\r\n" .
                                          "accept: application/json\r\n",
                          )
                        )
                    );
                    $response = file_get_contents($url, false, $context);
                    var_dump("[OBTAINING RESOURCE WITH FILE_GET_CONTENTS IS SUCCESSFUL]");echo "<br><br>";
                    var_dump(json_decode($response, true));
                } catch (Exception $e) {
                    var_dump("[OBTAINING RESOURCE WITH FILE_GET_CONTENTS HAS FAILED]");echo "<br><br>";
                    var_dump($http_response_header);
                }
            } else {
                // Trying to access API endpoint with cURL
                var_dump("[TRYING TO ACCESS API ENDPOINT WITH CURL]");echo "<br><br>";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json',
                                                           'Authorization: Bearer ' . $decodedResponse["access_token"],
                                                           'accept: application/json'));
                curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                $response = curl_exec($ch);

                if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
                    var_dump("[RESOURCE FETCHING WITH CURL HAS FAILED]");echo "<br><br>";
                    var_dump(curl_getinfo($ch, CURLINFO_HTTP_CODE));echo "<br><br>";
                    var_dump(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));echo "<br><br>";
                    var_dump(curl_getinfo($ch, CURLINFO_HEADER_OUT));echo "<br><br>";
                    var_dump(curl_getinfo($ch, CURLINFO_CONTENT_TYPE));echo "<br><br>";
                } else {
                    var_dump("[RESOURCE FETCHING WITH CURL IS SUCCESSFUL]");echo "<br><br>";
                    $decodedResponse = json_decode($response, true);
                    var_dump($decodedResponse);echo "<br><br>";
                }
                curl_close($ch);
            }
        } else {
            var_dump("[EITHER ACCESS TOKEN TYPE IS NOT SET OR POSSESSING NON BEARER ACCESS TOKEN TYPE]");echo "<br><br>";
        }
    }
}
