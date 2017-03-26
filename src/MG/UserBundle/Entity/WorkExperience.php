<?php

namespace MG\UserBundle\Entity;

/**
 * WorkExperience
 */
class WorkExperience
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fromDate;

    /**
     * @var \DateTime
     */
    private $toDate;

    /**
     * @var string
     */
    private $jobTitle;

    /**
     * @var string
     */
    private $employer;

    /**
     * @var string
     */
    private $description;

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
     * Set fromDate
     *
     * @param \DateTime $fromDate
     *
     * @return WorkExperience
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set toDate
     *
     * @param \DateTime $toDate
     *
     * @return WorkExperience
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get toDate
     *
     * @return \DateTime
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * Set jobTitle
     *
     * @param string $jobTitle
     *
     * @return WorkExperience
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set employer
     *
     * @param string $employer
     *
     * @return WorkExperience
     */
    public function setEmployer($employer)
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * Get employer
     *
     * @return string
     */
    public function getEmployer()
    {
        return $this->employer;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return WorkExperience
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set applicant
     *
     * @param \MG\UserBundle\Entity\Applicant $applicant
     *
     * @return WorkExperience
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
