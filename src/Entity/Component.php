<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ad
 *
 * @ORM\Table(name="component")
 * @ORM\Entity(repositoryClass="App\Repository\ComponentRepository")
 */
class Component
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     *
     */
    private $type;

    /**
     * Many Ads have One Component.
     * @ORM\ManyToOne(targetEntity="App\Entity\Ad", inversedBy="components")
     * @ORM\JoinColumn(name="ad_content_id", referencedColumnName="id")
     */
    private $ads;

    public function __construct() {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAds(): ?Ad
    {
        return $this->ads;
    }

    public function setAds(?Ad $ads): self
    {
        $this->ads = $ads;

        return $this;
    }
}