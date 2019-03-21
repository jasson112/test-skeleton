<?php


namespace App\Entity;


class Component
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
     * @var string
     */
    private $type;
    /**
     * @var Ad
     */
    private $ad;

    public function __construct(
        Ad $ad,
        string $name,
        string $type
    ) {
        $this->ad = $ad;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return Ad
     */
    public function ad(): Ad
    {
        return $this->ad;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }
}