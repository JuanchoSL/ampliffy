<?php

declare(strict_types=1);

namespace Ampliffy\Service\Exceptions;

class EmptyValueException extends \Exception
{

    const CODE = 428;

    public function __construct(string $message)
    {
        parent::__construct($message, self::CODE, null);
    }

}
