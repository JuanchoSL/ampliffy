<?php

namespace Tests\Unit;

use Ampliffy\Service\Exceptions\NotFoundException;
use Ampliffy\Service\Exceptions\EmptyValueException;
use Ampliffy\Infrastructure\Parsers\JSONParser;
use Ampliffy\Infrastructure\Parsers\ComposerFileParser;
use Ampliffy\Infrastructure\Parsers\FileParser;

class ExceptionsTest extends \PHPUnit\Framework\TestCase
{

    private $path;
    private $data;

    public function setUp(): void
    {
        $this->path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'repositories';
        $this->data = json_encode([
            'name' => ''
        ]);
    }

    public function testInvalidPath()
    {
        try {
            new FileParser($this->path . DIRECTORY_SEPARATOR . "Libreria4" . DIRECTORY_SEPARATOR . "not_exists.json");
            $this->assertTrue(false);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
            $this->assertEquals(NotFoundException::CODE, $ex->getCode());
        }
    }

    public function testNotFoundFile()
    {
        try {
            new ComposerFileParser(dir($this->path . DIRECTORY_SEPARATOR . "Carpeta1"));
            $this->assertTrue(false);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
        }
    }

    public function testEmptyName()
    {
        try {
            $parser = new JSONParser($this->data);
            $this->assertTrue(false);
        } catch (EmptyValueException $ex) {
            $this->assertTrue(true);
            $this->assertEquals(EmptyValueException::CODE, $ex->getCode());
        }
    }

}
