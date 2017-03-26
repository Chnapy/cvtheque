<?php

namespace MG\UserBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Society
 */
class Society extends User
{
    /**
     * @var string
     * @Assert\Length(min=2, max=128)
     */
    private $societyName;


    
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
        parent::setUsername($societyName);
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
    
    /**
     * @var integer
     */
    //protected $id;


}
