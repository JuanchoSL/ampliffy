<?php

namespace Tests\Unit;

use Ampliffy\Infrastructure\Parsers\ComposerFileParser;

class ParserTest extends \PHPUnit\Framework\TestCase
{

    private $path;

    public function setUp(): void
    {
        $this->path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'repositories';
    }

    public function testHasDependency()
    {
        $project_name = 'Proyecto1';
        $path = $this->path . DIRECTORY_SEPARATOR . $project_name;
        $project = new ComposerFileParser(dir($path));
        $this->assertEquals("ampliffy/proyecto1", $project->getName());
        $this->assertNotEmpty($project->getRequireds());
    }

}
