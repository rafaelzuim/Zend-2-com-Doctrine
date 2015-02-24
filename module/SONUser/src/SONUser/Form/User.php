<?php

namespace SONUser\Form;

use Zend\Form\Form;

class User extends Form{
    function __construct($name="user",$options = array()){
        parent::__construct($name,$options);



        $this->setInputFilter(new UserFIlter());
        $this->setAttribute("method", "post");

        $id = new \Zend\Form\Element\Hidden("id");
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome: ")
        ->setAttribute("placeholder", "Informe seu nome");
        $this->add($nome);

        $email = new \Zend\Form\Element\Text("email");
        $email->setLabel("Email: ")
        ->setAttribute("placeholder", "Informe seu email");
        $this->add($email);

        $password = new \Zend\Form\Element\Password("password");
        $password->setLabel("Password: ")
        ->setAttribute("placeholder", "Informe sua senha");
        $this->add($password);

        $confirmation = new \Zend\Form\Element\Password("confirmation");
        $confirmation->setLabel("Redigite: ")
        ->setAttribute("placeholder", "Redigite sua senha");
        $this->add($confirmation);

        $csrf = new \Zend\Form\Element\Csrf("security");
        $this->add($csrf);

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttributes(array('value'=>'Salvar','class'=>'btn btn-primary btn-md'));
        $this->add($submit);
    }
}