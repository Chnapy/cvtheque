<?php

namespace MG\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Hobby
 */
class Hobby
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $name;

    /**
     * @var \MG\UserBundle\Entity\Applicant
     */
    private $applicants;
    
    public function __construct()
    {
        $this->applicants = new ArrayCollection();    
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Hobby
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    
    /**
     * Add applicant
     *
     * @param \MG\UserBundle\Entity\Applicant $applicant
     *
     * @return Advertisement
     */
    public function addApplicant(\MG\UserBundle\Entity\Applicant $applicant)
    {
        $this->applicants[] = $applicant;

        return $this;
    }

    /**
     * Remove applicant
     *
     * @param \MG\UserBundle\Entity\Applicant $applicant
     */
    public function removeApplicant(\MG\UserBundle\Entity\Applicant $applicant)
    {
        $this->applicants->removeElement($applicant);
    }

    /**
     * Get applicants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplicants()
    {
        return $this->applicants;
    }
    
}