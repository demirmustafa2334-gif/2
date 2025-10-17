<?php
$meta_title = getMetaTitle('İletişim');
$meta_description = getMetaDescription('İletişim');
$meta_keywords = 'istanbul nakliyat iletişim, nakliyat telefon, evden eve nakliyat adres';

$success_message = '';
$error_message = '';

if ($_POST) {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);
    
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = 'Lütfen tüm zorunlu alanları doldurun.';
    } else {
        $db = new Database();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$name, $email, $phone, $subject, $message])) {
            $success_message = 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.';
            
            // Send email notification
            $email_subject = "Yeni İletişim Mesajı - " . $subject;
            $email_message = "
                <h3>Yeni İletişim Mesajı</h3>
                <p><strong>Ad Soyad:</strong> " . $name . "</p>
                <p><strong>E-posta:</strong> " . $email . "</p>
                <p><strong>Telefon:</strong> " . $phone . "</p>
                <p><strong>Konu:</strong> " . $subject . "</p>
                <p><strong>Mesaj:</strong></p>
                <p>" . nl2br($message) . "</p>
            ";
            
            sendEmail(ADMIN_EMAIL, $email_subject, $email_message);
        } else {
            $error_message = 'Mesaj gönderilirken bir hata oluştu. Lütfen tekrar deneyin.';
        }
    }
}

ob_start();
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3 bg-light">
    <div class="container">
        <?php echo generateBreadcrumb([['title' => 'İletişim']]); ?>
    </div>
</nav>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-4 fw-bold mb-3">İletişim</h1>
                <p class="lead text-muted">Nakliyat hizmetlerimiz hakkında sorularınız için bizimle iletişime geçin. 7/24 müşteri hizmetlerimizle yanınızdayız.</p>
            </div>
        </div>
        
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-envelope me-2"></i>Bize Mesaj Gönderin</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($success_message): ?>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($error_message): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Ad Soyad <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required value="<?php echo isset($_POST['name']) ? sanitize($_POST['name']) : ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-posta <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($_POST['email']) ? sanitize($_POST['email']) : ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Telefon</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? sanitize($_POST['phone']) : ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Konu</label>
                                    <select class="form-select" id="subject" name="subject">
                                        <option value="">Konu seçiniz</option>
                                        <option value="Fiyat Teklifi" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Fiyat Teklifi') ? 'selected' : ''; ?>>Fiyat Teklifi</option>
                                        <option value="Keşif Talebi" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Keşif Talebi') ? 'selected' : ''; ?>>Keşif Talebi</option>
                                        <option value="Genel Bilgi" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Genel Bilgi') ? 'selected' : ''; ?>>Genel Bilgi</option>
                                        <option value="Şikayet" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Şikayet') ? 'selected' : ''; ?>>Şikayet</option>
                                        <option value="Diğer" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'Diğer') ? 'selected' : ''; ?>>Diğer</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Mesaj <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Mesajınızı buraya yazın..."><?php echo isset($_POST['message']) ? sanitize($_POST['message']) : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Mesaj Gönder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-phone me-2"></i>İletişim Bilgileri</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Telefon</h6>
                                    <a href="tel:<?php echo str_replace(' ', '', WHATSAPP_NUMBER); ?>" class="text-decoration-none">
                                        <?php echo WHATSAPP_NUMBER; ?>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">WhatsApp</h6>
                                    <a href="https://wa.me/<?php echo str_replace(['+', ' '], '', WHATSAPP_NUMBER); ?>" class="text-decoration-none" target="_blank">
                                        <?php echo WHATSAPP_NUMBER; ?>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">E-posta</h6>
                                    <a href="mailto:<?php echo ADMIN_EMAIL; ?>" class="text-decoration-none">
                                        <?php echo ADMIN_EMAIL; ?>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Adres</h6>
                                    <p class="mb-0">İstanbul, Türkiye</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <h6 class="fw-bold mb-3">Çalışma Saatleri</h6>
                            <p class="mb-1"><strong>Pazartesi - Cuma:</strong> 08:00 - 18:00</p>
                            <p class="mb-1"><strong>Cumartesi:</strong> 09:00 - 16:00</p>
                            <p class="mb-0"><strong>Pazar:</strong> Kapalı</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3">Konumumuz</h2>
                <p class="lead text-muted">İstanbul'un merkezi konumunda hizmet veriyoruz.</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3010.2797490722!2d28.9784!3d41.0082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab9bd6571c569%3A0x8ca8b6b1b3c3b3b3!2sIstanbul%2C%20Turkey!5e0!3m2!1sen!2str!4v1234567890"
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="display-5 fw-bold mb-3">Hemen İletişime Geçin!</h2>
                <p class="lead mb-4">Nakliyat ihtiyaçlarınız için hemen bizimle iletişime geçin. Uzman ekibimiz size en uygun çözümü sunacak.</p>
            </div>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <a href="tel:<?php echo str_replace(' ', '', WHATSAPP_NUMBER); ?>" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-phone me-2"></i>Hemen Ara
                </a>
                <a href="https://wa.me/<?php echo str_replace(['+', ' '], '', WHATSAPP_NUMBER); ?>" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include 'layout.php';
?>