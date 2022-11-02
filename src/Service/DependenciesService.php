<?php

declare(strict_types=1);

namespace Ampliffy\Service;

use Ampliffy\Service\Contracts\ProjectDataInterface;

class DependenciesService
{

    private $sequence = [];
    private $projects;
    private $tree = [];

    public function __construct(array $projects)
    {
        $this->projects = $projects;
        $this->tree();
    }

    protected function tree()
    {
        $this->parents();
        foreach (array_keys($this->tree) as $parent) {
            $this->dependencies($this->tree[$parent], $parent);
        }
    }

    protected function parents()
    {
        foreach ($this->projects as $first) {
            $depending = false;
            foreach ($this->projects as $test) {
                if ($first->getName() !== $test->getName()) {
                    if ($test->hasDependency($first)) {
                        $depending = true;
                        break;
                    }
                }
            }
            if (!$depending)
                $this->tree[$first->getName()] = [];
        }
    }

    protected function dependencies(array &$parent, string $checker)
    {
        if (array_key_exists($checker, $this->projects)) {
            foreach ($this->projects[$checker]->getDependencies() as $dependency => $version) {
                $parent[$dependency] = [];
                $this->dependencies($parent[$dependency], $dependency);
            }
        }
    }

    protected function check(ProjectDataInterface $hook, bool $only_parents)
    {
        foreach ($this->projects as $project) {
            if ($project->hasDependency($hook)) {
                if (!$only_parents || array_key_exists($project->getName(), $this->tree)) {
                    $this->sequence[$project->getName()] = $project;
                }
                $this->check($project, $only_parents);
            }
        }
    }

    public function getTree()
    {
        return $this->tree;
    }

    public function getSequence(ProjectDataInterface $hooked, bool $only_parents = false)
    {
        $this->sequence = [];
        $this->check($hooked, $only_parents);
        return $this->sequence;
    }

    public function pipelines($command, ProjectDataInterface $hooked, bool $only_parents = false)
    {
        $results = [];
        $sequences = $this->getSequence($hooked, $only_parents);
        foreach ($sequences as $sequence) {
            $real_command = "cd " . dirname($sequence->getPath()) . " && " . $command;
            $results[$sequence->getName()] = exec($real_command);
        }
        return $results;
    }

}
