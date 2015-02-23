<?php
namespace SONUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Stdlib\Hydrator\Aggregate\HydrateEvent;

abstract class AbstractService{
    /**
     *
     * @var EntityManager
     */
    protected $em;
    protected $entity;
	
    /**
     * @param EntityManager $em
     */
    public function __construct($em){
        $this->em = $em;
    }

    /**
     * 
     * @param array $data
     * @return EntityManager
     * 
     * Generic method to insert data
     */
    public function insert(array $data)
    {
        $entity = new $this->entity($data);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
	/**
	 * @param array $data
	 * 
	 */
    public function update(array $data){
        $entity = $this->em->getReference($this->entity,$data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function delete($id)
    {
        $entity = $this->em->getReference($this->entity,$id);
        $this->em->remove($entity);
        $this->em->flush();
    }


}