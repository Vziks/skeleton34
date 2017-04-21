<?php

namespace AppBundle\Controller;

use ADW\CommonBundle\Annotation\ApiDoc;
use ADW\CommonBundle\Controller\Controller;
use ADW\CommonBundle\Exception\InvalidFormException;
use ADW\CommonBundle\Exception\ValidationViolationException;
use AppBundle\AppBundle;
use AppBundle\Entity\AdminUser;
//use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class SecurityController.
 *
 * @package AppBundle\Controller
 * @author Anton Prokhorov
 *
 */
class AdminSecurityController extends Controller
{
    /**
     * Авторизация по email и паролю
     *
     * @ApiDoc(
     *      section="admin",
     *      parameters={
     *         { "name"="_email", "dataType"="string", "required"=true, "description"="Email" },
     *         { "name"="_password", "dataType"="string", "required"=true, "description"="Пароль" },
     *      },
     *      statusCodes={
     *          302="Успешно",
     *          200="Успешно"
     *      }
     * )
     * @Route("/admin/security/login/", name="app.security.login", options={"expose"=true})
     * @Method("POST")
     */
    public function loginAction()
    {
        throw new \RuntimeException('Invalid security configuration. Set correct check_login path');
    }


    /**
     * @Route("/admin/auth", name="admin_auth")
     */
    public function loginfAction()
    {

        if($this->getUser()) {
            return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
        }
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/admin/logout", name="logout")
     */
    public function logoutAction()
    {
    }

}