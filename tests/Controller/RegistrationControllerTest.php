<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testUserRegister()
    {
        $client = static::createClient();

        $client->request('POST', '/register', [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'username' => 'admin',
            'email' => 'email@email.com',
            'phone_number' => '05584',
            'is_lawyer' => true,
            'gender' => true,
            'law_licence_no' => 'admin',
            'password' => 'admin',
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
}
