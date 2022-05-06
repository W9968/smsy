<?php

namespace App\models;

class Subject
{

    private string $name;
    private string $duraiton;

    /**
     * @param string $name
     * @param string $duraiton
     */
    public function __construct(string $name, string $duraiton)
    {
        $this->name = $name;
        $this->duraiton = $duraiton;
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
    public function getDuraiton(): string
    {
        return $this->duraiton;
    }

    /**
     * @param string $duraiton
     */
    public function setDuraiton(string $duraiton): void
    {
        $this->duraiton = $duraiton;
    }

}