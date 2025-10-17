<?php
$page_title = 'Site Ayarları';
include 'includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-cog me-2"></i>Site Ayarları
            </h1>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" class="needs-validation" novalidate>
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Genel Ayarlar</h5>
                    
                    <div class="mb-3">
                        <label for="site_title" class="form-label">Site Başlığı</label>
                        <input type="text" class="form-control" id="site_title" name="site_title" 
                               value="<?php echo htmlspecialchars($settings['site_title'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Açıklaması</label>
                        <textarea class="form-control" id="site_description" name="site_description" rows="3"><?php echo htmlspecialchars($settings['site_description'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="contact_phone" class="form-label">İletişim Telefonu</label>
                        <input type="tel" class="form-control" id="contact_phone" name="contact_phone" 
                               value="<?php echo htmlspecialchars($settings['contact_phone'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">İletişim E-postası</label>
                        <input type="email" class="form-control" id="contact_email" name="contact_email" 
                               value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="whatsapp_number" class="form-label">WhatsApp Numarası</label>
                        <input type="tel" class="form-control" id="whatsapp_number" name="whatsapp_number" 
                               value="<?php echo htmlspecialchars($settings['whatsapp_number'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Adres</label>
                        <textarea class="form-control" id="address" name="address" rows="2"><?php echo htmlspecialchars($settings['address'] ?? ''); ?></textarea>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5 class="mb-3">Sosyal Medya</h5>
                    
                    <div class="mb-3">
                        <label for="social_facebook" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" id="social_facebook" name="social_facebook" 
                               value="<?php echo htmlspecialchars($settings['social_facebook'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="social_instagram" class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" id="social_instagram" name="social_instagram" 
                               value="<?php echo htmlspecialchars($settings['social_instagram'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="social_twitter" class="form-label">Twitter URL</label>
                        <input type="url" class="form-control" id="social_twitter" name="social_twitter" 
                               value="<?php echo htmlspecialchars($settings['social_twitter'] ?? ''); ?>">
                    </div>
                    
                    <h5 class="mb-3 mt-4">API Ayarları</h5>
                    
                    <div class="mb-3">
                        <label for="google_maps_api" class="form-label">Google Maps API Key</label>
                        <input type="text" class="form-control" id="google_maps_api" name="google_maps_api" 
                               value="<?php echo htmlspecialchars($settings['google_maps_api'] ?? ''); ?>">
                        <small class="form-text text-muted">Google Maps entegrasyonu için gerekli</small>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Ayarları Kaydet
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>