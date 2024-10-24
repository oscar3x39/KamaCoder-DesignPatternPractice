<?php

interface Shape {
  public function info();
}

class Circle implements Shape {
  public function info() {
    return "Circle Block";
  }
}

class Square implements Shape {
  public function info() {
    return "Square Block";
  }
}

class ShapeFactory {
  const CIRCLE = "Circle";
  const SQUARE = "Square";
  
  public function create(string $shape): ?Shape {
    switch ($shape) {
      case self::CIRCLE:
        return new Circle();
      case self::SQUARE:
        return new Square();
      default:
        return null;
    }
  }
}

$factory = new ShapeFactory();

while ($line = fgets(STDIN)) {

  $line = trim($line);
  if (empty($line)) {
      break;
  }

  $inputParts = explode(" ", $line);
  if (count($inputParts) !== 2) {
    continue;
  }
  
  list($shape, $quantity) = explode(" ", $line);
  $quantity = intval($quantity) - 1;  
  for ($i = 0; $i <= $quantity; $i ++) {
    $shapeObj = $factory->create($shape);
    if ($shapeObj) {
      echo $shapeObj->info() . PHP_EOL;
    }
  }
}
