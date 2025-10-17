<?php
namespace App\Models;

class Review extends BaseModel
{
    public function approved(int $limit = 10): array
    {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE status='approved' ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
