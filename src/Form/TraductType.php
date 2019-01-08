<?php

namespace App\Form;
use App\Entity\Langues;

use App\Entity\Traduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\LanguesType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class TraductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('traductfield')
            //->add('source')
            ->add('langues', EntityType::class, array(
                'class'=> Langues::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                    ->orderBy('l.langue', 'ASC');
                },
                'choice_label' => 'langue',
                'multiple' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Traduct::class,
        ]);
    }
}
