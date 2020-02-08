<?php

namespace AppBundle\Form;

use AppBundle\Entity\Car;
use AppBundle\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProfileForm extends AbstractType
{
    const CHOICES = ['YES' => true, 'NO' => false];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $this->contructBaseForm($builder)
            ->add('cars', EntityType::class, [
                'label' => 'All Cars',
                'class' => Car::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'model'
            ])
            ->add('Save', SubmitType::class)
            ->setMethod('POST')
            ->getForm();
    }

    public function buildRegistrationForm(FormBuilderInterface $builder, array $options)
    {
        return $this->contructBaseForm($builder)->setMethod('POST')
            ->add('Save', SubmitType::class)
            ->getForm();
    }

    public function buildEditProfileForm(FormBuilderInterface $builder, array $options)
    {
        return $this->constructEditUser($builder)->setMethod('POST')
            ->add('Save', SubmitType::class)
            ->getForm();
    }

    private function contructBaseForm(FormBuilderInterface $builder)
    {
        return $builder->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('username', TextType::class)
            ->add('password', TextType::class)
            ->add('birthday', DateType::class)
            ->add('numberOfAccidents', TextType::class)
            ->add('driverLicenseCategory', TextType::class)
            ->add('numberOfAccidents', TextType::class)
            ->add('casco', ChoiceType::class, [
                'expanded' => true,
                'choices' => self::CHOICES,
            ])
            ->add('asuranceExpireDate', DateType::class);
    }

    private function constructEditUser(FormBuilderInterface $builder)
    {
        return $builder->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('username', TextType::class)
            ->add('birthday', DateType::class)
            ->add('numberOfAccidents', TextType::class)
            ->add('driverLicenseCategory', TextType::class)
            ->add('numberOfAccidents', TextType::class)
            ->add('casco', ChoiceType::class, [
                'expanded' => true,
                'choices' => self::CHOICES,
            ])
            ->add('asuranceExpireDate', DateType::class);
    }

    public function configureOption(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Profile::class,
        ]);
    }
}
