<?php

namespace Ampliffy\Application;

use Ampliffy\Service\DependenciesService;

class GetTreeUseCase
{

    public function __invoke(array $folders_to_listen)
    {
        $service = new DependenciesService($folders_to_listen);
        return $service->getTree();
    }

}
