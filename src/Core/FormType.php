<?php

namespace App\Core;

use App\Core\EntityPopulate;
use App\Core\Request;

abstract class FormType
{
    protected $entity;          
    protected $submited = false;
    protected $fields = [];
    protected $errors = [];

    public function __construct($entity)
    {
        $this->entity = $entity;
        $this->buildForm();
    }

    public function isSubmited()
    {
        return $this->submited;
    }

    public function isValid()
    {
        // si les champs correspondent aux champs de l'entité

        if(0 !== count($this->errors)){
            var_dump($this->errors);
            die;
        }

        return (0 === count($this->errors));
    }

    public function handleRequest(Request $request): void
    {
        if (!$request->isMethod('POST')) {
            return;
        }

        $this->submited = true;

        $data = $request->request();

        $cleanData = [];
        
        foreach($this->fields as $key => $options) {
            if (!isset($data[$key])) {
                $this->errors[$key] = $key.' is not defined in form';  
                continue;
            }
            
            $value = $data[$key];
            
            if ((empty($value) && $value !== '0') && $options['required']) {
                $this->errors[$key] = $key . ' is required';
                continue;
            }

            $cleanData[$key] = trim(htmlentities($value));
        }

        $this->entity = EntityPopulate::populate($cleanData, $this->entity);
    }

    

    public function getData()
    {
        return $this->entity;
    }

    public function add($field, $options = []) {
        $this->fields[$field] = $options;
        
        return $this;
    }
    
    abstract public function buildForm();
}