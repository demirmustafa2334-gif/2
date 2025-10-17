// Main JavaScript for Istanbul Nakliyat

document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
        });
    }
    
    // Form validation
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Lütfen tüm gerekli alanları doldurun.');
            }
        });
    });
    
    // Lazy loading images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img.lazy').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Auto-hide alerts
    const alerts = document.querySelectorAll('[data-auto-hide]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
    
    // Scroll to top button
    const scrollBtn = document.getElementById('scroll-to-top');
    if (scrollBtn) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollBtn.classList.remove('hidden');
            } else {
                scrollBtn.classList.add('hidden');
            }
        });
        
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Loading state for buttons
    const loadingButtons = document.querySelectorAll('[data-loading]');
    loadingButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Yükleniyor...';
        });
    });
});

// Utility Functions
function formatCurrency(amount) {
    return new Intl.NumberFormat('tr-TR', {
        style: 'currency',
        currency: 'TRY'
    }).format(amount);
}

function formatDate(date) {
    return new Intl.DateTimeFormat('tr-TR').format(new Date(date));
}

// Cookie Consent (optional)
function checkCookieConsent() {
    if (!localStorage.getItem('cookieConsent')) {
        const banner = document.createElement('div');
        banner.className = 'fixed bottom-0 left-0 right-0 bg-gray-800 text-white p-4 z-50';
        banner.innerHTML = `
            <div class="container mx-auto flex items-center justify-between">
                <p>Bu web sitesi deneyiminizi geliştirmek için çerezleri kullanır.</p>
                <button onclick="acceptCookies()" class="bg-blue-600 px-6 py-2 rounded hover:bg-blue-700">
                    Kabul Et
                </button>
            </div>
        `;
        document.body.appendChild(banner);
    }
}

function acceptCookies() {
    localStorage.setItem('cookieConsent', 'true');
    document.querySelector('.fixed.bottom-0').remove();
}
