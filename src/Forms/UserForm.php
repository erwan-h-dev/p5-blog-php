<?php

namespace App\Forms;

use App\Entity\User;
use App\Core\FormType;

class UserForm extends FormType
{
    public function __construct(User $entity)
    {
        parent::__construct($entity);
    }

    public function buildForm()
    {
        $this->add('userName', ['required' => true])
            ->add('firstName', ['required' => true])
            ->add('lastName', ['required' => true])
            ->add('profilePicture', ['required' => false])
            ->add('twitter', ['required' => false])
            ->add('linkedin', ['required' => false])
            ->add('facebook', ['required' => false])
            ->add('instagram', ['required' => false])
        ;
    }
}
