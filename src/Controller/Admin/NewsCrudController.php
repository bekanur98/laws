<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $imageFile = Field::new('thumbnailFile')->setFormType(VichImageType::class);
        $image = ImageField::new('thumbnail')->setBasePath('/images/thumbnails');

        $fields = [
            IdField::new('id')->hideOnForm(),
            TextField::new('title_news', 'Title'),
            TextEditorField::new('body_news', 'Content'),
        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else
            $fields[] = $imageFile;

        return $fields;
    }
}
