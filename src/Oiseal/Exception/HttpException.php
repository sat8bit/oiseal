<?php

namespace Oiseal\Exception;

abstract class HttpException extends \ErrorException
{
    const STATUS = 500;

    /**
     * get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return static::STATUS;
    }
}
