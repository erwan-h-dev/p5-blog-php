<?php

namespace App\Entity;

class User 
{
    private int $id;
    private string $userName;
    private string $createdAt;  // DateTime
    private string $updatedAt;  // DateTime
    private string $lastLogin;  // DateTime
    private string $email;     
    private string $password;  
    private string $firstName; 
    private string $lastName;  
    private string $role;
    private int $valid              = 0;
    private ?string $profilePicture = '/assets/images/dashboard/1.png';
    private ?string $twitter        = null;
    private ?string $linkedin       = null;
    private ?string $facebook       = null;
    private ?string $instagram      = null;

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

    /**
     * Get the value of profilePicture
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * Set the value of profilePicture
     *
     * @return  self
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * Get the value of twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set the value of twitter
     *
     * @return  self
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get the value of linkedin
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * Set the value of linkedin
     *
     * @return  self
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get the value of facebook
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set the value of facebook
     *
     * @return  self
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get the value of instagram
     */ 
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set the value of instagram
     *
     * @return  self
     */ 
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get the value of valid
     */ 
    public function getValid(): int
    {
        return $this->valid;
    }

    /**
     * Set the value of valid
     *
     * @return  self
     */ 
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }
}