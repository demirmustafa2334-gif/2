<?php
require_once __DIR__ . '/Model.php';

class Setting extends Model {
    protected $table = 'settings';
    
    public function get($key, $default = null) {
        $setting = $this->findBy('setting_key', $key);
        return $setting ? $setting['setting_value'] : $default;
    }
    
    public function set($key, $value) {
        $setting = $this->findBy('setting_key', $key);
        
        if ($setting) {
            return $this->update($setting['id'], ['setting_value' => $value]);
        } else {
            return $this->create([
                'setting_key' => $key,
                'setting_value' => $value
            ]);
        }
    }
    
    public function getAll() {
        $settings = $this->findAll('setting_key ASC');
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting['setting_key']] = $setting['setting_value'];
        }
        return $result;
    }
}
