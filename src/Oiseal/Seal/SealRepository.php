<?php

namespace Oiseal\Seal;

use Oiseal\User\User;
use Oiseal\Place\Place;
use PDO;

class SealRepository
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * constructor.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * find by user.
     *
     * @param User $user
     * @return SealSet
     */
    public function findByUser(User $user)
    {
        $stmt = $this->pdo->prepare("
            SELECT
                user_id
              , place_id
              , place_name
              , latitude
              , longitude
              , update_dt
            FROM
                seal
            WHERE
                user_id = :userId
            ORDER BY
                update_dt DESC
        ");

        $stmt->bindValue(':userId', $user->getId());
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $set = new SealSet();
        foreach ($stmt as $record) {
            $user = new User($record['user_id']);
            $place = new Place($record['place_id']);
            $place->setName($record['place_name']);
            $place->setCoordinate($record['latitude'], $record['longitude']);
            $seal = new Seal($user, $place);
            $seal->setUpdateDt($record['update_dt']);
            $set->add($seal);
        }

        return $set;
    }

    /**
     * store.
     *
     * @param Seal $seal
     */
    public function store(Seal $seal) {
        $stmt = $this->pdo->prepare("
            REPLACE INTO seal(
                user_id,
                place_id,
                place_name,
                latitude,
                longitude
            )
            VALUES(
                :userId,
                :placeId,
                :placeName,
                :latitude,
                :longitude
            )
        ");

        $stmt->bindValue(':userId', $seal->getUserId());
        $stmt->bindValue(':placeId', $seal->getPlaceId());
        $stmt->bindValue(':placeName', $seal->getPlaceName());
        $stmt->bindValue(':latitude', $seal->getPlaceLatitude());
        $stmt->bindValue(':longitude', $seal->getPlaceLongitude());

        $stmt->execute();
    }
}
