<?php

namespace App\Core;

class JsonContent
{
    private array $content;

    public function __construct(array $returnContent)
    {
        $this->setContent($returnContent);

        $this->sendJson();
    }

    public function getContent(): array
    {
        $this->content = json_decode(file_get_contents($this->pathFile), true);

        return $this->content;
    }

    public function setContent(array $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function sendJson(): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->content);

        return;
    }
}
