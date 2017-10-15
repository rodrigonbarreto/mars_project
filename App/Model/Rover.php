<?php

namespace App\Model;

use App\Enum\DirectionsEnum;

/**
 * Class Rover
 * @package App\Model
 */
class Rover
{
    /**
     * @var int
     */
    private $x = 0;

    /**
     * @var int
     */
    private $y = 0;

    /**
     * @var int
     */
    private $facing = DirectionsEnum::N;

    /**
     * @return int
     */
    public function getX(): ?int
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x)
    {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY(): ?int
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y)
    {
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getFacing(): int
    {
        return $this->facing;
    }

    /**
     * @param int $facing
     */
    public function setFacing(int $facing)
    {
        $this->facing = $facing;
    }
}
