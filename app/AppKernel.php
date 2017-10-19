<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),

            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),

            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),

            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),

            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),

            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),

            new Nelmio\CorsBundle\NelmioCorsBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),


            new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),

            new JMS\SerializerBundle\JMSSerializerBundle(),

            new Kachkaev\AssetsVersionBundle\KachkaevAssetsVersionBundle(),

            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),

//             Install instruction  https://github.com/hwi/HWIOAuthBundle/blob/master/Resources/doc/resource_owners/facebook.md
//            new Http\HttplugBundle\HttplugBundle(),
//            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),

            new ADW\ConfigBundle\ADWConfigBundle(),
            new ADW\GeoIpBundle\ADWGeoIpBundle(),
            new \ADW\SEOBundle\ADWSEOBundle(),
            new ADW\JsContextBundle\ADWJsContextBundle(),
            new ADW\CommonBundle\ADWCommonBundle(),
            new ADW\SonataMediaExtraBundle\ADWSonataMediaExtraBundle(),

            new AppBundle\AppBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
//            $bundles[] = new Vesax\MaintenanceBundle\VesaxMaintenanceBundle();
            $bundles[] = new \Liip\FunctionalTestBundle\LiipFunctionalTestBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
