<?php
namespace Ebank\Bundles\AccountBundle\Service;

use Ebank\Bundles\AccountBundle\Entity\Transaction;

class TransactionManager
{

    /**
     * @var AccountManager
     */
    protected $accountManager;

    public function __construct(AccountManager $accountManager)
    {

        $this->accountManager = $accountManager;
    }

    public function accomplishTransaction(Transaction $transaction)
    {

        $amount = $transaction->getAmount();
        $accountFrom = $transaction->getAccountFrom();
        $accountTo = $transaction->getAccountTo();

        $this->accountManager->subtractAmount($accountFrom, $amount);
        $this->accountManager->addAmount($accountTo, $amount);
    }
}