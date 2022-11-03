<?php

namespace App\Entity;

class Post 
{

    private int $id;
    private string $createdAt;
    private string $updatedAt;
    private string $title;
    private string $leadSentence;
    private string $content;
    private int $authorId;
    private int $status;
    private string $image;
    private string $validatedAt;

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
    public function setCreatedAt(string $createdAt): self
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
    public function setUpdatedAt(string $updatedAt): self
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
    public function setTitle(string $title): self
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
    public function setLeadSentence(string $leadSentence): self
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
    public function setContent(string $content): self
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
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setAuthorId(int $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of validatedAt
     */
    public function getValidatedAt(): string
    {
        return $this->validatedAt;
    }

    /**
     * Set the value of validatedAt
     *
     * @return  self
     */
    public function setValidatedAt(string $validatedAt): self
    {
        $this->validatedAt = $validatedAt;

        return $this;
    }
}