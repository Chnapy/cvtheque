<?php

namespace MG\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ip
 *
 * @ORM\Table(name="ip")
 * @ORM\Entity(repositoryClass="MG\UserBundle\Repository\IpRepository")
 */
class Ip
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
     * @var \DateTime
     *
     * @ORM\Column(name="connectDate", type="datetime")
     */
    private $connectDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=32)
     */
    private $ip;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ips", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
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
     * Set connectDate
     *
     * @param \DateTime $connectDate
     *
     * @return Ip
     */
    public function setConnectDate($connectDate)
    {
        $this->connectDate = $connectDate;

        return $this;
    }

    /**
     * Get connectDate
     *
     * @return \DateTime
     */
    public function getConnectDate()
    {
        return $this->connectDate;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set user
     *
     * @param \MG\UserBundle\Entity\User $user
     *
     * @return Ip
     */
    public function setUser(\MG\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MG\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
