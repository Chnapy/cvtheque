<?php

namespace MG\UserBundle\Entity;

/**
 * Skill
 */
class Skill
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
     * Set title
     *
     * @param string $title
     *
     * @return Skill
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Skill
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
     * @return Skill
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
