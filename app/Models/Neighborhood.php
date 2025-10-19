<?php
namespace App\Models;

class Neighborhood extends BaseModel
{
    public function forDistrict(int $districtId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM neighborhoods WHERE district_id = ? ORDER BY name');
        $stmt->execute([$districtId]);
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM neighborhoods WHERE slug = ?');
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
