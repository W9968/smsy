<?php

namespace App\models;

class ClassSubject
{

    private string $startsAt;
    private string $class_id;
    private string $subject_id;

    /**
     * @param string $startsAt
     * @param string $class_id
     * @param string $subject_id
     */
    public function __construct(string $startsAt, string $class_id, string $subject_id)
    {
        $this->startsAt = $startsAt;
        $this->class_id = $class_id;
        $this->subject_id = $subject_id;
    }

    /**
     * @return string
     */
    public function getStartsAt(): string
    {
        return $this->startsAt;
    }

    /**
     * @param string $startsAt
     */
    public function setStartsAt(string $startsAt): void
    {
        $this->startsAt = $startsAt;
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
    public function getSubjectId(): string
    {
        return $this->subject_id;
    }

    /**
     * @param string $subject_id
     */
    public function setSubjectId(string $subject_id): void
    {
        $this->subject_id = $subject_id;
    }

}