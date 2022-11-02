<?php

namespace Ampliffy\Service\Contracts;

interface ProjectDataInterface
{

    public function getPath(): string;

    public function getName(): string;

    public function getDependencies(): array;

    public function hasDependency(ProjectDataInterface $project): bool;
}
