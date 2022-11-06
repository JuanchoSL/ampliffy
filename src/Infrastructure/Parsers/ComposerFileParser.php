<?php

declare(strict_types=1);

namespace Ampliffy\Infrastructure\Parsers;

use Ampliffy\Service\Contracts\ProjectDataParserInterface;
use Ampliffy\Infrastructure\Parsers\FileParser;
use Ampliffy\Service\Exceptions\NotFoundException;

class ComposerFileParser implements ProjectDataParserInterface
{

    private $data;

    public function __construct(\Directory $directory)
    {
        if ($directory === false) {
            throw new NotFoundException("The selected directory does not exists");
        }
        $this->data = new FileParser($directory->path . DIRECTORY_SEPARATOR . 'composer.json');
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
        return $this->data->getPath();
    }

}
