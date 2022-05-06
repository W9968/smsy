<?php

namespace App\models;

class Groupe {
    private string $name;
    private string $level;
    private string $capacity;
    private string $dep;

    /**
     * @param string $name
     * @param string $level
     * @param string $capacity
     * @param string $dep
     */
    public function __construct(string $name, string $level, string $capacity, string $dep)
    {
        $this->name = $name;
        $this->level = $level;
        $this->capacity = $capacity;
        $this->dep = $dep;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }
    /**
     * @param string $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getCapacity(): string
    {
        return $this->capacity;
    }
    /**
     * @param string $capacity
     */
    public function setCapacity(string $capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @return string
     */
    public function getDep(): string
    {
        return $this->dep;
    }
    /**
     * @param string $dep
     */
    public function setDep(string $dep): void
    {
        $this->dep = $dep;
    }



}