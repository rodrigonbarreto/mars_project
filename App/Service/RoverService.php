<?php

namespace App\Service;

use App\Enum\CommandsEnum;
use App\Enum\DirectionsEnum;
use App\Model\Rover;

class RoverService
{
    private $rover;
    /**
     * RoverService constructor.
     * @param Rover $rover
     */
    public function __construct(Rover $rover)
    {
        $this->rover = $rover;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $f
     */
    public function setPosition(int $x, int $y, int $f)
    {
         $this->rover->setX($x);
         $this->rover->setY($y);
         $this->rover->setFacing($f);
    }

    /**
     * @return string
     */
    public function printPosition()
    {
        switch ($this->rover->getFacing()) {
            case DirectionsEnum::N:
                $cord = DirectionsEnum::N_STR;
                break;
            case DirectionsEnum::E:
                $cord = DirectionsEnum::E_STR;
                break;
            case DirectionsEnum::S:
                $cord = DirectionsEnum::S_STR;
                break;
            case DirectionsEnum::W:
                $cord = DirectionsEnum::W_STR;
                break;
            default:
                $cord = DirectionsEnum::N_STR;
                break;
        }

        return sprintf("%s %s %s", $this->rover->getX(), $this->rover->getY(), $cord);
    }

    public function getCommands(string $commands)
    {
        foreach(str_split($commands) as $k=>$v)
        {
            $this->process($v);
        }
    }

    private function process (string $command)
    {
        switch ($command) {
            case CommandsEnum::COORDINATE_L:
                $this->turnLeft();
                break;
            case CommandsEnum::COORDINATE_R:
                $this->turnRight();
                break;
            case CommandsEnum::COORDINATE_M:
                $this->move();
                break;
            default:
                throw new \Exception("Speak in Mars language, please!");
                break;
        }
    }

    private function move()
    {
        switch ($this->rover->getFacing()) {
            case DirectionsEnum::N:
                $this->rover->setY($this->rover->getY()+1);
                break;
            case DirectionsEnum::E:
                $this->rover->setX($this->rover->getX()+1);
                break;
            case DirectionsEnum::S:
                $this->rover->setY($this->rover->getY()-1);
                break;
            case DirectionsEnum::W:
                $this->rover->setX($this->rover->getX()-1);
                break;
        }
    }

    private  function turnLeft()
    {
        $facing = ($this->rover->getFacing() -1) < DirectionsEnum::N ? DirectionsEnum::W : $this->rover->getFacing()-1;
        $this->rover->setFacing($facing);
    }

    private  function turnRight()
    {
        $facing = ($this->rover->getFacing() +1) > DirectionsEnum::W ? DirectionsEnum::N : $this->rover->getFacing()+1;
        $this->rover->setFacing($facing);
    }
}
