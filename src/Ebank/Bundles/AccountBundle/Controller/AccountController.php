<?php

namespace Ebank\Bundles\AccountBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ebank\Bundles\AccountBundle\Entity\Account;

/**
 * Account controller.
 *
 * @Route("/account")
 */
class AccountController extends Controller
{
    /**
     * Lists all Account entities.
     *
     * @Route("/", name="account_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $accounts = $em->getRepository('AccountBundle:Account')->findAccountsForUser($user);

        return $this->render('account/index.html.twig', array(
            'accounts' => $accounts,
        ));
    }

    /**
     * Finds and displays a Account entity.
     *
     * @Route("/{id}", name="account_show")
     * @Method("GET")
     */
    public function showAction(Account $account)
    {

        return $this->render('account/show.html.twig', array(
            'account' => $account,
            'transactions' => $this->getDoctrine()->getRepository('AccountBundle:Transaction')->findTransactionForAccount($account),
        ));
    }
}
