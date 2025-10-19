<?php
namespace App\Models;

class Price extends BaseModel
{
    public function estimate(int $fromDistrictId, int $toDistrictId, string $variant = 'home'): ?float
    {
        $stmt = $this->db->prepare('SELECT base_price FROM prices WHERE from_district_id=? AND to_district_id=? AND variant=?');
        $stmt->execute([$fromDistrictId, $toDistrictId, $variant]);
        $row = $stmt->fetch();
        if ($row) {
            return (float)$row['base_price'];
        }
        // fallback: same-district cheaper
        if ($fromDistrictId === $toDistrictId) {
            $stmt = $this->db->prepare('SELECT base_price FROM prices WHERE from_district_id=? AND to_district_id=? LIMIT 1');
            $stmt->execute([$fromDistrictId, $toDistrictId]);
            $row = $stmt->fetch();
            if ($row) return (float)$row['base_price'];
        }
        return null;
    }
}
