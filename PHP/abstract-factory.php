<?php

interface ISofa {
  public function create(): string;
}

interface IChair {
  public function create(): string;
}

class ModernSofa implements ISofa {
  public function create(): string {
    return "modern sofa";
  }
}

class ModernChair implements IChair {
  public function create(): string {
    return "modern chair";
  }
}

class ClassicalSofa implements ISofa {
  public function create(): string {
    return "classical sofa";
  }
}

class ClassicalChair implements IChair {
  public function create(): string {
    return "classical chair";
  }
}

interface IFurnitureFactory {
  public function createSofa(): ISofa;
  public function createChair(): IChair;
}

class ModernFurnitureFactory implements IFurnitureFactory {
  public function createSofa(): ISofa {
    return new ModernSofa();
  }

  public function createChair(): IChair {
    return new ModernChair();
  }
}

class ClassicalFurnitureFactory implements IFurnitureFactory {
  public function createSofa(): ISofa {
    return new ClassicalSofa();
  }

  public function createChair(): IChair {
    return new ClassicalChair();
  }
}

class FurnitureFactory implements IFurnitureFactory {
  private $factory = null;
  function __construct(IFurnitureFactory $factory) {
    $this->factory = $factory;
    $factory->createSofa();
    $factory->createChair();
  }

  public function createSofa(): ISofa {
    return $this->factory->createSofa();
  }
  public function createChair(): IChair {
    return $this->factory->createChair();
  }
}

while ($line = fgets(STDIN)) {
  $line = trim($line);
  if (empty($line)) {
    break;
  }

  if ($line == "modern") {
    $factory = new ModernFurnitureFactory();
  } else if ($line == "classical") {
    $factory = new ClassicalFurnitureFactory();
  } else {
    continue;
  }

  $factory = new FurnitureFactory($factory);
  $sofa = $factory->createSofa();
  $chair = $factory->createChair();

  echo $chair->create() . PHP_EOL;
  echo $sofa->create() . PHP_EOL;
}
