<?php

namespace Ebank\Bundles\AccountBundle\Form;

use Doctrine\ORM\EntityRepository;
use Ebank\Bundles\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class TransactionType extends AbstractType
{

    /**
     * @var User
     */
    protected $user;

    public function __construct(TokenStorage $securityToken)
    {
        $this->user = $securityToken->getToken()->getUser();
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $qb = function(EntityRepository $entityRepository) {
            return $entityRepository->createQueryBuilder('a')
                ->select('a')
                ->where('a.owner = :user')
                ->orWhere(':user MEMBER OF a.disponents')
                ->setParameter('user', $this->user);
        };

        $builder
            ->add('amount')
            ->add('accountFrom', 'entity', [
                'placeholder' => 'Choose an option',
                'class' => 'Ebank\Bundles\AccountBundle\Entity\Account',
                'query_builder' => $qb
            ])
            ->add('accountTo')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ebank\Bundles\AccountBundle\Entity\Transaction',
        ));
    }
}
