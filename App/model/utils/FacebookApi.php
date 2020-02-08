<?php
/**
 * Created by PhpStorm.
 * User: raulhuanca
 * Date: 2/26/18
 * Time: 22:27
 */

class FacebookApi
{
    /**
     * @var \Facebook\Facebook
     */
    private $facebook = null;
    private $accessToken = null;
    private static $instance = null;
    private $appId = null;
    private $appSecret = null;

    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
            self::$instance->appId = AppParam::value("AUTH_FACEBOOK_APP_ID");
            self::$instance->appSecret = AppParam::value("AUTH_FACEBOOK_APP_SECRET");
            self::$instance->facebook = new Facebook\Facebook([
                'app_id' => self::$instance->appId,
                'app_secret' => self::$instance->appSecret,
                'default_graph_version' => 'v2.2',
            ]);
        }
        return self::$instance;
    }

    public function appId()
    {
        return $this->appId;
    }

    public function appSecret()
    {
        return $this->appSecret;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function isLoggedIn()
    {
        if (!isset($_SESSION['facebook_access_token']) || $_SESSION['facebook_access_token'] == "") {
            $helper = $this->facebook->getJavaScriptHelper();
            try {
                $accessToken = $helper->getAccessToken();
                $this->accessToken = $accessToken;
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
//            echo 'Graph returned an error: ' . $e->getMessage();
                return false;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
//            echo 'Facebook SDK returned an error: ' . $e->getMessage();
                return false;
            }

            if (isset($accessToken)) {
                // Logged in!
                $_SESSION['facebook_access_token'] = (string)$accessToken;
                return true;
            } else {
                unset($_SESSION['facebook_access_token']);
            }
            return false;
        } else {
            $this->accessToken = $_SESSION['facebook_access_token'];
            return true;
        }
    }

    public function logout()
    {
        if(isset($_SESSION['facebook_access_token'])) {
            unset($_SESSION['facebook_access_token']);
        }
    }

    public function getUser()
    {
        if ($this->isLoggedIn()) {
            $this->facebook->setDefaultAccessToken($this->accessToken);
            try {
                $response = $this->facebook->get('/me?fields=id,name,email');
                $userNode = $response->getGraphUser();
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
//            echo 'Graph returned an error: ' . $e->getMessage();
                return false;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
//            echo 'Facebook SDK returned an error: ' . $e->getMessage();
                return false;
            }
            if (isset($userNode)) {
                return $userNode;
            }
        }
        return false;
    }

    public function getPictureUrl()
    {
        $oUser = $this->getUser();
        if (is_object($oUser)) {
            return "https://graph.facebook.com/" . $oUser->getId() . "/picture?width=100";
        }
        return false;
    }
}