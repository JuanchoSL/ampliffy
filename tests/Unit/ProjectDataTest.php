<?php

namespace Tests\Unit;

use Ampliffy\Service\Entities\ProjectData;
use Ampliffy\Infrastructure\Parsers\ComposerFileParser;

class ProjectDataTest extends \PHPUnit\Framework\TestCase
{

    private $path;
    public function setUp(): void
    {
        $this->path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'repositories';
    }

    public function testHasDependency()
    {
        $project = new ProjectData(new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . 'Proyecto1')));
        $library = new ProjectData(new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . 'Libreria1')));
        $this->assertTrue($project->hasDependency($library));
    }

}