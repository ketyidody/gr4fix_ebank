<?php
namespace Ebank\Bundles\AccountBundle\Controller\Api\Rest;

use Ebank\Bundles\AccountBundle\Entity\Account;
use Ebank\Bundles\UserBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("Account", pluralize=false)
 */
class AccountController extends FOSRestController
{

    /**
     * Returns the current balance on an account
     *
     * @param $accountId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getBalanceAction($accountId)
    {

        /** @var Account $account */
        $account = $this->getDoctrine()->getRepository('AccountBundle:Account')->find($accountId);

        return $this->json($account->getBalance());
    }

    /**
     * @param Account $account
     * @param User $user
     */
    public function addDisponentAction(Account $account, User $user)
    {

        $this->get('ebank.account.account_manager')->addDisponent($account, $user);
    }

    /**
     * @param Account $account
     * @param User $user
     */
    public function removeDisponentAction(Account $account, User $user)
    {

        $this->get('ebank.account.account_manager')->removeDisponent($account, $user);
    }
}