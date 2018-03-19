<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use AppBundle\DataFixtures\ORM\LoadAdminData as FixtureAdmin;

/**
 * Class AdminFunctionalTest.
 * Project skeleton-symfony-backend.
 * @author Anton Prokhorov
 */
class AdminFunctionalTest extends WebTestCase
{
    protected function setUp()
    {
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadAdminData'
        ]);
    }

    protected function tearDown()
    {
        $this->loadFixtures([]);

        parent::tearDown();
    }

    /**
     * @return Client
     */
    public function testAdminLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/login');

        $form = $crawler->filter('button[type="submit"]')->form();

        $fakeAdmin = FixtureAdmin::getFakeAdmin();

        $form['_username'] = $fakeAdmin->getUsername();
        $form['_password'] = $fakeAdmin->getPlainPassword();

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();

        $client->request('GET', '/admin/dashboard');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        return $client;
    }

    /**
     * @depends      testAdminLogin
     * @dataProvider menuItemsListProvider
     * @param $link
     * @param Client $client
     */
    public function testMenuItemList($link, Client $client)
    {
        $client->request('GET', $link);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @depends      testAdminLogin
     * @dataProvider menuItemsCreateProvider
     * @param $link
     * @param Client $client
     */
    public function testMenuItemCreate($link, Client $client)
    {
        $client->request('GET', $link);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @depends testAdminLogin
     *
     * @param Client $client
     */
    public function testAdminLogout(Client $client)
    {
        $client->request('GET', '/admin/logout');
        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();

        $client->request('GET', '/admin/dashboard');
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    /**
     * @return array
     */
    public function menuItemsCreateProvider()
    {
        return [
            ['/admin/sonata/user/user/create'],
            ['/admin/sonata/user/group/create'],
            ['/admin/sonata/classification/category/create?hide_context=0'],
            ['/admin/sonata/classification/tag/create?hide_context=0'],
            ['/admin/sonata/classification/collection/create?hide_context=0'],
            ['/admin/sonata/classification/context/create'],
            ['/admin/sonata/media/media/create?context=default&category=1&hide_context=0'],
            ['/admin/sonata/media/gallery/create?context=default'],
            ['/admin/app/article/create']
        ];
    }


    /**
     * @return array
     */
    public function menuItemsListProvider()
    {
        return [

            ['/admin/sonata/user/user/list'],
            ['/admin/sonata/user/group/list'],
            ['/admin/sonata/classification/category/tree?hide_context=0'],
            ['/admin/sonata/classification/tag/list'],
            ['/admin/sonata/classification/collection/list'],
            ['/admin/sonata/classification/context/list'],
            ['/admin/sonata/media/media/list'],
            ['/admin/sonata/media/gallery/list']

        ];
    }
}
