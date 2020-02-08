<?php

namespace AppBundle\Form;

use AppBundle\Entity\Dealership;
use AppBundle\Entity\Mark;
use AppBundle\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarForm extends AbstractType
{
    const CHOICES = ['YES' => true, 'NO' => false];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('mark', EntityType::class, [
                'label' => 'All Marks',
                'class' => Mark::class,
                'multiple' => false,
                'expanded' => true,
                'choice_label' => 'name'
            ])
            ->add('model', TextType::class)
            ->add('type', TextType::class)
            ->add('km', TextType::class)
            ->add('new', ChoiceType::class, [
                'expanded' => true,
                'choices' => self::CHOICES,
            ])
            ->add('dealerShip', EntityType::class, [
                'label' => 'All DealearShips',
                'class' => Dealership::class,
                'multiple' => false,
                'expanded' => true,
                'choice_label' => 'name'
            ])
            ->add('profiles', EntityType::class, [
                'label' => 'All Profiles',
                'class' => Profile::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'lastName'
            ])
            ->add('Save', SubmitType::class)
            ->setMethod('POST')
            ->getForm();
    }

    public function configureOption(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Profile::class,
        ]);
    }
}