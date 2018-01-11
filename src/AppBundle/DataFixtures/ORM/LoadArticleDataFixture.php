<?php
/**
 * Class LoadArticleDataFixture.
 * Project skeleton-symfony-backend.
 * @author Anton Prokhorov
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Resource;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Sonata\ClassificationBundle\Entity\Context;
use Application\Sonata\ClassificationBundle\Entity\Tag;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadArticleDataFixture extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $manager->clear();
        $faker = Factory::create('ru_RU');

        $context = $manager->getRepository('ApplicationSonataClassificationBundle:Context')->find('default');

        $tags = $manager->getRepository('ApplicationSonataClassificationBundle:Tag')->findBy(['context' => $context]);

        $imageForList = new Media();
        $imageForList->setBinaryContent(new UploadedFile(
            $this->container->getParameter('kernel.root_dir') . '/Resources/data/test_images/test.jpg',
            'test.jpg',
            'image/jpeg',
            null,
            null,
            true
        ));
        $imageForList->setContext('default');
        $imageForList->setProviderName('sonata.media.provider.image');


        for ($i = 0; $i < 10; $i++) {
            $article = new Article();

            $article
                ->setTitle($faker->title)
                ->setContent($faker->text(400))
                ->setPreview($faker->text(100))
            ;

            $keys = array_rand(is_array($tags) ? $tags : iterator_to_array($tags), rand(2, count($tags)));

            foreach ($keys as $key) {
                $asdasd = $tags[$key];
                $article->addTag($asdasd);
            }

            $manager->persist($article);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
