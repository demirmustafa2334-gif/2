<?php
namespace App\Models;

class Setting extends BaseModel
{
    public function get(string $key, ?string $default = null): ?string
    {
        $stmt = $this->db->prepare('SELECT `value` FROM settings WHERE `key`=?');
        $stmt->execute([$key]);
        $row = $stmt->fetch();
        return $row ? (string)$row['value'] : $default;
    }
}
