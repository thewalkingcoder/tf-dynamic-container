<?php

namespace App\Tests\Fonctionnal;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostApiTest extends WebTestCase
{


    public function testBehaviourApi()
    {
        $client = static::createClient();

        $client->getContainer()->set(
            FakePostApiRepository::class,
            new FakePostApiRepository(
                [['id' => 2, 'name' => 'Fake post']]
            )
        );

        $client->request('GET', '/');

        $this->assertStringContainsString(
            'Fake post',
            $client->getResponse()->getContent()
        );
    }

    public function testBehaviourWithForm()
    {
        $client = static::createClient();
        $client->disableReboot();
        $client->getContainer()->set(
            FakePostApiRepository::class,
            new FakePostApiRepository(
                [['id' => 2, 'name' => 'Fake data']]
            )
        );

        $crawler = $client->request('GET', '/form');
        $buttonCrawlerNode = $crawler->selectButton('launch');

        $form = $buttonCrawlerNode->form([], 'POST');
        $form['post[id]']->setValue('2');
        $client->submit($form);

       $this->assertStringContainsString(
            'Fake data',
            $client->getResponse()->getContent()
        );

    }

    public function testBehaviourWithMessage()
    {
        $client = static::createClient();

        $client->getContainer()->set(
            FakePostApiRepository::class,
            new FakePostApiRepository(
                [['id' => 2, 'name' => 'Fake post with message']]
            )
        );

        $client->request('GET', '/message');

        $json = json_decode(file_get_contents(__DIR__.'/../../var/data.json'));

        $this->assertSame(2, $json->id);
        $this->assertSame('Fake post with message', $json->name);
    }
}
