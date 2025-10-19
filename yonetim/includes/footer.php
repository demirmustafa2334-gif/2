    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Özel Yönetim JS -->
    <script>
        // Uyarıları 5 saniye sonra otomatik gizle
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
        
        // Silme işlemlerini onayla
        function silmeOnayla(mesaj = 'Bu işlemi gerçekleştirmek istediğinizden emin misiniz?') {
            return confirm(mesaj);
        }
        
        // Başlıktan otomatik slug oluştur
        function slugOlustur(baslikInput, slugInput) {
            const baslik = baslikInput.value;
            const slug = baslik
                .toLowerCase()
                .replace(/ç/g, 'c')
                .replace(/ğ/g, 'g')
                .replace(/ı/g, 'i')
                .replace(/ö/g, 'o')
                .replace(/ş/g, 's')
                .replace(/ü/g, 'u')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            
            slugInput.value = slug;
        }
        
        // Metin alanları için karakter sayacı
        function karakterSayaciniGuncelle(textarea, sayac, maxUzunluk) {
            const mevcutUzunluk = textarea.value.length;
            sayac.textContent = mevcutUzunluk + '/' + maxUzunluk;
            
            if (mevcutUzunluk > maxUzunluk * 0.9) {
                sayac.classList.add('text-warning');
            } else {
                sayac.classList.remove('text-warning');
            }
            
            if (mevcutUzunluk >= maxUzunluk) {
                sayac.classList.add('text-danger');
                sayac.classList.remove('text-warning');
            } else {
                sayac.classList.remove('text-danger');
            }
        }
        
        // Karakter sayaçlarını başlat
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea[data-max-length]');
            textareas.forEach(function(textarea) {
                const maxLength = parseInt(textarea.dataset.maxLength);
                const counter = document.getElementById(textarea.id + '-counter');
                
                if (counter) {
                    karakterSayaciniGuncelle(textarea, counter, maxLength);
                    textarea.addEventListener('input', function() {
                        karakterSayaciniGuncelle(textarea, counter, maxLength);
                    });
                }
            });
        });
        
        // Form doğrulama
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>