<?php

namespace Tests\Functional;

use Ampliffy\Service\Entities\ProjectData;
use Ampliffy\Infrastructure\Parsers\ComposerFileParser;

class ServiceTest extends \PHPUnit\Framework\TestCase
{

    private $service;
    private $path;

    public function setUp(): void
    {
        $this->service = new \Ampliffy\Service\DependenciesService(FOLDERS_TO_LISTEN);
        $this->path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'repositories';
    }

    public function testSequenceOnlyParents()
    {
        $sequence = $this->service->getSequence(new ProjectData(new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . 'Libreria2'))), true);
        $this->assertEquals(2, count($sequence));

        $sequence = $this->service->getSequence(new ProjectData(new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . 'Libreria1'))), true);
        $this->assertEquals(1, count($sequence));
    }

    public function testSequenceComplete()
    {
        $sequence = $this->service->getSequence(new ProjectData(new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . 'Libreria4'))), false);
        $this->assertEquals(3, count($sequence));
        foreach ($sequence as $element) {
            $this->assertInstanceOf(ProjectData::class, $element);
            $this->assertTrue(in_array($element->getName(), ['ampliffy/libreria2', 'ampliffy/proyecto1', 'ampliffy/proyecto2']));
        }
    }

    public function testSequenOnlyParents()
    {
        $sequence = $this->service->getSequence(new ProjectData(new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . 'Libreria4'))), true);
        $this->assertEquals(2, count($sequence));
        foreach ($sequence as $element) {
            $this->assertInstanceOf(ProjectData::class, $element);
            $this->assertTrue(in_array($element->getName(), ['ampliffy/proyecto1', 'ampliffy/proyecto2']));
        }
    }

    public function testPipelinesAll()
    {
        $sequence = $this->service->pipelines('git status', new ProjectData(new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . 'Libreria4'))), false);
        $this->assertNotEmpty($sequence);
        $this->assertEquals(3, count($sequence));
    }

    public function testPipelinesOnlyParents()
    {
        $sequence = $this->service->pipelines('git status', new ProjectData(new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . 'Libreria4'))), true);
        $this->assertNotEmpty($sequence);
        $this->assertEquals(2, count($sequence));
    }

}
