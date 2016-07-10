<?php
namespace Ebank\Bundles\AccountBundle\Service;

use Doctrine\ORM\EntityManager;
use Ebank\Bundles\AccountBundle\AccountBundle;
use Ebank\Bundles\AccountBundle\Entity\Account;
use Ebank\Bundles\UserBundle\Entity\User;

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

    public function addDisponent(Account $account, User $user)
    {

        $account->addDisponent($user);
        $this->entityManager->persist($account);
        $this->entityManager->flush();
    }

    public function removeDisponent(Account $account, User $user)
    {

        $account->removeDisponent($user);
        $this->entityManager->persist($account);
        $this->entityManager->flush();
    }
}