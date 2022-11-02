<?php

declare(strict_types=1);

namespace Ampliffy\Infrastructure\Parsers;

use Ampliffy\Infrastructure\Parsers\JSONParser;
use Ampliffy\Service\Contracts\ProjectDataParserInterface;
use Ampliffy\Service\Exceptions\NotFoundException;

class FileParser implements ProjectDataParserInterface
{

    private $path;
    private $data;

    public function __construct(string $filepath)
    {
        $this->path = realpath($filepath);
        if ($this->path === false) {
            throw new NotFoundException("The filename '{$filepath}' does not exists");
        }
        $this->data = new JSONParser(file_get_contents($this->path));
    }

    public function getName(): string
    {
        return $this->data->getName();
    }

    public function getRequireds(): array
    {
        return $this->data->getRequireds();
    }

    public function getPath(): string
    {
        return $this->path;
    }

}
