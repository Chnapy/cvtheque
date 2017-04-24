<?php
// src/MG/BlogBundle/Entity/AdvertSkill.php

namespace CVThequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="advert_skill")
 */
class AdvertSkill
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(min=3,max=32)
     */
    private $name;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Advertisement", inversedBy="advertSkills")
     */
    private $advertisement;
   

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
     * @return AdvertSkill
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
     * Set advertisement
     *
     * @param \CVThequeBundle\Entity\Advertisement $advertisement
     *
     * @return AdvertSkill
     */
    public function setAdvertisement(\CVThequeBundle\Entity\Advertisement $advertisement = null)
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    /**
     * Get advertisement
     *
     * @return \CVThequeBundle\Entity\Advertisement
     */
    public function getAdvertisement()
    {
        return $this->advertisement;
    }
}
