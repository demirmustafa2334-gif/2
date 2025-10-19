<?php
namespace App\Models;

class Post extends BaseModel
{
    public function latest(int $limit = 5): array
    {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE status='published' ORDER BY published_at DESC LIMIT ?");
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
