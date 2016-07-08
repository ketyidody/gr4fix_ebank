<?php
namespace Ebank\Bundles\AccountBundle\Service;

use Doctrine\ORM\EntityManager;
use Ebank\Bundles\AccountBundle\Entity\Account;

class AccountManager
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    public function subtractAmount(Account $account, $amount)
    {

        $account->setBalance($account->getBalance() - $amount);
        $this->entityManager->persist($account);
    }

    public function addAmount(Account $account, $amount)
    {

        $account->setBalance($account->getBalance() + $amount);
        $this->entityManager->persist($account);
    }
}