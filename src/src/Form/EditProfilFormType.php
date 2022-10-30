<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class EditProfilFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $data_user = $options['user_data'];

        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'data' => $data_user['lastname']
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'data' => $data_user['firstname']
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
                'data' => $data_user['pseudo']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Mail',
                'data' => $data_user['email']
            ])
            ->add('localisation', TextType::class, [
                'label' => 'Votre département',
                'data' => $data_user['localisation']
            ])
            ->add('photos', FileType::class, [
                'label' => 'Modifier ma photo de profil',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1000k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Erreur avec votre image',
                    ])
                ]
            ])
            ->add('Submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'user_data' => null
        ]);
    }
}
