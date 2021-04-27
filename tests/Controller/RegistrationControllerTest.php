<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{

    /**
     * @dataProvider userProvider
     */
    public function testUserRegister($response) {
        $this->assertEquals(200, $response);
    }

    public function userProvider() {
        $responses = [];

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
        array_push($responses, $client->getResponse()->getStatusCode());

        $client->request('POST', '/register', [
            'first_name' => 'aidana',
            'last_name' => 'kenzhetaeva',
            'username' => 'admin',
            'email' => 'kenzhetaeva11@gmail.com',
            'phone_number' => '05584(1234)',
            'is_lawyer' => false,
            'gender' => true,
            'law_licence_no' => '12345678',
            'password' => 'kenzhetaeva',
        ]);
        array_push($responses, $client->getResponse()->getStatusCode());

        $client->request('POST', '/register', [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'username' => 'admin',
            'email' => 'email@email.com',
            'phone_number' => '05584-09876',
            'is_lawyer' => false,
            'gender' => false,
            'law_licence_no' => 'admin',
            'password' => 'qwerty',
        ]);
        array_push($responses, $client->getResponse()->getStatusCode());

        return [
            $responses
        ];
    }
}
