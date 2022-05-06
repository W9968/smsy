<?php

namespace App\models;

class Student
{
    private string $user_id;
    private string $class_id;
    private string $payment;

    /**
     * @param string $user_id
     * @param string $class_id
     * @param string $payment
     */
    public function __construct(string $user_id, string $class_id, string $payment)
    {
        $this->user_id = $user_id;
        $this->class_id = $class_id;
        $this->payment = $payment;
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

    /**
     * @return string
     */
    public function getPayment(): string
    {
        return $this->payment;
    }

    /**
     * @param string $payment
     */
    public function setPayment(string $payment): void
    {
        $this->payment = $payment;
    }




}