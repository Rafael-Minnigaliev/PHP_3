<?php
class SquareAreaLib{
    public function getSquareArea(int $diagonal): float {
        $area = ($diagonal**2)/2;
        return round($area, 2);
    }
}

class CircleAreaLib{
    public function getCircleArea(int $diagonal): float {
        $area = (M_PI * $diagonal**2)/4;
        return round($area, 2);
    }
}


interface ISquare{
    function squareArea(int $sideSquare);
}

interface ICircle{
    function circleArea(int $circumference);
}


class Square implements ISquare {
    public function squareArea(int $sideSquare) : float {
        $squareArea = $sideSquare**2;
        return round($squareArea, 2);
    }
}

class Circle implements ICircle {
    public function circleArea(int $circumference) : float {
        $circleArea = ($circumference**2)/(4 * 3.14);
        return round($circleArea, 2);
    }
}

class SquareAdapter extends Square{
    private $square;
    public function __construct(SquareAreaLib $square){
        $this->square = $square;
    }

    public function squareArea(int $x): float{
        return $this->square->getSquareArea($x);
    }
}

class CircleAdapter extends Circle{
    private $circle;
    public function __construct(CircleAreaLib $circle){
        $this->circle = $circle;
    }

    public function circleArea(int $x): float{
        return $this->circle->getCircleArea($x);
    }
}

function clientCodeSquare(Square $square, int $x){
    echo "S квадрата = ".$square->squareArea($x)."<br>";
}

function clientCodeCircle(Circle $circle, int $x){
    echo "S круга = ".$circle->circleArea($x)."<br>";
}

$sq = new Square();
clientCodeSquare($sq, 5);
$sqLib = new SquareAreaLib();
$sqAdapter = new SquareAdapter($sqLib);
clientCodeSquare($sqAdapter, 5);

$circ = new Circle();
clientCodeCircle($circ, 5);
$circLib = new CircleAreaLib();
$circAdapter = new CircleAdapter($circLib);
clientCodeCircle($circAdapter, 5);