<?php

namespace Oiseal\Seal;
use Oiseal\User\User;
use Oiseal\Place\Place;

class Seal
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Place
     */
    protected $place;
    
    /**
     * @var string
     */
    protected $updateDt;

    /**
     * constructor.
     *
     * @param User $user
     * @param Place $place
     */
    public function __construct(User $user, Place $place)
    {
        $this->user = $user;
        $this->place = $place;
    }

    /**
     * user id getter.
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->user->getId();
    }

    /**
     * place id getter.
     *
     * @return string
     */
    public function getPlaceId()
    {
        return $this->place->getId();
    }

    /**
     * place name getter.
     *
     * @return string
     */
    public function getPlaceName()
    {
        return $this->place->getName();
    }

    /**
     * place latitude getter.
     *
     * @return string
     */
    public function getPlaceLatitude()
    {
        return $this->place->getLatitude();
    }

    /**
     * place longitude getter.
     *
     * @return string
     */
    public function getPlaceLongitude()
    {
        return $this->place->getLongitude();
    }

    /**
     * set update dt.
     *
     * @param string $updateDt
     */
    public function setUpdateDt($updateDt)
    {
        $this->updateDt = $updateDt;
    }

    /**
     * to array.
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'placeId' => $this->place->getId(),
            'placeName' => $this->place->getName(),
            'latitude' => $this->place->getLatitude(),
            'longitude' => $this->place->getLongitude(),
            'updateDt' => $this->updateDt
        );
    }
}
