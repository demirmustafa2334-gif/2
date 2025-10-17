<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/Price.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Setting.php';

class PriceController extends Controller {
    
    public function index() {
        $priceModel = new Price();
        $districtModel = new District();
        $settingModel = new Setting();
        
        $data = [
            'title' => 'Fiyat Listesi | İstanbul Nakliyat',
            'meta_description' => 'İstanbul genelinde evden eve nakliyat fiyatları. İlçeler arası taşıma ücretleri.',
            'prices' => $priceModel->getAllWithDistricts(),
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('prices', $data);
    }
    
    public function calculate() {
        if ($this->isPost()) {
            $from = $this->sanitize($_POST['from'] ?? '');
            $to = $this->sanitize($_POST['to'] ?? '');
            
            if ($from && $to) {
                $priceModel = new Price();
                $price = $priceModel->getByRoute($from, $to);
                
                if ($price) {
                    $this->json([
                        'success' => true,
                        'price' => $price['base_price'],
                        'price_per_km' => $price['price_per_km'],
                        'notes' => $price['notes']
                    ]);
                } else {
                    $this->json([
                        'success' => false,
                        'message' => 'Bu rota için fiyat bilgisi bulunamadı. Lütfen bizimle iletişime geçin.'
                    ]);
                }
            }
        }
        
        $this->json(['success' => false, 'message' => 'Geçersiz istek'], 400);
    }
}
