<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Locale;
//use App\Form\LocaleType;

class LocaleController extends AbstractController
{

    public function setlocaleAction($locale, Request $request)
    {
        $session = $request->getSession();
        $session->set('locale', $locale);
        $this->get('session')->set('_locale', $locale);
        $this->get('session')->set('_locale_2', $locale);
        $request->setLocale($locale);

        return $this->redirect($request->headers->get('referer'));
    }


}
