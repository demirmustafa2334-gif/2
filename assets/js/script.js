// Istanbul Moving Company - Custom JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Back to Top Button
    const backToTopBtn = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });
    
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Pricing Calculator
    const pricingForm = document.getElementById('pricingForm');
    if (pricingForm) {
        pricingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            calculatePrice();
        });
        
        // Auto-calculate on change
        const fromSelect = document.getElementById('from_district');
        const toSelect = document.getElementById('to_district');
        
        if (fromSelect && toSelect) {
            fromSelect.addEventListener('change', calculatePrice);
            toSelect.addEventListener('change', calculatePrice);
        }
    }
    
    // Smooth scrolling for anchor links
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
    
    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
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
    
    images.forEach(img => imageObserver.observe(img));
    
    // Mobile menu close on link click
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });
    
    // WhatsApp button click tracking
    const whatsappBtn = document.querySelector('.whatsapp-btn');
    if (whatsappBtn) {
        whatsappBtn.addEventListener('click', function() {
            // Track WhatsApp clicks (you can add analytics here)
            console.log('WhatsApp button clicked');
        });
    }
    
    // Quote button click tracking
    const quoteButtons = document.querySelectorAll('a[href="/contact"]');
    quoteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Track quote button clicks (you can add analytics here)
            console.log('Quote button clicked');
        });
    });
    
    // Add loading state to forms
    const submitButtons = document.querySelectorAll('button[type="submit"]');
    submitButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.form && this.form.checkValidity()) {
                this.innerHTML = '<span class="spinner me-2"></span>Gönderiliyor...';
                this.disabled = true;
            }
        });
    });
    
    // Animate elements on scroll
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.fade-in-up');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;
            
            if (elementTop < window.innerHeight - elementVisible) {
                element.classList.add('fade-in-up');
            }
        });
    };
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run once on load
    
});

// Pricing Calculator Function
function calculatePrice() {
    const fromDistrict = document.getElementById('from_district')?.value;
    const toDistrict = document.getElementById('to_district')?.value;
    const fromNeighborhood = document.getElementById('from_neighborhood')?.value;
    const toNeighborhood = document.getElementById('to_neighborhood')?.value;
    const distance = document.getElementById('distance')?.value || 0;
    
    if (!fromDistrict || !toDistrict) {
        hidePriceResult();
        return;
    }
    
    // Show loading
    showPriceLoading();
    
    // Simulate API call (replace with actual API call)
    setTimeout(() => {
        const price = calculateEstimatedPrice(fromDistrict, toDistrict, fromNeighborhood, toNeighborhood, distance);
        showPriceResult(price);
    }, 1000);
}

function calculateEstimatedPrice(fromDistrict, toDistrict, fromNeighborhood, toNeighborhood, distance) {
    // Base prices (this should come from your database)
    const basePrices = {
        'kadikoy': { 'besiktas': 500, 'sisli': 600, 'beyoglu': 450 },
        'besiktas': { 'kadikoy': 500, 'sisli': 400, 'beyoglu': 350 },
        'sisli': { 'kadikoy': 600, 'besiktas': 400, 'beyoglu': 300 },
        'beyoglu': { 'kadikoy': 450, 'besiktas': 350, 'sisli': 300 }
    };
    
    let basePrice = basePrices[fromDistrict]?.[toDistrict] || 400;
    let pricePerKm = 15;
    let minimumPrice = 200;
    
    // Add neighborhood premium
    if (fromNeighborhood) basePrice += 50;
    if (toNeighborhood) basePrice += 50;
    
    // Calculate total price
    let totalPrice = basePrice + (distance * pricePerKm);
    
    // Apply minimum price
    if (totalPrice < minimumPrice) {
        totalPrice = minimumPrice;
    }
    
    return Math.round(totalPrice);
}

function showPriceLoading() {
    const resultDiv = document.getElementById('priceResult');
    if (resultDiv) {
        resultDiv.innerHTML = `
            <div class="text-center">
                <div class="spinner me-2"></div>
                Fiyat hesaplanıyor...
            </div>
        `;
        resultDiv.style.display = 'block';
    }
}

function showPriceResult(price) {
    const resultDiv = document.getElementById('priceResult');
    if (resultDiv) {
        resultDiv.innerHTML = `
            <h3>Tahmini Fiyat</h3>
            <div class="h2 text-white mb-2">${price} ₺</div>
            <p class="mb-0">* Bu fiyat tahminidir. Kesin fiyat için iletişime geçin.</p>
        `;
        resultDiv.style.display = 'block';
    }
}

function hidePriceResult() {
    const resultDiv = document.getElementById('priceResult');
    if (resultDiv) {
        resultDiv.style.display = 'none';
    }
}

// Update neighborhoods based on selected district
function updateNeighborhoods(districtSelect, neighborhoodSelect) {
    const districtId = districtSelect.value;
    const neighborhoodSelectElement = document.getElementById(neighborhoodSelect);
    
    if (!neighborhoodSelectElement) return;
    
    // Clear existing options
    neighborhoodSelectElement.innerHTML = '<option value="">Semt Seçin</option>';
    
    if (!districtId) return;
    
    // This should be replaced with actual API call
    const neighborhoods = {
        '1': [
            { id: 1, name: 'Moda' },
            { id: 2, name: 'Fenerbahçe' },
            { id: 3, name: 'Göztepe' },
            { id: 4, name: 'Bostancı' }
        ],
        '2': [
            { id: 5, name: 'Etiler' },
            { id: 6, name: 'Levent' },
            { id: 7, name: 'Ortaköy' },
            { id: 8, name: 'Bebek' }
        ]
        // Add more districts as needed
    };
    
    const districtNeighborhoods = neighborhoods[districtId] || [];
    districtNeighborhoods.forEach(neighborhood => {
        const option = document.createElement('option');
        option.value = neighborhood.id;
        option.textContent = neighborhood.name;
        neighborhoodSelectElement.appendChild(option);
    });
}

// Contact form enhancement
function enhanceContactForm() {
    const contactForm = document.getElementById('contactForm');
    if (!contactForm) return;
    
    const phoneInput = contactForm.querySelector('input[name="phone"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('0')) {
                    value = '+90' + value.substring(1);
                } else if (!value.startsWith('+90')) {
                    value = '+90' + value;
                }
            }
            e.target.value = value;
        });
    }
}

// Initialize contact form enhancements
document.addEventListener('DOMContentLoaded', enhanceContactForm);

// Utility functions
function formatCurrency(amount) {
    return new Intl.NumberFormat('tr-TR', {
        style: 'currency',
        currency: 'TRY'
    }).format(amount);
}

function formatPhone(phone) {
    return phone.replace(/(\d{3})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4');
}

// Error handling
window.addEventListener('error', function(e) {
    console.error('JavaScript Error:', e.error);
    // You can add error reporting here
});

// Performance monitoring
window.addEventListener('load', function() {
    // Log page load time
    const loadTime = performance.now();
    console.log(`Page loaded in ${Math.round(loadTime)}ms`);
    
    // You can add performance tracking here
});

// Service Worker registration (for PWA features)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registered');
            })
            .catch(function(error) {
                console.log('ServiceWorker registration failed');
            });
    });
}