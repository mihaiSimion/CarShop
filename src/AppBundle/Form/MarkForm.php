<?php


namespace AppBundle\Form;

use AppBundle\Entity\Profile;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarkForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('name', TextType::class)
            ->add('numberOfCarsProduced', TextType::class)
            ->add('class', TextType::class)
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