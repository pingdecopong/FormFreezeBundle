<?php
namespace pingdecopong\FormFreezeBundle\Twig\Extension;

use Symfony\Component\Form\FormView;

class FormExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'is_freeze'      => new \Twig_Function_Method($this, 'isFreeze'),
        );
    }

    public function isFreeze(FormView $view)
    {
        if(!empty($view->vars['freeze']) && $view->vars['freeze']){
            return true;
        }

        if($this->isParentFreeze($view)){
            return true;
        }

        return false;
    }

    public function isParentFreeze(FormView $view)
    {
        while(null !== $view->parent){
            $view = $view->parent;
            if(!empty($view->vars['freeze']) && $view->vars['freeze']){
                return true;
            }
        }

        return false;
    }

    public function getName()
    {
        return 'formfreeze_twig_extension_form';
    }
}