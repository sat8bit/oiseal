<?php

namespace Oiseal\Exception;

class ForbiddenException extends HttpException
{
    const STATUS = 403;
}
