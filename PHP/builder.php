<?php

interface IFrame {
  public function create(): string;
}

interface ITires {
  public function create(): string;
}

class AluminumFrame implements IFrame {
  public function create(): string {
    return 'Aluminum Frame';
  }
}

class CarbonFrame implements IFrame {
  public function create(): string {
    return 'Carbon Frame';
  }
}

class KnobbyTires implements ITires {
  public function create(): string {
    return 'Knobby Tires';
  }
}

class SlimTires implements ITires {
  public function create(): string {
    return 'Slim Tires';
  }
}

interface IBike {
  public function setFrame(IFrame $frame): void;
  public function setTires(ITires $tire): void;
  public function info(): string;
}

class Bike implements IBike {
  private IFrame $frame;
  private ITires $tire;

  public function setFrame(IFrame $frame): void {
    $this->frame = $frame;
  }
  public function setTires(ITires $tire): void {
    $this->tire = $tire;
  }
  public function info(): string {
    return $this->frame->create() . " " . $this->tire->create();
  }
}

interface BikeBuilder {
  public function createFrame(): void;
  public function createTires(): void;
  public function getBike(): Bike;
}
class MountainBikeBuilder implements BikeBuilder {
  private Bike $bike;

  function __construct() {
    $this->bike = new Bike();
  }

  public function createFrame(): void {
    $this->bike->setFrame(new AluminumFrame());
  }

  public function createTires(): void {
    $this->bike->setTires(new KnobbyTires());
  }

  public function getBike(): Bike {
    return $this->bike;
  }
}

class RoadBikeBuilder implements BikeBuilder {
  private Bike $bike;

  function __construct() {
    $this->bike = new Bike();
  }
  public function createFrame(): void {
    $this->bike->setFrame(new CarbonFrame());
  }

  public function createTires(): void {
    $this->bike->setTires(new SlimTires());
  }

  public function getBike(): Bike {
    return $this->bike;
  }
}

class BikeOrderManager {
  private BikeBuilder $builder;

  public function __construct(BikeBuilder $builder) {
    $this->builder = $builder;
  }

  public function buildBike(): Bike {
    $this->builder->createFrame();
    $this->builder->createTires();
    return $this->builder->getBike();
  }
}

while ($line = fgets(STDIN)) {

  $line = trim($line);
  if ($line == "mountain") {
    $builder = new MountainBikeBuilder();
  } else if ($line == "road") {
    $builder = new RoadBikeBuilder();
  } else {
    continue;
  }

  $orderManager = new BikeOrderManager($builder);
  $bike = $orderManager->buildBike();

  echo $bike->info() . PHP_EOL;
}
