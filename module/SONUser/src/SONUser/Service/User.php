<?php
namespace SONUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use SONBase\Mail\Mail;


class User extends AbstractService{

    protected $transport;
    protected $view;

    /*
     * @param EntityManager $em
     * @param SmtpTransport $transport
     * @param unknown $view
    */
    public function __construct(EntityManager $em , SmtpTransport $transport, $view)
    {
        parent::__construct($em);
        $this->entity = "SONUser\Entity\User";
        $this->transport = $transport;
        $this->view = $view;
    }

    /**
     * (non-PHPdoc)
     * @see \SONUser\Service\AbstractService::insert()
     * Inserts the user to database and send a welcome email with the activation key
    */
    public function insert(array $data)
    {
        $entity = parent::insert($data);
        $dataEmail = array(
                'nome' 			=> $data['nome'],
                'activationKey'	=> $entity->getActivationKey()
        );

        if($entity){
            $mail = new Mail($this->transport,$this->view , 'add-user');
            $mail->setSubject("Confirmação de cadastro")
                    ->setTo($data['email'])
                    ->setData($dataEmail)
                    ->prepare()
                    ->send();
        }
        return $entity;
    }


}
