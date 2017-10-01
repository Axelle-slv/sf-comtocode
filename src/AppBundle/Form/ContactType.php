<?php
/**
 * Created by PhpStorm.
 * User: axelle
 * Date: 01/10/17
 * Time: 14:06
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => new NotBlank(),
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'constraints' => new NotBlank(),
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'required' => true,
                'attr' => array(
                    'placeholder' => 'exemple@exemple.fr'
                ),
                'constraints' => new NotBlank(),
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de téléphone',
                'required' => true,
                'attr' => array(
                    'placeholder' => '0607080910'
                ),
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('max' => 10)),
                ),
            ])
            ->add('message', TextAreaType::class, [
                'label' => 'Message',
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Exprimez-vous ici !'
                ),

                'constraints' => new NotBlank(),
            ])
            ->add('send', SubmitType::class, array(
                'label' => 'Envoyer',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

}