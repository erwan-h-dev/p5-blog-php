<?php

namespace App\Entity;

class User 
{
    private $id;        // int
    private $userName;  // string
    private $createdAt; // DateTime
    private $updatedAt; // DateTime
    private $lastLogin; // DateTime
    private $email;     // string
    private $password;  // string
    private $firstName; // string
    private $lastName;  // string
    private $role;      // string

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of id
     */
    public function setId(int $id)
    {
        return $this->id = $id;
    }

    /**
     * Get the value of userName
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */
    public function setUpdatedAt(string $updatedAt)
    {

        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of lastLogin
     */
    public function getLastLogin(): string
    {
        return $this->lastLogin;
    }

    /**
     * Set the value of lastLogin
     *
     * @return  self
     */
    public function setLastLogin(string $lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }
}
