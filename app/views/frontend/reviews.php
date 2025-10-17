<?php include __DIR__ . '/header.php'; ?>

<section class="reviews-page py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Müşteri Yorumları</h1>
            <p class="text-muted">Müşterilerimizin bizim hakkımızdaki görüşleri</p>
            <?php if (isset($average_rating) && $average_rating > 0): ?>
            <div class="rating-summary">
                <h2 class="display-4 mb-0"><?php echo $average_rating; ?>/5.0</h2>
                <div class="mb-2">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?php echo $i <= round($average_rating) ? 'text-warning' : 'text-muted'; ?> fa-lg"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-muted"><?php echo count($reviews); ?> müşteri yorumu</p>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="row mb-5">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="card-text fst-italic">"<?php echo $review['review_text']; ?>"</p>
                            <hr>
                            <p class="fw-bold mb-0"><?php echo $review['customer_name']; ?></p>
                            <?php if (!empty($review['service_type'])): ?>
                            <p class="text-muted small mb-0"><?php echo $review['service_type']; ?></p>
                            <?php endif; ?>
                            <p class="text-muted small"><?php echo date('d.m.Y', strtotime($review['created_at'])); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center text-muted">Henüz yorum bulunmamaktadır.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Add Review Form -->
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="card-title mb-4">Yorumunuzu Bırakın</h3>
                
                <form id="reviewForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Adınız Soyadınız *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">E-posta *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Puan *</label>
                        <div class="rating-input">
                            <input type="radio" name="rating" value="5" id="rating5" required>
                            <label for="rating5"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" value="4" id="rating4">
                            <label for="rating4"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" value="3" id="rating3">
                            <label for="rating3"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" value="2" id="rating2">
                            <label for="rating2"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" value="1" id="rating1">
                            <label for="rating1"><i class="fas fa-star"></i></label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Hizmet Türü</label>
                        <select name="service_type" class="form-select">
                            <option value="">Seçiniz</option>
                            <option value="Evden Eve Nakliyat">Evden Eve Nakliyat</option>
                            <option value="Ofis Taşımacılığı">Ofis Taşımacılığı</option>
                            <option value="Parça Eşya Taşıma">Parça Eşya Taşıma</option>
                            <option value="Asansörlü Nakliyat">Asansörlü Nakliyat</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Yorumunuz *</label>
                        <textarea name="review_text" class="form-control" rows="4" required></textarea>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Yorumunuz incelendikten sonra yayınlanacaktır.
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane"></i> Yorumu Gönder
                    </button>
                </form>
                
                <div id="reviewSuccess" class="alert alert-success mt-3" style="display:none;"></div>
                <div id="reviewError" class="alert alert-danger mt-3" style="display:none;"></div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const button = this.querySelector('button[type="submit"]');
    const originalText = button.innerHTML;
    
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
    
    fetch('<?php echo SITE_URL; ?>/yorum-gonder', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('reviewError').style.display = 'none';
        document.getElementById('reviewSuccess').style.display = 'none';
        
        if (data.success) {
            document.getElementById('reviewSuccess').textContent = data.message;
            document.getElementById('reviewSuccess').style.display = 'block';
            document.getElementById('reviewForm').reset();
        } else {
            document.getElementById('reviewError').textContent = data.message;
            document.getElementById('reviewError').style.display = 'block';
        }
        
        button.disabled = false;
        button.innerHTML = originalText;
    })
    .catch(error => {
        document.getElementById('reviewError').textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        document.getElementById('reviewError').style.display = 'block';
        button.disabled = false;
        button.innerHTML = originalText;
    });
});
</script>

<?php include __DIR__ . '/footer.php'; ?>
