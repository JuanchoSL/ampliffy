<?php

declare(strict_types=1);

namespace Ampliffy\Infrastructure\Parsers;

use Ampliffy\Service\Exceptions\EmptyValueException;
use Ampliffy\Service\Contracts\ProjectDataContentParserInterface;

class JSONParser implements ProjectDataContentParserInterface
{

    private $data;

    public function __construct(string $json)
    {
        $this->data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        if (empty($this->data->name)) {
            throw new EmptyValueException("The name of the project can not be empty");
        }
    }

    public function getName(): string
    {
        return $this->data->name;
    }

    public function getRequireds(): array
    {
        return (array) $this->data->require;
    }

}
