<?php

require_once __DIR__ . '/crud/ProductCrud.php';

$opt = getopt("", ["action:", "entity:", "id::", "name::", "price::"]);

if (($opt["entity"] ?? "") !== "products") {
    exit("Unknown entity\n");
}

try {
    match ($opt["action"] ?? "") {
        "list" => ProductCrud::list(),
        "create" => ProductCrud::create(
            $opt["name"], (float) $opt["price"]
        ),
        "update" => ProductCrud::update(
            (int) $opt["id"],
            $opt["name"],
            (float) $opt["price"]
        ),
        "delete" => ProductCrud::delete(
            (int) $opt["id"]
        ),
        default => exit("Unknown action\n")
    };
} catch (Exception $e) {
    echo "Error {$e->getMessage()}\n";
}
