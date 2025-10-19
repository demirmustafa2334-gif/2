<?php
/**
 * AI Article Generator
 * Yereltanitim.com - Turkey Tourism Website
 */

require_once '../config/config.php';
require_admin_login();

$city = new City();
$district = new District();
$blogPost = new BlogPost();
$chatGPT = new ChatGPTHelper();

$cities = $city->getActiveCities();
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $articleType = $_POST['article_type'];
    $selectedCityId = $_POST['city_id'] ?? null;
    $selectedDistrictId = $_POST['district_id'] ?? null;
    $customTopic = $_POST['custom_topic'] ?? '';
    $wordCount = intval($_POST['word_count']) ?: 800;
    
    try {
        $result = null;
        
        switch ($articleType) {
            case 'city':
                if ($selectedCityId) {
                    $cityData = $city->findById($selectedCityId);
                    $result = $chatGPT->generateCityArticle($cityData['name'], $wordCount);
                }
                break;
                
            case 'district':
                if ($selectedDistrictId) {
                    $districtData = $district->getDistrictWithCity('');
                    $query = "SELECT d.*, c.name as city_name FROM districts d JOIN cities c ON d.city_id = c.id WHERE d.id = :id";
                    $stmt = $district->db->prepare($query);
                    $stmt->bindParam(':id', $selectedDistrictId);
                    $stmt->execute();
                    $districtData = $stmt->fetch();
                    
                    if ($districtData) {
                        $result = $chatGPT->generateDistrictArticle($districtData['name'], $districtData['city_name'], $wordCount);
                    }
                }
                break;
                
            case 'food':
                if ($selectedCityId) {
                    $cityData = $city->findById($selectedCityId);
                    $result = $chatGPT->generateFoodArticle($cityData['name'], $wordCount);
                }
                break;
                
            case 'custom':
                if ($customTopic && $selectedCityId) {
                    $cityData = $city->findById($selectedCityId);
                    $result = $chatGPT->generateTourismArticle($customTopic, $cityData['name'], $wordCount);
                }
                break;
        }
        
        if ($result && $result['success']) {
            // Generate additional SEO data
            $metaDescription = $chatGPT->generateMetaDescription($result['title'], $result['content']);
            $tags = $chatGPT->generateTags($result['title'], $result['content']);
            
            // Create blog post
            $postData = [
                'title' => $result['title'],
                'slug' => generate_slug($result['title']),
                'content' => $result['content'],
                'excerpt' => truncate_text(strip_tags($result['content']), 160),
                'city_id' => $selectedCityId,
                'district_id' => $selectedDistrictId,
                'meta_title' => $result['title'] . ' | Yereltanitim.com',
                'meta_description' => $metaDescription ?: truncate_text(strip_tags($result['content']), 160),
                'tags' => $tags,
                'is_published' => 0, // Save as draft
                'author_id' => $_SESSION['admin_id']
            ];
            
            $postId = $blogPost->create($postData);
            
            if ($postId) {
                $message = 'AI yazısı başarıyla oluşturuldu ve taslak olarak kaydedildi. <a href="blog-duzenle.php?id=' . $postId . '">Düzenlemek için tıklayın</a>';
            } else {
                $error = 'Yazı oluşturuldu ancak veritabanına kaydedilemedi.';
            }
        } else {
            $error = $result['error'] ?? 'AI yazı oluşturulurken bir hata oluştu.';
        }
        
    } catch (Exception $e) {
        $error = 'Bir hata oluştu: ' . $e->getMessage();
    }
}

