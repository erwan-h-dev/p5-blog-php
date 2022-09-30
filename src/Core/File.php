<?php


namespace App\Core;

class File{

    private string $targetDirectory = '/var/www/html/public/images/';
    private string $pathFile;
    private array $file;

    public function __construct()
    {
        $this->file = $_FILES['file'];
    }

    public function isImage(): bool
    {
        $fileType = $this->file['type'];
        $fileType = explode('/', $fileType);

        if ($fileType[0] === 'image') {
            return true;
        }

        return false;
    }

    /**
     * Get the value of pathFile
     */ 
    public function getPathFile(): string
    {
        return $this->pathFile;
    }

    /**
     * Set the value of pathFile
     *
     * @return  self
     */ 
    public function setPathFile(string $pathFile): self
    {
        $this->pathFile = $pathFile;

        return $this;
    }

    public function uploadFile(): self
    {

        $fileName = $this->sanitizeFileName($this->file['name']);

        $this->setPathFile("/public/images/" . $fileName);
        
        move_uploaded_file($this->file['tmp_name'], $this->targetDirectory . basename($fileName));

        return $this;
    }

    private function sanitizeFileName(string $fileName): string
    {
        $file_name_str = str_replace(' ', '-', $fileName);
        
        // Removes special chars. 
        $file_name_str = preg_replace('/[^A-Za-z0-9\-\_\.]/', '', $file_name_str);

        // Replaces multiple hyphens with single one. 
        $file_name_str = preg_replace('/-+/', '-', $file_name_str); 

        return $file_name_str;
    }
}
