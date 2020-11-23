<?php


namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label_format' => 'Votre email',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('name', TextType::class, [
                'label_format' => 'Votre nom',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label_format' => 'Contenu de votre message',
                'label_attr' => ['class' => 'col-form-label'],
                'attr' => [
                    'class' => 'form-control', 
                    'rows' => 7,
                    'placeholder' => 'Bonjour, je vous contacte...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
