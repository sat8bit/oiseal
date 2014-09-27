<?php

namespace Oiseal\User;
use Oiseal\Facebook\FacebookRequestFactory;
use Facebook\FacebookClient;
use Facebook\Exceptions\FacebookResponseException;

class UserRepository
{
    /**
     * @var FacebookRequestFactory
     */
    protected $facebookRequestFactory;

    /**
     * constructor.
     *
     * @param FacebookClient $facebookClient
     * @param FacebookRequestFactory $facebookRequestFactory
     */
    public function __construct(FacebookClient $facebookClient, FacebookRequestFactory $facebookRequestFactory)
    {
        $this->facebookClient = $facebookClient;
        $this->facebookRequestFactory = $facebookRequestFactory;
    }

    /**
     * find by Access Token
     *
     * @param string $accessToken
     * @return User
     */
    public function findByAccessToken($accessToken)
    {
        $facebookRequest = $this->facebookRequestFactory->createMe($accessToken);

        try {
            $response = $this->facebookClient->sendRequest($facebookRequest);
        } catch(FacebookResponseException $e) {
            error_log("Facebook API Response Error. message:" . $e->getMessage());
            return null;
        }

        $me = $response->getGraphObject();

        return new User($me['id']);
    }
}
