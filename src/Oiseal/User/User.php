<?php

namespace Oiseal\User;

class User
{
    /**
     * @var string
     */
    protected $id;

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
     * id Getter.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
