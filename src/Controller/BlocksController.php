<?php


namespace App\Controller;

use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlocksController extends AbstractController
{
    public function cssAction()
    {
        return $this->render('Blocks/css.html.twig');
    }

    public function jsAction():Response
    {
        return $this->render('Blocks/js.html.twig');
    }

    public function leftSideAction():Response
    {
        return $this->render('Blocks/left_sidebar.html.twig');
    }

    public function headerAction(Request $request)
    {
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
                FROM App:Locale p
                WHERE p.enabled = :enabled
                ORDER BY p.title ASC'
        )->setParameter('enabled', true);
        $languages = $query->getResult();

        $current_locale = "";

        if($request->getLocale()){
            $current_locale = $request->getLocale();
        }else {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT p
                    FROM App:Locale p
                    WHERE p.enabled = :enabled AND
                    p.is_default = :default
                    ORDER BY p.title ASC'
            )->setParameter('enabled', true)->setParameter('default', true);
            $defaultlanguages = $query->getResult();
            foreach($defaultlanguages as $language)
            {
                $session->set('locale', $language->getLocaleCode());
                $current_locale = $language->getLocaleCode();
            }
        }

        return $this->render('Blocks/header.html.twig',array(
                'languages' => $languages,
                'currentlocale' => $current_locale)
        );
    }

    public function rightSideAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository(Tag::class)->findTrendingTags();

        return $this->render('Blocks/right_side.html.twig', ['tags' => $tags]);
    }

    public function footerAction()
    {
        return $this->render('Blocks/footer.html.twig');
    }

}