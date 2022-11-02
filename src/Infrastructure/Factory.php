<?php

declare (strict_types=1);

namespace Ampliffy\Infrastructure;

use Ampliffy\Service\Entities\ProjectData;
use Ampliffy\Infrastructure\Parsers\ComposerFileParser;
use Ampliffy\Service\Contracts\ProjectDataInterface;

class Factory
{

    public static function createProjectData($path): ProjectDataInterface
    {
        return new ProjectData(new ComposerFileParser(dir($path)));
    }

}
