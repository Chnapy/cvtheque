<?php

namespace MG\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
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
     * @ORM\Column(name="firstname", type="string", length=32)
     * @Assert\Length(min=2, max=32)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=32)
     * @Assert\Length(min=2, max=32)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1)
     * @Assert\Length(min=1, max=1)
     */
    protected $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     * @Assert\Date
     */
    protected $birthday;

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
     * @Gedmo\Slug(fields={"username"})
     * @ORM\Column(length=128)
     */
    protected $slug;
    
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
     * @ORM\OneToMany(targetEntity="Hobby", mappedBy="user", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    protected $hobbys;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Ip", mappedBy="user", cascade={"persist"})
     */
    protected $ips;


    public function __construct()
    {
        parent::__construct();
        
        $this->hobbys = new ArrayCollection();
        $this->ips = new ArrayCollection();
        $this->image = new Image();
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
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
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
        $this->setUpdated(new \DateTime());
    }
    
    /**
     * Get age
     *
     * @return int
     */
    public function getAge() {
        $year = $this->birthday->format('Y');
        $month = $this->birthday->format('m'); 
        $day = $this->birthday->format('d');
        if(date('m')-(int)$month>= 0){
            if(date("d")-(int)$day>= 0 ||date('m')>$month){
                return date('Y')-(int)($year);
            }
        }
        return date('Y')-(int)($year)-1;
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
     * Set username
     *
     * @param string $firstname
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
     * @return U
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

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return U
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return U
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
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
     * Set hobbys
     *
     * @param string $hobbys
     *
     * @return U
     */
    public function setHobbys($hobbys)
    {
        $this->hobbys = $hobbys;

        return $this;
    }

    
    /**
     * Get hobbys
     *
     * @return string
     */
    public function getHobbys()
    {
        return $this->hobbys;
    }

    /**
     * Set ips
     *
     * @param string $ips
     *
     * @return U
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
     * Add hobby
     *
     * @param \MG\UserBundle\Entity\Hobby $hobby
     *
     * @return User
     */
    public function addHobby(\MG\UserBundle\Entity\Hobby $hobby)
    {
        $hobby->setUser($this);
        $this->hobbys[] = $hobby;

        return $this;
    }

    /**
     * Remove hobby
     *
     * @param \MG\UserBundle\Entity\Hobby $hobby
     */
    public function removeHobby(\MG\UserBundle\Entity\Hobby $hobby)
    {
        $hobby->setUser(null);
        $this->hobbys->removeElement($hobby);
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
