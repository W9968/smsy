<?php

namespace App\models;

class Teacher
{
    private string $salary;
    private string $user_id;
    private string $class_id;

    /**
     * @param string $salary
     * @param string $user_id
     * @param string $class_id
     */
    public function __construct(string $user_id, string $class_id, string $salary)
    {
        $this->salary = $salary;
        $this->user_id = $user_id;
        $this->class_id = $class_id;
    }

    /**
     * @return string
     */
    public function getSalary(): string
    {
        return $this->salary;
    }

    /**
     * @param string $salary
     */
    public function setSalary(string $salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUserId(string $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getClassId(): string
    {
        return $this->class_id;
    }

    /**
     * @param string $class_id
     */
    public function setClassId(string $class_id): void
    {
        $this->class_id = $class_id;
    }
}
