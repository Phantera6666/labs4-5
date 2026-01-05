<?php

require_once __DIR__ . '/crud/ProductCrud.php';

function ask(string $q): string
{
    echo $q;
    return trim(fgets(STDIN));
}

function menu(): void
{
    while (true) {
        echo "\n1 - Products\n0 - Exit\n> ";
        $e = ask("");

        if ($e === "0") exit;

        if ($e === "1") {
            productMenu();
        } else {
            echo "Wrong choice\n";
        }
    }
}

function productMenu(): void
{
    echo "
1 - List
2 - Create
3 - Update
4 - Delete
> ";

    try {
        match (ask("")) {
            "1" => ProductCrud::list(),
            "2" => ProductCrud::create(
                ask("Name: "),
                (float) ask("Price: ")
            ),
            "3" => ProductCrud::update(
                (int) ask("ID: "),
                ask("Name: "),
                (float) ask("Price: ")
            ),
            "4" => ProductCrud::delete(
                (int) ask("ID: ")
            ),
            default => print "Wrong action\n"
        };
    } catch (Exception $e) {
        echo "Error {$e->getMessage()}\n";
    }
}
