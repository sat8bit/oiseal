<?php

namespace Oiseal\Seal;

class SealSet
{
    /**
     * @var Array
     */
    protected $data = array();

    /**
     * add.
     *
     * @param Seal $seal
     */
    public function add(Seal $seal)
    {
        $this->data[] = $seal;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        $dataArray = array();

        foreach ($this->data as $seal) {
            $dataArray[] = $seal->toArray();
        }

        return $dataArray;
    }
}
