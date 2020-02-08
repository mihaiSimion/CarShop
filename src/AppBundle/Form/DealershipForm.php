<?php

namespace AppBundle\Form;

use AppBundle\Entity\Car;
use AppBundle\Entity\Dealership;
use AppBundle\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DealershipForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('cars', EntityType::class, [
                'label' => 'All Cars',
                'class' => Car::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'model'
            ])
            ->add('director', EntityType::class, [
                'label' => 'All Directors',
                'class' => Profile::class,
                'multiple' => false,
                'expanded' => true,
                'choice_label' => 'firstName'
            ])
            ->add('closeHour', DateTimeType::class)
            ->add('Save', SubmitType::class)
            ->setMethod('POST')
            ->getForm();
    }

    public function buildEditForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('director', EntityType::class, [
                'label' => 'All Directors',
                'class' => Profile::class,
                'multiple' => false,
                'expanded' => true,
                'choice_label' => 'firstName'
            ])
            ->add('closeHour', DateTimeType::class)
            ->add('Save', SubmitType::class)
            ->setMethod('POST')
            ->getForm();
    }

    public function configureOption(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Dealership::class,
        ]);
    }

}