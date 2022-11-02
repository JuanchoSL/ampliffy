<?php

namespace Ampliffy\Application;

use Ampliffy\Service\DependenciesService;
use Ampliffy\Infrastructure\Factory;

class GetDependencySequenceUseCase
{

    public function __invoke(array $folders_to_listen, $hooker, $only_parents = true)
    {

        $hooker = Factory::createProjectData($hooker);
        $service = new DependenciesService($folders_to_listen);
        return $service->getSequence($hooker, $only_parents);
    }

}
