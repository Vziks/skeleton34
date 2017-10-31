<?php

namespace AppBundle\Controller;

use DataDog\AuditBundle\Entity\AuditLog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    private function repo($class)
    {
        return $this->getDoctrine()->getManager()->getRepository($class);
    }


    /**
     * @Method("GET")
     * @Route("/audit", name="audit")
     */
    public function auditAction(Request $request)
    {

//        Pagination::$defaults = array_merge(Pagination::$defaults, ['limit' => 25]);




//        $qb = $this->repo("DataDogAuditBundle:AuditLog")
        $qb = $this->repo(AuditLog::class)
            ->createQueryBuilder('a')
            ->addSelect('s', 't', 'b')
            ->innerJoin('a.source', 's')
            ->leftJoin('a.target', 't')
            ->leftJoin('a.blame', 'b');

//        $sdc = $qb->getQuery()->getResult();

//        dump($sdc);
//        die;

//        $options = [
//            'sorters' => ['a.loggedAt' => 'DESC'],
//            'applyFilter' => [$this, 'filters'],
//        ];
//
//        $sourceClasses = [
//            Pagination::$filterAny => 'Any Source Class',
//        ];

        foreach ($this->getDoctrine()->getManager()->getMetadataFactory()->getAllMetadata() as $meta) {
            if ($meta->isMappedSuperclass || strpos($meta->name, 'DataDog\AuditBundle') === 0) {
                continue;
            }
            $parts = explode('\\', $meta->name);
            $sourceClasses[$meta->name] = end($parts);
        }


//        dump($sourceClasses);
//
//        die;

        $users = [
            Pagination::$filterAny => 'Any User',
            'null' => 'Unknown',
        ];
        foreach ($this->repo('AppBundle:User')->findAll() as $user) {
            $users[$user->getId()] = (string) $user;
        }

        $logs = new Pagination($qb, $request, $options);
        return compact('logs', 'sourceClasses', 'users');
    }

}
