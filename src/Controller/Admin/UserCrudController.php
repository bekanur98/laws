<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('username', 'Username'),
            TextField::new('first_name', 'Name'),
            TextField::new('last_name', 'Surname'),
            Field::new('gender', 'Gender'),
            TelephoneField::new('phone_number', 'Phone Number'),
            EmailField::new('email', 'Email'),
            Field::new('password', 'Password'),
            Field::new('is_lawyer', 'Is Lawyer?'),
            TextField::new('law_licence_no', 'Law Licence №'),
        ];
    }
}
