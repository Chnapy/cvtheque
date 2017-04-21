<?php

namespace CVThequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\HasLifecycleCallbacks() @ORM\Entity(repositoryClass="CVThequeBundle\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;
    
        
    /**
     * @ORM\Column(type="datetime")
     * 
     */
    protected $created;
    
    
    /**
     * @ORM\Column(type="datetime")
     * 
     */
    protected $updated;

    /**
     * @ORM\ManyToOne(targetEntity="MG\UserBundle\Entity\Applicant", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidate;

    /**
     * @ORM\ManyToOne(targetEntity="Advertisement", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advertisement;

    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedValue()
    {
       $this->setUpdated(new \DateTime());
    }
    
    public function __toString()
    {
        return "";
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Application
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
    
    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
    
    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }
    
    
    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }
    
    
    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    
    /**
     * Set candidate
     *
     * @param \MG\UserBundle\Entity\Applicant $candidate
     *
     * @return Application
     */
    public function setCandidate(\MG\UserBundle\Entity\Applicant $candidate)
    {
        $this->candidate = $candidate;

        return $this;
    }

    /**
     * Get candidate
     *
     * @return \MG\UserBundle\Entity\Applicant
     */
    public function getCandidate()
    {
        return $this->candidate;
    }

    /**
     * Set advertisement
     *
     * @param Advertisement $advertisement
     *
     * @return Application
     */
    public function setAdvertisement(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    /**
     * Get advertisement
     *
     * @return Advertisement
     */
    public function getAdvertisement()
    {
        return $this->advertisement;
    }
}
