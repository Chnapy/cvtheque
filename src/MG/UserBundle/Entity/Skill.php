<?php

namespace MG\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use FOS\ElasticaBundle\Configuration\Search;

/**
 * Skill
 * @ExclusionPolicy("all") 
 */
class Skill
{
    /**
     * @var integer
     * @Expose
     */
    private $id;

    /**
     * @var string
     * @Expose
     */
    private $name;

    /**
     * @var \MG\UserBundle\Entity\Applicant
     */
    private $applicants;
    
    /**
     * @var \CVThequeBundle\Entity\Advertisement
     */
    private $advertisements;
    
    public function __construct()
    {
        $this->applicants = new ArrayCollection();
        $this->advertisements = new ArrayCollection();    
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
    
    /**
     * Add advertisement
     *
     * @param \CVThequeBundle\Entity\Advertisement $advertisement
     *
     * @return Advertisement
     */
    public function addAdvertisement(\CVThequeBundle\Entity\Advertisement $advertisement)
    {
        $this->advertisements[] = $advertisement;

        return $this;
    }

    /**
     * Remove advertisement
     *
     * @param \CVThequeBundle\Entity\Advertisement $advertisement
     */
    public function removeAdvertisement(\CVThequeBundle\Entity\Advertisement $advertisement)
    {
        $this->advertisements->removeElement($advertisement);
    }

    /**
     * Get advertisements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvertisements()
    {
        return $this->advertisements;
    }
}