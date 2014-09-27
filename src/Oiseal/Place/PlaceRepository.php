<?php

namespace Oiseal\Place;
use Oiseal\Infra\YolpApi;

class PlaceRepository
{
    /**
     * @var YolpApi
     */
    protected $yolp;

    /**
     * constructor.
     *
     * @param YolpApi $yolp
     */
    public function __construct(YolpApi $yolp)
    {
        $this->yolp = $yolp;
    }

    /**
     * find by id.
     *
     * @param string $id
     */
    public function find($id)
    {
        $xml = $this->yolp->localSearchByUid($id);

        if ($xml->ResultInfo->Count != '1') {
            return null;
        }

        $feature = $xml->Feature;

        $place = new Place($id);

        $place->setName($feature->Name);
        $coordinates = explode(',', $feature->Geometry->Coordinates);
        $place->setCoordinate($coordinates[1], $coordinates[0]);

        return $place;
    }
}
