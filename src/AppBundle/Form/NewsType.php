<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class NewsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, ['label' => 'name'])
            ->add('description')
            ->add('parentCategories', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'multiple' => false,
                'choice_label' => 'name',
                 'label' => 'parent.category'
            ))
            ->add('similarNews', EntityType::class, array(
                'class' => 'AppBundle:News',
                'multiple' => true,
                'required' => false,
                'choice_label' => 'name',
                'label' => 'similar.news'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\News'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_news';
    }


}
