<?php include __DIR__ . '/header.php'; ?>

<h1 class="mb-4">Site Ayarları</h1>

<?php if (isset($message)): ?>
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i> <?php echo $message; ?>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <h5 class="mb-3">Genel Bilgiler</h5>
            
            <div class="mb-3">
                <label class="form-label">Site Başlığı</label>
                <input type="text" name="site_title" class="form-control" 
                       value="<?php echo $settings['site_title'] ?? ''; ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Site Sloganı</label>
                <input type="text" name="site_tagline" class="form-control" 
                       value="<?php echo $settings['site_tagline'] ?? ''; ?>">
            </div>
            
            <hr class="my-4">
            
            <h5 class="mb-3">İletişim Bilgileri</h5>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefon</label>
                    <input type="text" name="contact_phone" class="form-control" 
                           value="<?php echo $settings['contact_phone'] ?? ''; ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">E-posta</label>
                    <input type="email" name="contact_email" class="form-control" 
                           value="<?php echo $settings['contact_email'] ?? ''; ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Adres</label>
                <input type="text" name="contact_address" class="form-control" 
                       value="<?php echo $settings['contact_address'] ?? ''; ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label">WhatsApp Numarası</label>
                <input type="text" name="whatsapp_number" class="form-control" 
                       value="<?php echo $settings['whatsapp_number'] ?? ''; ?>"
                       placeholder="905XXXXXXXXX">
                <small class="text-muted">Ülke kodu ile birlikte, boşluksuz (örn: 905551234567)</small>
            </div>
            
            <hr class="my-4">
            
            <h5 class="mb-3">Sosyal Medya</h5>
            
            <div class="mb-3">
                <label class="form-label">Facebook URL</label>
                <input type="url" name="facebook_url" class="form-control" 
                       value="<?php echo $settings['facebook_url'] ?? ''; ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Instagram URL</label>
                <input type="url" name="instagram_url" class="form-control" 
                       value="<?php echo $settings['instagram_url'] ?? ''; ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Twitter URL</label>
                <input type="url" name="twitter_url" class="form-control" 
                       value="<?php echo $settings['twitter_url'] ?? ''; ?>">
            </div>
            
            <hr class="my-4">
            
            <h5 class="mb-3">Diğer Ayarlar</h5>
            
            <div class="mb-3">
                <label class="form-label">Google Maps API Key</label>
                <input type="text" name="google_maps_api_key" class="form-control" 
                       value="<?php echo $settings['google_maps_api_key'] ?? ''; ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Footer Metni</label>
                <textarea name="footer_text" class="form-control" rows="2"><?php echo $settings['footer_text'] ?? ''; ?></textarea>
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Ayarları Kaydet
            </button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
