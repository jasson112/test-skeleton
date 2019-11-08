<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ad
 *
 * @ORM\Table(name="component")
 * @ORM\Entity(repositoryClass="App\Repository\ComponentRepository")
 * @Vich\Uploadable
 */
class Component
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"component"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(
     *     max = 140,
     *     maxMessage = "Your component name cannot be longer than {{ limit }} characters"
     * )
     *
     * @Groups({"component"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Groups({"component"})
     *
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     * @Groups({"component"})
     */
    private $attach;

    /**
     * @Vich\UploadableField(mapping="ad_components", fileNameProperty="attach")
     * @Assert\File(
     *     mimeTypes = {"image/jpg", "image/jpeg", "video/mp4", "video/webm"},
     * )
     * @var File
     */
    private $attachFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $attachUpdatedAt;

    /**
     * Many Ads have One Component.
     * @ORM\ManyToOne(targetEntity="App\Entity\Ad", inversedBy="components")
     * @ORM\JoinColumn(name="ad_content_id", referencedColumnName="id")
     */
    private $ads;

    public function __construct() {}

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name . " | " . $this->type . " | " . $this->id;
    }

    public function setAttachFile(File $attach = null)
    {
        $this->attachFile = $attach;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($attach) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->attachUpdatedAt = new \DateTime('now');
            $this->type = $attach->getMimeType();
        }
    }

    public function getAttachFile()
    {
        return $this->attachFile;
    }


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

    public function getAttach(): ?string
    {
        return $this->attach;
    }

    public function setAttach(string $attach): self
    {
        $this->attach = $attach;

        return $this;
    }

    public function getAttachUpdatedAt(): ?\DateTimeInterface
    {
        return $this->attachUpdatedAt;
    }

    public function setAttachUpdatedAt(\DateTimeInterface $attachUpdatedAt): self
    {
        $this->attachUpdatedAt = $attachUpdatedAt;

        return $this;
    }
}