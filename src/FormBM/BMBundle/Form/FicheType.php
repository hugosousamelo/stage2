<?php

namespace FormBM\BMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use FormBM\BMBundle\Entity\Entreprise;
use FormBM\BMBundle\Entity\SousTheme;
use FormBM\BMBundle\Entity\Theme;


class FicheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('entreprise',EntityType::class,array('class'=>Entreprise::class,'placeholder' => 'Selectionner une entreprise','query_builder' => function(\Doctrine\ORM\EntityRepository $entityRepository)
                {
                    return $entityRepository->listeEtp();
                },'choice_label'=>'nom'))
                ->add('theme', EntityType::class, array(
                'class'       => 'FormBM\BMBundle\Entity\Theme',
                'placeholder' => 'Selectionner un theme',
                'mapped'=>false,
            ))
              ->add('Suivant', SubmitType::class);
              

    

            $builder->get('theme')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                
              $form = $event->getForm();

              $form->getParent()
              ->remove('Suivant')
              ->add('SousTheme',EntityType::class,array(

                'class' => 'FormBM\BMBundle\Entity\SousTheme',
                'placeholder' =>' Selectionner un sous-thème',
                'choices' => $form->getData()->getSousthemes()
              ))
              ->add('pourcentage',IntegerType::class,array('label'=>'Pourcentage ( Saisir le pourcentage - NA par defaut )
','required'=>false,'attr' => array('placeholder' => 'N/A','max'=>100,'min'=>0)))
                ->add('Enregistrer', SubmitType::class);
            }
        );
                
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FormBM\BMBundle\Entity\Fiche'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formbm_bmbundle_fiche';
    }


}
