<?php

interface IProduct {
    public function getName(): string;
    public function getQuantity(): int;
}

class Product implements IProduct {
    private string $name;
    private int $quantity;

    public function __construct(string $name, int $quantity) {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }
}

interface IShoppingCartManager {
    public function add(string $name, int $quantity);
    public function viewCart();
}

class ShoppingCartManager implements IShoppingCartManager {
    private static ?ShoppingCartManager $instance = null;
    private array $products = [];

    private function __construct() {}

    public static function getInstance(): ShoppingCartManager {
        if (self::$instance === null) {
            self::$instance = new ShoppingCartManager();
        }
        return self::$instance;
    }

    public function add(string $name, int $quantity) {
        $this->products[] = new Product($name, $quantity);
    }

    public function viewCart() {
        foreach ($this->products as $product) {
            echo $product->getName() . " " . $product->getQuantity() . PHP_EOL;
        }
    }
}

$cart = ShoppingCartManager::getInstance();

while ($line = fgets(STDIN)) {
    $line = trim($line);
    if (empty($line)) {
        break;
    }

    list($name, $quantity) = explode(" ", $line);
    $cart->add($name, (int)$quantity);
}

$cart->viewCart();
