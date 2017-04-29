<?php

namespace MG\UserBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
/**
 * @UniqueEntity(fields = "username", targetClass = "MG\UserBundle\Entity\User", message="fos_user.societyName.already_used")
 * @UniqueEntity(fields = "email", targetClass = "MG\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Society extends User
{
    /**
     * @var string
     * @Assert\Length(min=2, max=128)
     */
    private $societyName;

    /**
     * @var integer
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/",
     *     match=true,
     *     message="Effectif invalide"
     * )
     */
    private $effectif;

    /**
     * @var string
     * @Assert\Length(min=2)
     */
    private $activity;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->addRole("ROLE_SOCIETY");
    }
    
    /**
     * Set societyName
     *
     * @param string $societyName
     *
     * @return Society
     */
    public function setSocietyName($societyName)
    {
        $this->societyName = $societyName;
        $this->username = $societyName;
        $this->setSlug($societyName);

        return $this;
    }

    /**
     * Get societyName
     *
     * @return string
     */
    public function getSocietyName()
    {
        return $this->societyName;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
        $this->setSocietyName($username);
        
        return $this;
    }

    /**
     * Set effectif
     * @param integer $effectif
     */
    public function setEffectif($effectif) {
    	$this->effectif = $effectif;
    }

    /**
     * Get effectif
     * @return integer
     */
    public function getEffectif(){
    	return $this->effectif;
    }

    /**
     * Set effectif
     * @param string $activity
     */
    public function setActivity($activity) {
    	$this->activity = $activity;
    }

    /**
     * Get activity
     * @return string
     */
    public function getActivity(){
    	return $this->activity;
    }

}