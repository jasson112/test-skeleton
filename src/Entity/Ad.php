<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Ad
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var Collection
     */
    private $components;

    public function __construct(
        string $name
    ) {
        $this->name = $name;

        $this->components = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function components(): Collection
    {
        return $this->components;
    }
}