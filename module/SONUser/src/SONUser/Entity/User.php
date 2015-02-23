<?php

namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Stdlib\Hydrator;


/**
 * SonuserUsers
 *
 * @ORM\Table(name="sonuser_users")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=true)
     */
    private $activationKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     *
     * @return the integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     *
     * @param integer $id
     */
    public function setId(integer $id) {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     *
     * @param string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     *
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $this->encryptPassword( $password );
        return $this;
    }
    /**
     * Encripta a senha
     */
    public function encryptPassword($password){
        return base64_decode(Pbkdf2::calc("sha256", $password, $this->salt, 10000, strlen($password) *2));
    }

    /**
     *
     * @return the string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     *
     * @param string $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }

    /**
     *
     * @return the boolean
     */
    public function getActive() {
        return $this->active;
    }

    /**
     *
     * @param boolean $active
     */
    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getActivationKey() {
        return $this->activationKey;
    }

    /**
     *
     * @param string $activationKey
     */
    public function setActivationKey($activationKey) {
        $this->activationKey = $activationKey;
        return $this;
    }

    /**
     *
     * @return the DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     *
     * @param \DateTime $updatedAt
     * @ORM\prePersist
     *
     * This anotation above , fires this method below before  data is saved;
     */
    public function setUpdatedAt() {
        $this->updatedAt = new \DateTime("now");
        return $this;
    }

    /**
     *
     * @return the DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * The constructor
     */
    public function __construct($options = array())
    {
        /**
         * php5 tricks (;
         */
        (new Hydrator\ClassMethods())->hydrate($options, $this);

        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        $this->salt 	 = base64_encode(Rand::getBytes(8,true));
        $this->activationKey = md5($this->email . $this->salt);
    }




}
