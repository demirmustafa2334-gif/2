<?php
/**
 * ChatGPT API Helper
 * Yereltanitim.com - Turkey Tourism Website
 */

class ChatGPTHelper {
    private $apiKey;
    private $apiUrl;
    
    public function __construct() {
        $this->apiKey = get_setting('chatgpt_api_key');
        $this->apiUrl = CHATGPT_API_URL;
    }
    
    public function generateCityArticle($cityName, $wordCount = 800) {
        $prompt = "Türkiye'nin {$cityName} ili hakkında {$wordCount} kelimelik detaylı bir turizm rehberi yazısı yaz. Şu konuları içersin:
        
        1. Şehrin genel tanıtımı ve tarihi
        2. Başlıca turistik yerler ve görülmesi gereken mekanlar
        3. Yerel mutfak ve özel lezzetler
        4. Kültürel özellikler ve gelenekler
        5. Konaklama ve ulaşım bilgileri
        
        Yazı SEO uyumlu, akıcı Türkçe ile yazılsın. Başlık da dahil et.";
        
        return $this->makeRequest($prompt);
    }
    
    public function generateDistrictArticle($districtName, $cityName, $wordCount = 600) {
        $prompt = "{$cityName} ilinin {$districtName} ilçesi hakkında {$wordCount} kelimelik detaylı bir rehber yazısı yaz. Şu konuları içersin:
        
        1. İlçenin genel tanıtımı ve konumu
        2. Turistik yerler ve gezilecek mekanlar
        3. Yerel lezzetler ve özel yiyecekler
        4. Kültürel özellikler ve etkinlikler
        5. Alışveriş ve eğlence imkanları
        
        Yazı SEO uyumlu, akıcı Türkçe ile yazılsın. Başlık da dahil et.";
        
        return $this->makeRequest($prompt);
    }
    
    public function generateTourismArticle($topic, $location, $wordCount = 700) {
        $prompt = "{$location} bölgesindeki {$topic} konusu hakkında {$wordCount} kelimelik detaylı bir turizm yazısı yaz. 
        
        Yazı şu özelliklerde olsun:
        - SEO uyumlu ve akıcı Türkçe
        - Okuyucuyu bilgilendirici ve ilgi çekici
        - Pratik bilgiler içeren
        - Başlık da dahil
        
        Konuyu derinlemesine ele al ve ziyaretçiler için faydalı ipuçları ver.";
        
        return $this->makeRequest($prompt);
    }
    
    public function generateFoodArticle($cityName, $wordCount = 500) {
        $prompt = "{$cityName} ilinin yerel mutfağı ve özel lezzetleri hakkında {$wordCount} kelimelik bir yazı yaz. Şu konuları içersin:
        
        1. Şehrin meşhur yemekleri ve tatlıları
        2. Yerel malzemeler ve özel tarifler
        3. En iyi restoranlar ve lokantalar
        4. Sokak lezzetleri ve atıştırmalıklar
        5. Yöresel içecekler
        
        Yazı lezzetli ve çekici bir dille yazılsın. Başlık da dahil et.";
        
        return $this->makeRequest($prompt);
    }
    
    private function makeRequest($prompt) {
        if (empty($this->apiKey)) {
            return ['success' => false, 'error' => 'ChatGPT API anahtarı ayarlanmamış'];
        }
        
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Sen Türkiye turizmi konusunda uzman bir rehber yazarısın. Akıcı, bilgilendirici ve SEO uyumlu Türkçe yazılar yazıyorsun.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 1500,
            'temperature' => 0.7
        ];
        
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_error($ch)) {
            curl_close($ch);
            return ['success' => false, 'error' => 'CURL hatası: ' . curl_error($ch)];
        }
        
        curl_close($ch);
        
        if ($httpCode !== 200) {
            return ['success' => false, 'error' => 'API hatası: HTTP ' . $httpCode];
        }
        
        $result = json_decode($response, true);
        
        if (isset($result['choices'][0]['message']['content'])) {
            $content = trim($result['choices'][0]['message']['content']);
            
            // Extract title and content
            $lines = explode("\n", $content);
            $title = trim($lines[0], "# \t");
            $articleContent = implode("\n", array_slice($lines, 1));
            
            return [
                'success' => true,
                'title' => $title,
                'content' => trim($articleContent),
                'full_content' => $content
            ];
        }
        
        return ['success' => false, 'error' => 'API yanıtı işlenemedi'];
    }
    
    public function generateMetaDescription($title, $content) {
        $prompt = "Bu yazı için 150-160 karakter arası SEO uyumlu meta description yaz:
        
        Başlık: {$title}
        İçerik özeti: " . substr(strip_tags($content), 0, 300) . "
        
        Meta description Türkçe olsun ve arama motorları için optimize edilsin.";
        
        $result = $this->makeRequest($prompt);
        
        if ($result['success']) {
            return trim($result['content']);
        }
        
        return '';
    }
    
    public function generateTags($title, $content) {
        $prompt = "Bu yazı için 5-8 adet SEO uyumlu etiket (tag) öner:
        
        Başlık: {$title}
        İçerik: " . substr(strip_tags($content), 0, 500) . "
        
        Etiketler Türkçe olsun ve virgülle ayrılsın.";
        
        $result = $this->makeRequest($prompt);
        
        if ($result['success']) {
            return trim($result['content']);
        }
        
        return '';
    }
}
?>