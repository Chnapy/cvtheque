<?php

namespace MG\UserBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Society
 */
 
 class Admin extends User
{
    
    /**
     * @var string
     * @Assert\Length(min=2, max=32)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\Length(min=2, max=32)
     */
    private $lastname;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->addRole("ROLE_ADMIN");
    }
    
        
    /**
     * Set username
     *
     * @param string $username
     *
     */
    public function setUsername($username) {
        parent::setUsername($username);
        $this->setSlug($username);
    }
    
    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Applicant
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Applicant
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    
}
