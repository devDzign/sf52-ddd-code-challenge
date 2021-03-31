<?php

namespace App\Tests\EndToEndTests;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Panther\PantherTestCase;

/**
 * Class VisitorTest
 * @package App\Tests\EndToEndTests
 */
class VisitorTest extends PantherTestCase
{
    public function test()
    {
        $client = static::createPantherClient();

        $crawler = $client->request(Request::METHOD_GET, '/registration');

        $counter = random_int(1, 1000);
        $form       = $crawler->filter("form")->form([
                                                   "registration[email]" => "email{$counter}@email.com",
                                                   "registration[pseudo]" => "pseudo" . $counter,
                                                   "registration[plainPassword][first]" => "password",
                                                   "registration[plainPassword][second]" => "password"
                                               ]);

        $client->submit($form);

        $this->assertSelectorTextContains(
            '.flash-test',
            'Bienvenue sur Code Challenge ! Votre inscription a été effectuée avec succès !'
        );
    }
}
