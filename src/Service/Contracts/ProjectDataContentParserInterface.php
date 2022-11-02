<?php

namespace Ampliffy\Service\Contracts;

interface ProjectDataContentParserInterface
{

    public function getName(): string;

    public function getRequireds(): array;
}
