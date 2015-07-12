<?php
use Illuminate\Routing\Controller;
use LucaDegasperi\OAuth2Server\Authorizer;

class OAuthController extends Controller
{
    protected $authorizer;

    public function __construct(Authorizer $authorizer)
    {
        $this->authorizer = $authorizer;

        //$this->beforeFilter('auth', ['only' => ['getAuthorize', 'postAuthorize']]);
        //$this->beforeFilter('csrf', ['only' => 'postAuthorize']);
        //$this->beforeFilter('check-authorization-params', ['only' => ['getAuthorize', 'postAuthorize']]);
    }

    public function postAccessToken()
    {
        return Response::json($this->authorizer->issueAccessToken());
        //return Response::json(\Authorizer::issueAccessToken());
    }

    public function getAuthorize()
    {
        return View::make('authorization-form', $this->authorizer->getAuthCodeRequestParams());
    }

    public function postAuthorize()
    {
        // get the user id
        $params['user_id'] = Auth::user()->id;

        $redirectUri = '';

        if (Input::get('approve') !== null) {
            $redirectUri = $this->authorizer->issueAuthCode('user', $params['user_id'], $params);
        }

        if (Input::get('deny') !== null) {
            $redirectUri = $this->authorizer->authCodeRequestDeniedRedirectUri();
        }

        return Redirect::to($redirectUri);
    }

    /*
      Note :
      - OAuth 2 Grant Type : Client Credentials Grant
      - Client Credentials Grant Type -> Must use "oauth-owner" filter.
    */
    public function clientCredentialsGrantTest() {
      // login credentials
      $consumerKey = "1";
      $consumerSecret = "ssshdonttellanybody";
      // specify the oauth2 authorization url
      $oauth2url = url('api/oauth2');

      // request token
      $basicCredentials = base64_encode(($consumerKey).':'.($consumerSecret));
      $authContextContents = array(
          "grant_type" => "client_credentials",
      );
      $authContext = stream_context_create(
          array(
            'http' => array(
                'method' => 'POST',
                'header' => "Authorization: Basic " . $basicCredentials . "\r\n" .
                            "Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n",
                'content' => http_build_query($authContextContents),
            ),
          )
      );

      // send requests
      try {
          $preTokenResponse = file_get_contents($oauth2url, false, $authContext);
          var_dump("[REQUESTING ACCESS TOKEN IS SUCCESSFUL]");echo "<br><br>";
          var_dump(json_decode($preTokenResponse, true));echo "<br><br>";
          var_dump("[GOT THE ACCESS TOKEN, NOW GET THE RESOURCE]");echo "<br><br>";
          $token = json_decode($preTokenResponse, true);
          var_dump($token);echo "<br><br>";
      } catch (Exception $e) {
          var_dump("[REQUESTING ACCESS TOKEN HAS FAILED]");echo "<br><br>";
          var_dump($http_response_header);echo "<br><br>";
      }

      if (isset($token["token_type"]) && $token["token_type"] == "Bearer") {
          $context = stream_context_create(
              array(
                'http' => array(
                    'method'  => 'GET',
                    'header'  => 'Authorization: Bearer '.$token["access_token"]
                ),
              )
          );

          // specify the api endpoint url
          $api = url(ApiController::$apiVersions["v1"]);
          //$api = url('api/v1');
          // sample resource request url
          //$url = $api . "/rensai/posts/3";
          $url = $api . "/rensai/categories/3/posts";

          // try to connect to web API endpoints
          try {
              $response = file_get_contents($url, false, $context);
              var_dump("[OBTAINING RESOURCE IS SUCCESSFUL]");echo "<br><br>";
              var_dump(json_decode($response, true));
          } catch (Exception $e) {
              var_dump("[OBTAINING RESOURCE HAS FAILED]");echo "<br><br>";
              var_dump($http_response_header);
          }
      } else {
          echo "SIGH...";
      }
    }

    /*
      Note :
      - OAuth 2 Grant Type : Password Grant
      - Password Grant Type -> Must use "oauth-owner" filter for the basic credentials.
    */
    public function passwordGrantTest() {
      // login credentials
      $consumerKey = "1";
      $consumerSecret = "ssshdonttellanybody";
      $username = "john.doe@example.com";
      $password = "password";
      // specify the oauth2 authorization url
      $oauth2url = url('api/oauth2');

      // request token
      $basicCredentials = base64_encode(($consumerKey).':'.($consumerSecret));
      $authContextContents = array(
          "grant_type" => "password",
          "username" => $username,
          "password" => $password,
      );
      $authContext = stream_context_create(
          array(
            'http' => array(
                'method' => 'POST',
                'header' => "Authorization: Basic " . $basicCredentials . "\r\n" .
                            "Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n",
                'content' => http_build_query($authContextContents),
            ),
          )
      );

      // send requests
      try {
          $preTokenResponse = file_get_contents($oauth2url, false, $authContext);
          var_dump("[REQUESTING ACCESS TOKEN IS SUCCESSFUL]");echo "<br><br>";
          var_dump(json_decode($preTokenResponse, true));echo "<br><br>";
          var_dump("[GOT THE ACCESS TOKEN, NOW GET THE RESOURCE]");echo "<br><br>";
          $token = json_decode($preTokenResponse, true);
          var_dump($token);echo "<br><br>";
      } catch (Exception $e) {
          var_dump("[REQUESTING ACCESS TOKEN HAS FAILED]");echo "<br><br>";
          var_dump($http_response_header);echo "<br><br>";
      }

      if (isset($token["token_type"]) && $token["token_type"] == "Bearer") {
          $context = stream_context_create(
              array(
                'http' => array(
                    'method'  => 'GET',
                    'header'  => 'Authorization: Bearer '.$token["access_token"]
                ),
              )
          );

          // specify the api endpoint url
          $api = url(ApiController::$apiVersions["v1"]);
          //$api = url('api/v1');
          // sample resource request url
          //$url = $api . "/rensai/posts/3";
          $url = $api . "/rensai/categories/3/posts";

          // try to connect to web API endpoints
          try {
              $response = file_get_contents($url, false, $context);
              var_dump("[OBTAINING RESOURCE IS SUCCESSFUL]");echo "<br><br>";
              var_dump(json_decode($response, true));
          } catch (Exception $e) {
              var_dump("[OBTAINING RESOURCE HAS FAILED]");echo "<br><br>";
              var_dump($http_response_header);
          }
      } else {
          echo "SIGH...";
      }
    }
}
