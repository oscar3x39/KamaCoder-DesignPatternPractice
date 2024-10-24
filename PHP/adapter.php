<?php

interface ICharger {
  public function charge(): string;
}

class TypeCCharger implements ICharger {
  public function charge(): string {
    return "TypeC";
  }
}

class USBCharger implements ICharger {
  public function charge(): string {
    return "USB";
  }
}

class ChargingAdapter implements ICharger {
  private $charger;

  public function __construct(ICharger $charger) {
    $this->charger = $charger;
  }

  public function charge(): string {
    return $this->charger->charge() . " Adapter";
  }
}

while ($line = fgets(STDIN)) {
  $line = trim($line);
  if (empty($line)) {
      break;
  }

  if ($line === "1") {
    $charger = new TypeCCharger();
    echo $charger->charge() . PHP_EOL;
  } else if ($line === "2") {
    $charger = new USBCharger();
    $adapter = new ChargingAdapter($charger);
    echo $adapter->charge() . PHP_EOL;
  } else {
    continue;
  }
}
