<?php

namespace App\models;

class User
{
    private string $cin;
    private string $password;
    private string $role;
    private string $picture;
    private string $fist_name;
    private string $last_name;
    private string $email;
    private string $state;
    private string $city;
    private string $zip;
    private string $gender;
    private string $address1;
    private string $address2;
    private string $birth;
    private string $phone;

    /**
     * @param string $cin
     * @param string $password
     * @param string $role
     * @param string $picture
     * @param string $fist_name
     * @param string $last_name
     * @param string $email
     * @param string $state
     * @param string $city
     * @param string $zip
     * @param string $gender
     * @param string $address1
     * @param string $address2
     * @param string $birth
     * @param string $phone
     */
    public function __construct(
        string $fist_name,
        string $last_name,
        string $email,
        string $cin,
        string $phone,
        string $gender,
        string $birth,
        string $address1,
        string $address2,
        string $state,
        string $city,
        string $zip,
        string $role,
        string $picture,
        string $password
    ) {
        $this->cin = $cin;
        $this->password = $password;
        $this->role = $role;
        if($picture == "") {
            if($gender == "FEMALE") $this->picture = "avatar_female.jpg";
            else $this->picture = "avatar_male.jpg";
        } else {
            $this->picture = $picture;
        }
        $this->fist_name = $fist_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->state = $state;
        $this->city = $city;
        $this->zip = $zip;
        $this->gender = $gender;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->birth = $birth;
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getCin(): string
    {
        return $this->cin;
    }

    /**
     * @param string $cin
     */
    public function setCin(string $cin): void
    {
        $this->cin = $cin;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getFistName(): string
    {
        return $this->fist_name;
    }

    /**
     * @param string $fist_name
     */
    public function setFistName(string $fist_name): void
    {
        $this->fist_name = $fist_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1(string $address1): void
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2(string $address2): void
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getBirth(): string
    {
        return $this->birth;
    }

    /**
     * @param string $birth
     */
    public function setBirth(string $birth): void
    {
        $this->birth = $birth;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
