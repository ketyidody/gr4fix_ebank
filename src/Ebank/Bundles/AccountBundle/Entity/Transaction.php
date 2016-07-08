<?php

namespace Ebank\Bundles\AccountBundle\Entity;

use Ebank\Bundles\AccountBundle\Entity\Account;
use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="Ebank\Bundles\AccountBundle\Repository\TransactionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Transaction
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
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Ebank\Bundles\AccountBundle\Entity\Account")
     * @ORM\JoinColumn(name="account_from", referencedColumnName="id")
     */
    private $accountFrom;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Ebank\Bundles\AccountBundle\Entity\Account")
     * @ORM\JoinColumn(name="account_to", referencedColumnName="id")
     */
    private $accountTo;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Ebank\Bundles\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;


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
     * Set account
     *
     * @param \stdClass $accountFrom
     *
     * @return Transaction
     */
    public function setAccountFrom($accountFrom)
    {
        $this->accountFrom = $accountFrom;

        return $this;
    }

    /**
     * Get account
     *
     * @return Account
     */
    public function getAccountFrom()
    {
        return $this->accountFrom;
    }

    /**
     * Set user
     *
     * @param \stdClass $user
     *
     * @return Transaction
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \stdClass
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCurrentDate()
    {
        $this->date = new \DateTime();

        return $this;
    }

    /**
     * Set date
     *
     * @return Transaction
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set accountTo
     *
     * @param \stdClass $accountTo
     *
     * @return Transaction
     */
    public function setAccountTo($accountTo)
    {
        $this->accountTo = $accountTo;

        return $this;
    }

    /**
     * Get accountTo
     *
     * @return Account
     */
    public function getAccountTo()
    {
        return $this->accountTo;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Transaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }
}

