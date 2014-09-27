<?php

namespace Oiseal\Infra;

use GuzzleHttp\Client as Guzzle;
use Oiseal\Exception\InternalServerErrorException;

class YolpApi
{
    /**
     * local search entrypoint
     */
    CONST LOCAL_SEARCH = "/OpenLocalPlatform/V1/localSearch";

    /**
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * constructor.
     *
     * @param Guzzle $guzzle
     * @param string $appid
     */
    public function __construct(Guzzle $guzzle, $appid)
    {
        $this->guzzle = $guzzle;
        $this->appid = $appid;
    }

    /**
     * local search by uid
     *
     * @param string $uid
     * @return SimpleXmlObject
     */
    public function localSearchByUid($uid)
    {
        $response = $this->guzzle->get(self::LOCAL_SEARCH, [
            'query' => [
                'detail' => 'simple',
                'appid' => $this->appid,
                'uid' => $uid
            ]
        ]);

        if ($response->getStatusCode() !== '200') {
            throw new InternalServerErrorException('yolp api response is not OK. status:' . $response->getStatusCode());
        }

        $xml = $response->xml();

        return $xml;
    }
}
