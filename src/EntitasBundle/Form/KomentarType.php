<?php

namespace EntitasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class KomentarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isikomen')
            ->add('createAt','date',array('format'=>'dd-MM-yyyy'))
            ->add('updateAt','date',array('format'=>'dd-MM-yyyy'))
            ->add('postingan',null,['property'=>'judul'])
            ->add('pengkomen')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EntitasBundle\Entity\Komentar'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'entitasbundle_komentar';
    }
}
