<?php
namespace App\Controller;

use App\Entity\Tag;
use Snilius\Twig\SortByFieldExtension;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TagsListController extends AbstractController {
    /**
     * @Route("/tags", name="showTagsList")
     */
    public function showTagsList() {
        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repository->findAll();

        return $this->render("Layouts/tags/tags_by_name.html.twig", ['tags'=>$tags]);
    }
}
?>