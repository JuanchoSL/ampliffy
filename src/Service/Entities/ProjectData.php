<?php

declare(strict_types=1);

namespace Ampliffy\Service\Entities;

use Ampliffy\Service\Contracts\ProjectDataInterface;
use Ampliffy\Service\Contracts\ProjectDataParserInterface;

class ProjectData implements ProjectDataInterface
{

    private $parser;

    public function __construct(ProjectDataParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function getDependencies(): array
    {
        return $this->parser->getRequireds();
    }

    public function getName(): string
    {
        return $this->parser->getName();
    }

    public function getPath(): string
    {
        return $this->parser->getPath();
    }

    public function hasDependency(ProjectDataInterface $project): bool
    {
        return array_key_exists($project->getName(), $this->getDependencies());
    }

}
