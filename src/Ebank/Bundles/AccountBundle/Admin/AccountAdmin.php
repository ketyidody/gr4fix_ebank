<?php

namespace Ebank\Bundles\AccountBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AccountAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('disponents')
            ->add('balance');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('owner')
            ->add('disponents')
            ->add('balance')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('owner')
            ->add('disponents')
            ->add('balance', null, ['required' => false]);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $entity = $this->getSubject();
        $transactions = $this->getConfigurationPool()->getContainer()->get('doctrine')->getRepository('AccountBundle:Transaction')->findTransactionForAccount($entity);

        $showMapper
            ->with('Account')
                ->add('id')
                ->add('owner')
                ->add('disponents')
                ->add('balance')
            ->end()
            ->with('Transactions')
                ->add('transactions', 'string', [
                    'template' => 'transaction/partial/transaction_list.html.twig',
                    'transactions' => $transactions
                ])
            ->end()
        ;
    }
}
