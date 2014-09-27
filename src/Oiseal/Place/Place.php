<?php

namespace Oiseal\Place;

class Place
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var double
     */
    protected $latitude;

    /**
     * @var double
     */
    protected $longitude;

    /**
     * constructor.
     *
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * id getter.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * name setter.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * name getter.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * coordinate setter.
     *
     * @param double $latitude
     * @param double $longitude
     */
    public function setCoordinate($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * latitude getter.
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * longitude getter.
     * @return double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}
