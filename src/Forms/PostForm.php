<?php

namespace App\Forms;

use App\Entity\Post;
use App\Core\FormType;

class PostForm extends FormType
{
    public function __construct(Post $entity)
    {
        parent::__construct($entity);
    }

    public function buildForm()
    {
        $this->add('title', ['required' => true])
            ->add('leadSentence', ['required' => true])
            ->add('status', ['required' => true])
            ->add('content', ['required' => false])
            ->add('image', ['required' => false])
        ;
    }
}