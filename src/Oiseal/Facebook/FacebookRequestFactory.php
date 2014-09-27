<?php

namespace Oiseal\Facebook;

use Facebook\Entities\FacebookApp;
use Facebook\Entities\FacebookRequest;

class FacebookRequestFactory
{
    /**
     * @var FacebookApp
     */
    protected $facebookApp;

    /**
     * constructor.
     *
     * @param FacebookApp $facebookApp
     */
    public function __construct(FacebookApp $facebookApp)
    {
        $this->facebookApp = $facebookApp;
    }

    /**
     * create FacebookRequest at /me
     *
     * @param string $accessToken
     */
    public function createMe($accessToken)
    {
        return new FacebookRequest($this->facebookApp, $accessToken, 'GET', '/me');
    }
}
