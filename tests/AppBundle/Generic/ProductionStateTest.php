<?php

namespace Tests\AppBundle\Genetic;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class ProductionStateTest.
 * Project skeleton-symfony-backend.
 * @author Anton Prokhorov
 */

class ProductionStateTest extends WebTestCase
{
    /**
     * @group production
     */
    public function testFaviconIsExists()
    {
        static::bootKernel();

        $kernelRootDir = static::$kernel
            ->getContainer()
            ->get('kernel')
            ->getRootDir();

        $this->assertFileExists($kernelRootDir . '/../web/favicon.ico');
    }

    /**
     * @group production
     */
    public function test404()
    {
        $client = static::createClient();

        $client->request('GET', sprintf('/porno-hardcore/%s', microtime(true)));

        $this->assertTrue($client->getResponse()->isNotFound());
    }
}
