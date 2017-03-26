<?php

namespace MG\UserBundle\Entity;

/**
 * Ip
 */
class Ip
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $connectDate;

    /**
     * @var string
     */
    private $ip;


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
}
