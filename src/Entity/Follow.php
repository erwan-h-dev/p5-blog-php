<?php

namespace App\Entity;

class Follow
{

    private    int     $id;
    private    int     $follower;
    private    int     $following;


    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of follower
     */ 
    public function getFollower(): int
    {
        return $this->follower;
    }

    /**
     * Set the value of follower
     *
     * @return  self
     */ 
    public function setFollower(int $follower)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get the value of following
     */ 
    public function getFollowing(): int
    {
        return $this->following;
    }

    /**
     * Set the value of following
     *
     * @return  self
     */ 
    public function setFollowing(int $following)
    {
        $this->following = $following;

        return $this;
    }
}