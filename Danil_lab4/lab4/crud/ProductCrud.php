<?php

require_once __DIR__ . '/../db.php';

class ProductCrud
{
    public static function list(): void
    {
        foreach (db()->query("SELECT * FROM products") as $r) {
            echo "{$r['id']} | {$r['name']} | {$r['price']}\n";
        }
    }

    public static function create(string $name, float $price): void
    {
        if ($price <= 0) throw new Exception("Price must be > 0");

        $st = db()->prepare(
            "INSERT INTO products(name, price) VALUES (?, ?)"
        );
        $st->execute([$name, $price]);
        echo "Added\n";
    }

    public static function update(int $id, string $name, float $price): void
    {
        $st = db()->prepare(
            "UPDATE products SET name=?, price=? WHERE id=?"
        );
        $st->execute([$name, $price, $id]);
        echo "Updated\n";
    }

    public static function delete(int $id): void
    {
        $st = db()->prepare("DELETE FROM products WHERE id=?");
        $st->execute([$id]);
        echo "Deleted\n";
    }

    public static function view(int $id): void
    {
        $st = db()->prepare("SELECT * FROM products WHERE id=?");
        $st->execute([$id]);
        $r = $st->fetch(PDO::FETCH_ASSOC);
        if (!$r) {
            echo "Not found\n";
            return;
        }
        echo "{$r['id']} | {$r['name']} | {$r['price']}\n";
    }

}
