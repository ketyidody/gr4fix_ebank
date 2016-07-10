<?php

namespace Ebank\Bundles\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Ebank\Bundles\UserBundle\Repository\UserRepository")
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Address", mappedBy="user")
     */
    protected $addresses;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=false, unique=true)
     */
    protected $phone;

    /**
     * @ORM\OneToMany(targetEntity="Ebank\Bundles\AccountBundle\Entity\Account", mappedBy="owner")
     */
    protected $accounts;

    /**
     * @ORM\ManyToMany(targetEntity="Ebank\Bundles\AccountBundle\Entity\Account", mappedBy="disponents")
     */
    protected $disponentAccounts;

    public function __construct()
    {

        parent::__construct();
        $this->addresses = new ArrayCollection();
        $this->accounts = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set address
     *
     * @param string $addresses
     *
     * @return User
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add address
     *
     * @param \Ebank\Bundles\UserBundle\Entity\Address $address
     *
     * @return User
     */
    public function addAddress(\Ebank\Bundles\UserBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Ebank\Bundles\UserBundle\Entity\Address $address
     */
    public function removeAddress(\Ebank\Bundles\UserBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Set account
     *
     * @param \Ebank\Bundles\AccountBundle\Entity\Account $account
     *
     * @return User
     */
    public function setAccount(\Ebank\Bundles\AccountBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Ebank\Bundles\AccountBundle\Entity\Account
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Add disponentAccount
     *
     * @param \Ebank\Bundles\AccountBundle\Entity\Account $disponentAccount
     *
     * @return User
     */
    public function addDisponentAccount(\Ebank\Bundles\AccountBundle\Entity\Account $disponentAccount)
    {
        $this->disponentAccounts[] = $disponentAccount;

        return $this;
    }

    /**
     * Remove disponentAccount
     *
     * @param \Ebank\Bundles\AccountBundle\Entity\Account $disponentAccount
     */
    public function removeDisponentAccount(\Ebank\Bundles\AccountBundle\Entity\Account $disponentAccount)
    {
        $this->disponentAccounts->removeElement($disponentAccount);
    }

    /**
     * Get disponentAccounts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisponentAccounts()
    {
        return $this->disponentAccounts;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Add account
     *
     * @param \Ebank\Bundles\AccountBundle\Entity\Account $account
     *
     * @return User
     */
    public function addAccount(\Ebank\Bundles\AccountBundle\Entity\Account $account)
    {
        $this->accounts[] = $account;

        return $this;
    }

    /**
     * Remove account
     *
     * @param \Ebank\Bundles\AccountBundle\Entity\Account $account
     */
    public function removeAccount(\Ebank\Bundles\AccountBundle\Entity\Account $account)
    {
        $this->accounts->removeElement($account);
    }
}
