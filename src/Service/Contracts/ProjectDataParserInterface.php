<?php

namespace Ampliffy\Service\Contracts;

interface ProjectDataParserInterface
{

    public function getPath(): string;

    public function getName(): string;

    public function getRequireds(): array;
}
