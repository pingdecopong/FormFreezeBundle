<?php
namespace pingdecopong\FormFreezeBundle\Twig\Extension;

use Symfony\Component\Form\FormView;

class FormExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'is_freeze'      => new \Twig_Function_Method($this, 'isFreeze'),
            'is_novalidation'      => new \Twig_Function_Method($this, 'isNoValidation'),
        );
    }

    public function isNoValidation(FormView $view)
    {
        if(!empty($view->vars['novalidation']) && $view->vars['novalidation']){
            return true;
        }

        if($this->isParentNoValidation($view)){
            return true;
        }

        return false;
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

    public function isParentNoValidation(FormView $view)
    {
        while(null !== $view->parent){
            $view = $view->parent;
            if(!empty($view->vars['novalidation']) && $view->vars['novalidation']){
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