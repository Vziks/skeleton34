<?php

namespace AppBundle\DataFixtures\ORM;

use Application\Sonata\ClassificationBundle\Entity\Context;
use Application\Sonata\ClassificationBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class LoadArticleTagData
 *
 * @package AppBundle\DataFixtures\ORM\Test
 * @author Artur Vesker
 */
class LoadArticleTagData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('ru_RU');

        $context = $manager->getRepository('ApplicationSonataClassificationBundle:Context')->find('default');

        for ($i = 0; $i < 50; $i++) {

            $tag = new Tag();
            $tag->setName($faker->text(10));
            $tag->setSlug(uniqid());
            $tag->setEnabled(true);
            $tag->setContext($context);

            $manager->persist($tag);

        }

        $manager->flush();
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return 0;
    }

}
