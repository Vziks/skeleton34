<?php

namespace AppBundle\Entity;

use Application\Sonata\ClassificationBundle\Entity\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Article.
 *
 * @author Anton Prokhorov
 *
 * @ORM\Entity()
 *
 */
class Article
{

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $title;


    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $preview;


    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @var Tag[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Application\Sonata\ClassificationBundle\Entity\Tag")
     */
    protected $tags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Add tag
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\Tag $tag
     *
     * @return Article
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     * @return Article
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;
        return $this;
    }
}
