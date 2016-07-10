<?php

namespace Ebank\Bundles\AccountBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="Ebank\Bundles\AccountBundle\Repository\AccountRepository")
 */
class Account
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
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Ebank\Bundles\UserBundle\Entity\User", inversedBy="accounts")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @ORM\ManyToMany(targetEntity="Ebank\Bundles\UserBundle\Entity\User", inversedBy="disponentAccounts")
     * @ORM\JoinTable(name="user_disponent_accounts")
     */
    protected $disponents;

    /**
     * @var int
     *
     * @ORM\Column(name="balance", type="integer")
     */
    protected $balance;

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
     * Set owner
     *
     * @param \stdClass $owner
     *
     * @return Account
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \stdClass
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set disponent
     *
     * @param \stdClass $disponent
     *
     * @return Account
     */
    public function setDisponent($disponent)
    {
        $this->disponent = $disponent;

        return $this;
    }

    /**
     * Get disponent
     *
     * @return \stdClass
     */
    public function getDisponent()
    {
        return $this->disponent;
    }

    /**
     * Set balance
     *
     * @param integer $balance
     *
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->disponents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->id;
    }

    /**
     * Add disponent
     *
     * @param \Ebank\Bundles\UserBundle\Entity\User $disponent
     *
     * @return Account
     */
    public function addDisponent(\Ebank\Bundles\UserBundle\Entity\User $disponent)
    {
        $this->disponents[] = $disponent;

        return $this;
    }

    /**
     * Remove disponent
     *
     * @param \Ebank\Bundles\UserBundle\Entity\User $disponent
     */
    public function removeDisponent(\Ebank\Bundles\UserBundle\Entity\User $disponent)
    {
        $this->disponents->removeElement($disponent);
    }

    /**
     * Get disponents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisponents()
    {
        return $this->disponents;
    }
}
