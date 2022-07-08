<?php

namespace App\Entity;

use DateTime;



class Post 
{

    private int $id;
    private string $createdAt;
    private string $updatedAt;
    private string $title;
    private string $leadSentence;
    private string $content;
    private int $status;

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
    public function setId(int $id)
    {
        $this->id = $id;

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
     * Get the value of title
     */ 
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of leadSentence
     */ 
    public function getLeadSentence(): string
    {
        return $this->leadSentence;
    }

    /**
     * Set the value of leadSentence
     *
     * @return  self
     */ 
    public function setLeadSentence(string $leadSentence)
    {
        $this->leadSentence = $leadSentence;

        return $this;
    }

    /*
    * Get the value of content
    */ 
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }
    /**
     * Get the value of status
     */ 
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }   
}
