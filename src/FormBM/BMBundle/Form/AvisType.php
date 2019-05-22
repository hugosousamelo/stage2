<?php

namespace FormBM\BMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use FormBM\BMBundle\Entity\MotCle;
use FormBM\BMBundle\Entity\Entreprise;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;







class AvisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('statut',ChoiceType::class, array(
    'choices'  => array(
        'Salarié'=>'Salarie',
        'Client'=>'Client',
    ),
))
        ->add('Motcle',EntityType::class,array('class'=>Motcle::class,
                'query_builder' => function(\Doctrine\ORM\EntityRepository $entityRepository)
                {
                    return $entityRepository->listeMotCle();
                },'choice_label'=>'libelle'))
        ->add('Entreprise',EntityType::class,array('class'=>Entreprise::class,'query_builder' => function(\Doctrine\ORM\EntityRepository $entityRepository)
                {
                    return $entityRepository->listeEtp();
                },'choice_label'=>'nom',"placeholder"=>'Choisir une entreprise'))
        ->add('Enregistrer', SubmitType::class)
        ->add('Annuler', ResetType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FormBM\BMBundle\Entity\Avis'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formbm_bmbundle_avis';
    }


}
