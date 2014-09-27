<?php

namespace Oiseal\Exception;

class InternalServerErrorException extends HttpException
{
    const STATUS = 500;
}
