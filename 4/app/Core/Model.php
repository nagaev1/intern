<?php

namespace App\Core;

class Model
{
    protected static string $table;

    public static function find(int $id): ?static
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE id LIKE :id");
        $stmt->execute(['id' => "%$id%"]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? static::mapToObject($data) : null;
    }

    public static function all(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
        return $data;
    }

    private static function mapToObject(array $data): static
    {
        $object = new static();
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }
        return $object;
    }

    public function save(): bool
    {
        $pdo = Database::getConnection();
        $fields = get_object_vars($this);
        $columns = array_keys($fields);
        $query = "INSERT INTO " . static::$table . " (" . implode(", ", $columns) . ") VALUES (" . implode(", ", array_map(fn($col) => ":$col", $columns)) . ")";
        $stmt = $pdo->prepare($query);
        return $stmt->execute($fields);
    }
}
