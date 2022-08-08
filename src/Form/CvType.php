<?php

namespace App\Form;

use App\Entity\Cv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, array('required' => true, 'label'=>"Nom", 'attr'=>array('class'=>'form-control form-group')))
            ->add('prenom', TextType::class, array('required' => true, 'label'=>"Prenom", 'attr'=>array('class'=>'form-control form-group')))
            ->add('age', TextType::class, array('required' => true, 'label'=>"Age", 'attr'=>array('class'=>'form-control form-group')))
            ->add('adresse', TextType::class, array('required' => true, 'label'=>"Adresse", 'attr'=>array('class'=>'form-control form-group')))
            ->add('email', TextType::class, array('required' => true, 'label'=>"Email", 'attr'=>array('class'=>'form-control form-group')))
            ->add('telephone', TextType::class, array('required' => true, 'label'=>"Telephone", 'attr'=>array('class'=>'form-control form-group')))
            ->add('specialite', TextType::class, array('required' => true, 'label'=>"Specialite", 'attr'=>array('class'=>'form-control form-group')))
            ->add('diplome', TextType::class, array('required' => true, 'label'=>"Diplome", 'attr'=>array('class'=>'form-control form-group')))
            ->add('experience', TextType::class, array('required' => true, 'label'=>"Experience", 'attr'=>array('class'=>'form-control form-group')))
            ->add('Envoyer', SubmitType::class, array('attr'=>array('class'=>'btn btn-success')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }
}
