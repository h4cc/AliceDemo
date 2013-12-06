<?php

/*
 * This file is part of the h4cc/AliceDemo package.
 *
 * (c) Julius Beckmann <github@h4cc.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace h4cc\AliceDemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    /**
     * @var array
     */
    private static $fixtures;

    /**
     * Loading the fixtures for this Test.
     */
    public static function setUpBeforeClass()
    {
        $client = static::createClient();
        $manager = $client->getContainer()->get('h4cc_alice_fixtures.manager');
        static::$fixtures = $manager->loadFiles(array(__DIR__ . '/DataFixtures/Alice/alice.yml'));
        $manager->persist(static::$fixtures);
    }

    /**
     * Remove fixtures afterwards.
     */
    public static function tearDownAfterClass()
    {
        $client = static::createClient();
        $manager = $client->getContainer()->get('h4cc_alice_fixtures.manager');
        $manager->remove(static::$fixtures);
    }

    public function testShowAlice()
    {
        $alice = $this->getFixture('alice');

        $client = static::createClient();
        $crawler = $client->request('GET', '/user/' . $alice->getId());
        $this->assertEquals($alice->getName(), $crawler->filter('body > h1')->text());

        $this->assertTrue($crawler->filter('html:contains("Id: ' . $alice->getId() . '")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Email: ' . $alice->getEmail() . '")')->count() > 0);
    }

    public function testShowAlicePosts()
    {
        $alice = $this->getFixture('alice');

        $client = static::createClient();
        $crawler = $client->request('GET', '/user/' . $alice->getId().'/posts');

        $this->assertTrue($crawler->filter('html:contains("Posts from ' . $alice->getName() . '")')->count() > 0);

        foreach($alice->getPosts() as $post) {
            $this->assertTrue($crawler->filter('html:contains("' . $post->getTitle() . '")')->count() > 0);
        }
    }

    private static function getFixture($name)
    {
        return static::$fixtures[$name];
    }
}
