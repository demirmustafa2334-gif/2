<?php
namespace App\Models;

class District extends BaseModel
{
    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM districts ORDER BY name');
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM districts WHERE slug = ?');
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