include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-robot me-2"></i>AI ile Yazı Oluştur
                </h1>
            </div>
            
            <?php if ($message): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-magic me-2"></i>
                                Yapay Zeka Yazı Oluşturucu
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="article_type" class="form-label">Yazı Türü</label>
                                        <select class="form-select" id="article_type" name="article_type" required>
                                            <option value="">Seçin</option>
                                            <option value="city">Şehir Rehberi</option>
                                            <option value="district">İlçe Rehberi</option>
                                            <option value="food">Yerel Mutfak</option>
                                            <option value="custom">Özel Konu</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="word_count" class="form-label">Kelime Sayısı</label>
                                        <select class="form-select" id="word_count" name="word_count">
                                            <option value="500">500 kelime</option>
                                            <option value="800" selected>800 kelime</option>
                                            <option value="1000">1000 kelime</option>
                                            <option value="1200">1200 kelime</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="city_id" class="form-label">Şehir</label>
                                        <select class="form-select" id="city_id" name="city_id" required>
                                            <option value="">Şehir Seçin</option>
                                            <?php foreach ($cities as $cityOption): ?>
                                                <option value="<?php echo $cityOption['id']; ?>">
                                                    <?php echo htmlspecialchars($cityOption['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6" id="district_container" style="display: none;">
                                        <label for="district_id" class="form-label">İlçe</label>
                                        <select class="form-select" id="district_id" name="district_id">
                                            <option value="">İlçe Seçin</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12" id="custom_topic_container" style="display: none;">
                                        <label for="custom_topic" class="form-label">Özel Konu</label>
                                        <input type="text" class="form-control" id="custom_topic" name="custom_topic" 
                                               placeholder="Örn: Tarihi yerler, doğal güzellikler, festivaller...">
                                        <div class="form-text">
                                            Yazmak istediğiniz konuyu belirtin (örn: "tarihi yerler", "doğal güzellikler", "yerel festivaller")
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-magic me-2"></i>
                                        AI ile Yazı Oluştur
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Nasıl Çalışır?
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="step-item mb-3">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <strong>Yazı türünü seçin</strong>
                                    <p class="small text-muted mb-0">Şehir rehberi, ilçe rehberi, yerel mutfak veya özel konu</p>
                                </div>
                            </div>
                            
                            <div class="step-item mb-3">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <strong>Lokasyon belirleyin</strong>
                                    <p class="small text-muted mb-0">Yazının hangi şehir/ilçe hakkında olacağını seçin</p>
                                </div>
                            </div>
                            
                            <div class="step-item mb-3">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <strong>AI oluştursun</strong>
                                    <p class="small text-muted mb-0">Yapay zeka SEO uyumlu, detaylı yazı oluşturacak</p>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <strong>Düzenleyin ve yayınlayın</strong>
                                    <p class="small text-muted mb-0">Yazı taslak olarak kaydedilir, istediğiniz gibi düzenleyebilirsiniz</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-lightbulb me-2"></i>
                                İpuçları
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>AI yazıları SEO uyumlu olarak oluşturulur</small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Meta açıklamalar otomatik oluşturulur</small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Etiketler (tags) otomatik önerilir</small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Yazılar taslak olarak kaydedilir</small>
                                </li>
                                <li>
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>İstediğiniz gibi düzenleyebilirsiniz</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.step-item {
    display: flex;
    align-items: flex-start;
}

.step-number {
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.9rem;
    margin-right: 1rem;
    flex-shrink: 0;
}

.step-content {
    flex: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const articleType = document.getElementById('article_type');
    const citySelect = document.getElementById('city_id');
    const districtContainer = document.getElementById('district_container');
    const districtSelect = document.getElementById('district_id');
    const customTopicContainer = document.getElementById('custom_topic_container');
    
    // Handle article type change
    articleType.addEventListener('change', function() {
        if (this.value === 'district') {
            districtContainer.style.display = 'block';
            districtSelect.required = true;
        } else {
            districtContainer.style.display = 'none';
            districtSelect.required = false;
        }
        
        if (this.value === 'custom') {
            customTopicContainer.style.display = 'block';
            document.getElementById('custom_topic').required = true;
        } else {
            customTopicContainer.style.display = 'none';
            document.getElementById('custom_topic').required = false;
        }
    });
    
    // Handle city change to load districts
    citySelect.addEventListener('change', function() {
        const cityId = this.value;
        districtSelect.innerHTML = '<option value="">İlçe Seçin</option>';
        
        if (cityId) {
            fetch(`../api/get-districts.php?city_id=${cityId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        data.districts.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading districts:', error);
                });
        }
    });
    
    // Form validation
    const form = document.querySelector('.needs-validation');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>AI Oluşturuyor...';
            submitBtn.disabled = true;
        }
        form.classList.add('was-validated');
    });
});
</script>

<?php include 'includes/footer.php'; ?>