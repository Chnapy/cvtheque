<?php
// src/CVThequeBundle/Entity/Advertisement

namespace CVThequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="CVThequeBundle\Repository\AdvertisementRepository")
 * @ORM\Table(name="advertisement")
 * @ORM\HasLifecycleCallbacks()
 */
class Advertisement 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    
    /**
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;
    
    
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
     * @ORM\Column(type="string")
     * @Assert\Length(min=8, max=128)
     */
    protected $title;
    
    
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min=3, max=12)
     */
    protected $author;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $content;

        
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;
    
    
    /**
     * @ORM\OneToOne(targetEntity="MG\UserBundle\Entity\Image", cascade={"persist", "merge", "remove", "merge"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="MG\UserBundle\Entity\Skill", mappedBy="advertisements", cascade={"persist"})
     * @Assert\Valid()
     */
    private $advertSkills;
    
        /**
     * @ORM\OneToMany(targetEntity="Application", mappedBy="advertisement", cascade={"persist"})
     */
    private $applications;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", cascade={"persist"})
     * @Assert\Valid()
     */
    private $category;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="MG\UserBundle\Entity\Society")
     * @ORM\JoinColumn(nullable=false)
     */
    private $society;
    
    /**
     * @ORM\ManyToMany(targetEntity="MG\UserBundle\Entity\Applicant", mappedBy="advertisements")
     */
    private $applicants;
        
    public function __construct()
    {
        $this->advertSkills = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->applicants = new ArrayCollection();
        $this->published = true;
    }
    
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
        return $this->getTitle();
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
     * Set published
     * 
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
    }
    
    /** 
     *
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }
    
    /** 
     * Get published
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }
    
    
    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->setSlug($this->title);
        return $this;
    }
    
    
    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    
    /**
     * Set author
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }
    
    
    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    
    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    
    
    /**
     * Get content
     *
     * @return text 
     */
    public function getContent($length = null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->content, 0, $length);
        else
            return $this->content;
    }
    
    
    /**
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    
    
    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
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
     * Add advertSkill
     * 
     */
    public function addAdvertSkill(\MG\UserBundle\Entity\Skill $advertSkill)
    {
        $advertSkill->addAdvertisement ($this);
        $this->advertSkills->add($advertSkill);
        return $this;
    }
    
    
    /**
     * Remove advertSkill
     * 
     */
    public function removeAdvertSkill(\MG\UserBundle\Entity\Skill $advertSkill)
    {
        $this->advertSkills->removeElement($advertSkill);
    }
    
    /**
     * Get advertSkills
     * 
     * @return ArrayCollection
     */
    public function getAdvertSkills()
    {
        return $this->advertSkills;
    }
    
    
    /**
     * Set advertSkills
     *
     */
    public function setAdvertSkills(\MG\UserBundle\Entity\Skill $advertSkills)
    {
        $this->advertSkills = $advertSkills;
        return $this;
    }
    
    
    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    
    /**
     * Set category
     *
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }
    
    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
    
    
    /**
     * get Slug
     * 
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    
    /**
     * Set society
     * 
     * @param \MG\UserBundle\Entity\Society $society
     */
    public function setSociety(\MG\UserBundle\Entity\Society $society = null)
    {
        $this->society = $society;
        return $this;
    }
    
    
    /**
     * Get society
     * 
     * @return \MG\UserBundle\Entity\Society
     */
    public function getSociety()
    {
        return $this->society;
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
        $applicants->addAdvertisements($this);
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
     * Add application
     *
     * @param \MG\UserBundle\Entity\Application $application
     *
     * @return Advertisement
     */
    public function addApplication(\CVThequeBundle\Entity\Application $application)
    {
        $application->setAdvertisement($this);
        $this->applications[] = $application;

        return $this;
    }

    /**
     * Remove application
     *
     * @param \MG\UserBundle\Entity\Application $application
     */
    public function removeApplication(\CVThequeBundle\Entity\Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }
}