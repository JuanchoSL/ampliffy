<?php

use Ampliffy\Infrastructure\Factory;

require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
$base_path = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "repositories";
$directories = [
    "Proyecto1",
    "Proyecto2",
    "Libreria1",
    "Libreria2",
    "Libreria4"
];
$projects = [];
foreach ($directories as $directory) {
    $path = $base_path . DIRECTORY_SEPARATOR . $directory;
    $project = Factory::createProjectData($path);
    $projects[$project->getName()] = $project;
}
defined('FOLDERS_TO_LISTEN') or define('FOLDERS_TO_LISTEN', $projects);
