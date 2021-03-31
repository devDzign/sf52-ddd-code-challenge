<?php

namespace App\Tests\SystemTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationTest extends WebTestCase
{

    public function testSuccessful()
    {
        $client = static::createClient();
        self::bootKernel();
        $container = self::$container;
        $router = $container->get('router');
        $crawler = $client->request(Request::METHOD_GET, $router->generate('app.registration'));

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter("form")->form([
                                                   "registration[email]" => "email@email.com",
                                                   "registration[pseudo]" => "pseudo",
                                                   "registration[plainPassword][first]" => "password",
                                                   "registration[plainPassword][second]" => "password"
                                               ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    /**
     * @dataProvider provideFormData
     * @param string $email
     * @param string $pseudo
     * @param array $plainPassword
     * @param string $errorMessage
     */
    public function testFailed(string $email, string $pseudo, array $plainPassword, string $errorMessage)
    {
        $client = static::createClient();
        self::bootKernel();
        $container = self::$container;
        $router = $container->get('router');
        $crawler = $client->request(Request::METHOD_GET, $router->generate('app.registration'));

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter("form")->form([
                                                   "registration[email]" => $email,
                                                   "registration[pseudo]" => $pseudo,
                                                   "registration[plainPassword][first]" => $plainPassword["first"],
                                                   "registration[plainPassword][second]" => $plainPassword["second"],
                                               ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorTextContains('html', $errorMessage);
    }

    /**
     * @return \Generator
     */
    public function provideFormData(): \Generator
    {
        yield [
            "",
            "pseudo",
            ["first" => "password", "second" => "password"],
            "This value should not be blank."
        ];

        yield [
            "fail",
            "pseudo",
            ["first" => "password", "second" => "password"],
            "This value is not a valid email address."
        ];

        yield [
            "email@email.com",
            "",
            ["first" => "password", "second" => "password"],
            "This value should not be blank."
        ];

        yield [
            "email@email.com",
            "pseudo",
            ["first" => "", "second" => ""],
            "This value should not be blank."
        ];

        yield [
            "email@email.com",
            "pseudo",
            ["first" => "fail", "second" => "fail"],
            "This value is too short. It should have 6 characters or more."
        ];

        yield [
            "email@email.com",
            "pseudo",
            ["first" => "password", "second" => "fail_password"],
            "La confirmation doit être similaire au mot de passe"
        ];

        yield [
            "used@email.com",
            "pseudo",
            ["first" => "password", "second" => "password"],
            "This email address already exists."
        ];

        yield [
            "email@email.com",
            "used_pseudo",
            ["first" => "password", "second" => "password"],
            "This pseudo already exists."
        ];
    }
}
