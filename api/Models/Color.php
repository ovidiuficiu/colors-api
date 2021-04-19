<?php


namespace Models;


class Color
{

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $hexcode
     */
    protected $hexCode;

    /**
     * @var int $id
     */
    protected $id;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name) : Color
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getHexCode(): string
    {
        return $this->getHexCode();
    }

    /**
     * @param $code
     * @return $this
     */
    public function setHexCode($code): Color
    {
        $this->hexCode = $code;

        return $this;
    }
}