<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType; // Import FileType
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('age', TextType::class, [
                'required' => true,

                'label' => 'Age',
                'label_attr' => ['style' => 'color: black;'], // Set label color to black
    
            ])
          

            ->add('sexe', ChoiceType::class, [
                'required' => true,

                'choices' => [
                    'Masculin' => 'Masculin',
                    'Féminin' => 'Féminin',
                ],
                
                'label_attr' => ['style' => 'color: black;'], // Set label color to black
            ])
            
            ->add('role', ChoiceType::class, [
                'required' => true,

                'choices' => [
                    'Medecin' => 'Medecin',
                    'Coach' => 'Coach',
                    'Client' => 'Client',
                ],
                'label' => 'Role',
                'label_attr' => ['style' => 'color: black;'],
              
            ])
            ->add('image', FileType::class, [
                'required' => true,
                'label' => 'Télécharger une image',
                'label_attr' => ['style' => 'color: black;'], // Set label color to black
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
                'label_attr' => ['style' => 'color: black;'], // Set label color to black
               
            ])
             
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    
                ],
            ])

            ->add('Save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['style' => 'background-color: #da2424; color: black; padding: 10px 20px; font-size: 18px; font-weight: bold; border: none; cursor: pointer; box-shadow: 0 0 5px rgba(0, 0, 0, 0.6);'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
