<?php
namespace pingdecopong\FormFreezeBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FreezeTypeExtension extends AbstractTypeExtension
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('freeze', $options['freeze']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['freeze'] = $form->getConfig()->getAttribute('freeze');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'freeze' => false,
        ));
    }

    public function getExtendedType()
    {
        return 'form';
    }
}