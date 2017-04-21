<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AdminUser
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminUserRepository")
 * @ORM\Table(name="admin__user")
 * @ORM\HasLifecycleCallbacks()
 */

class AdminUser implements UserInterface
{
    use Timestampable;

    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var string
     *
     * @Assert\Length(min="6")
     */
    protected $plainPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $passwordUpdatedAt;

    /**
     * AdminUser constructor.
     *
     * @param string $email
     * @param string $plainPassword
     */
    public function __construct($email = null, $plainPassword = null)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
    }


    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return ['ROLE_SUPER_ADMIN','ROLE_SONATA_ADMIN','ROLE_USER'];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return AdminUser
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return AdminUser
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return AdminUser
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPasswordUpdatedAt()
    {
        return $this->passwordUpdatedAt;
    }

    /**
     * @param \DateTime $passwordUpdatedAt
     * @return AdminUser
     */
    public function setPasswordUpdatedAt($passwordUpdatedAt)
    {
        $this->passwordUpdatedAt = $passwordUpdatedAt;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string)$this->getUsername();
    }


}