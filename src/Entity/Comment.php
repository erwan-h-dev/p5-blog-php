<?php

namespace App\Entity;

class Comment
{

    private     int     $id;
    private     string  $authorId;
    private     string  $content;
    private     string  $createdAt;
    private     int     $postId;
    private     ?int    $commentId;

    

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
     * Get the value of commentator
     */ 
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * Set the value of commentator
     *
     * @return  self
     */ 
    public function setAuthorId(int $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
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
     * Get the value of post
     */ 
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * Set the value of post
     *
     * @return  self
     */ 
    public function setPostId(int $postId): self
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getCommentId(): ?int
    {
        return $this->commentId;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setCommentId(?int $commentId): self
    {
        $this->commentId = $commentId;

        return $this;
    }
}