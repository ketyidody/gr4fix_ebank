<?php

namespace Ebank\Bundles\UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends AbstractAdmin
{

    private static function flattenRoles($rolesHierarchy)
    {
        $flatRoles = array();
        foreach($rolesHierarchy as $roles) {

            if(empty($roles)) {
                continue;
            }

            foreach($roles as $role) {
                if(!isset($flatRoles[$role])) {
                    $flatRoles[$role] = $role;
                }
            }
        }

        return $flatRoles;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('username')
            ->add('email')
            ->add('phone')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('username')
            ->add('email')
            ->add('phone')
            ->add('enabled')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $container = $this->getConfigurationPool()->getContainer();
        $roles = $container->getParameter('security.role_hierarchy.roles');

        $rolesChoices = self::flattenRoles($roles);

        $formMapper
            ->add('name')
            ->add('username')
            ->add('email')
            ->add('phone')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('accounts', 'sonata_type_model', [
                'class' => 'AccountBundle:Account',
                'multiple' => true
            ])
            ->add('locked')
            ->add('expiresAt')
            ->add('roles', 'choice', array(
                    'choices'  => $rolesChoices,
                    'multiple' => true
                )
            )
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('username')
            ->add('email')
            ->add('phone')
            ->add('enabled')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
        ;
    }
}
