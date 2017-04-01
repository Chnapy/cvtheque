<?php

namespace MG\UserBundle\Entity;

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
    private $applicant;


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
     * Set applicant
     *
     * @param \MG\UserBundle\Entity\Applicant $applicant
     *
     * @return Hobby
     */
    public function setApplicant(\MG\UserBundle\Entity\Applicant $applicant = null)
    {
        $this->applicant = $applicant;

        return $this;
    }

    /**
     * Get applicant
     *
     * @return \MG\UserBundle\Entity\Applicant
     */
    public function getApplicant()
    {
        return $this->applicant;
    }
}
