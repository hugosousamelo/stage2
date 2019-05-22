<?php

namespace FormBM\BMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use FormBM\BMBundle\Entity\Logo;


class EntrepriseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class,array('label'=>'Nom *'))
        ->add('ville',TextType::class,array('label'=>'Ville *'))
        ->add('codePostal',TextType::class,array('label'=>'Code postal *','attr'=>array('minlength'=>5,'maxlength'=>5)))
        ->add('siteWeb',TextType::class,array('label'=>'Site web *'))

        ->add('nomDirigeant',TextType::class,array('label'=>'Nom du contact *'))
        ->add('numTel',TextType::class,array('label'=>'Numéro de téléphone *','attr'=>array('minlength'=>10,'maxlength'=>10)))
        ->add('mail',TextType::class,array('label'=>'e-mail *'))
        ->add('logo',EntityType::class,array('class'=>Logo::class,'choice_label'=>'nom','label'=>'Logo *','placeholder'=>'choisir le logo de l\'entreprise'))
        ->add('numUnique',HiddenType::class)

        ->add('Enregistrer', SubmitType::class)
        ->add('Annuler', ResetType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FormBM\BMBundle\Entity\Entreprise'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formbm_bmbundle_entreprise';
    }


}
