<?php

namespace App\models;

class Faculty {
    private string $name;
    private int $price;

    /**
     * @param string $name
     * @param int $price
     */
    public function __construct(string $name, int $price)
    {
        $this->name = $name;
        $this->price = $price;
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
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }


}