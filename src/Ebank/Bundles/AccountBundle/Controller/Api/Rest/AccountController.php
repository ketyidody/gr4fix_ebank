<?php
namespace Ebank\Bundles\AccountBundle\Controller\Api\Rest;

use Ebank\Bundles\AccountBundle\Entity\Account;
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
}