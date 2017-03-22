<?php

namespace MG\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity
 * @ORM\Table(name="society")
 */
class Society extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="societyname", type="string", length=128)
     * @Assert\Length(min=2, max=128)
     * @Gedmo\Slug(fields={"societyname"}
     */
    protected $societyname;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=64)
     * @Assert\Country()
     */
    protected $country;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=64)
     * @Assert\Length(min=2, max=64)
     */
    protected $town;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\Length(min=16, max=2048)
     */
    protected $description;

    
    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    protected $created;
    
    
    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    protected $updated;
    
    /**
    * @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"})
     */
    protected $image;
    
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Ip", mappedBy="user", cascade={"persist"})
     */
    protected $ips;


    public function __construct()
    {
        parent::__construct();
        $this->ips = new ArrayCollection();
        $this->image = new Image();
        $this->setCreated(new \DateTime());
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->setUpdated(new \DateTime());
    }
    
    /**
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
        $this->setUpdated(new \DateTime());
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
     * Set societyname
     *
     * @param string $societyname
     *
     */
    public function setSocietyname($societyname) {
        parent::setUsername($societyname);
        $this->setSlug($societyname);
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return U
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return U
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return U
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
     * Set image
     *
     * @param string $image
     */
    public function setImage(Image $image)
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
     * Set ips
     *
     * @param string $ips
     *
     */
    public function setIps($ips)
    {
        $this->ips = $ips;
        return $this;
    }

    /**
     * Get ips
     *
     * @return string
     */
    public function getIps()
    {
        return $this->ips;
    }

    /**
     * Add ip
     *
     * @param \MG\UserBundle\Entity\Ip $ip
     *
     * @return User
     */
    public function addIp(\MG\UserBundle\Entity\Ip $ip)
    {
        $ip->setUser($this);
        $this->ips[] = $ip;

        return $this;
    }

    /**
     * Remove ip
     *
     * @param \MG\UserBundle\Entity\Ip $ip
     */
    public function removeIp(\MG\UserBundle\Entity\Ip $ip)
    {
        $ip->setUser(null);
        $this->ips->removeElement($ip);
    }
}
