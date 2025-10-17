    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Admin JS -->
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
        
        // Confirm delete actions
        function confirmDelete(message = 'Bu işlemi gerçekleştirmek istediğinizden emin misiniz?') {
            return confirm(message);
        }
        
        // Auto-generate slug from title
        function generateSlug(titleInput, slugInput) {
            const title = titleInput.value;
            const slug = title
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
        
        // Character counter for text areas
        function updateCharCount(textarea, counter, maxLength) {
            const currentLength = textarea.value.length;
            counter.textContent = currentLength + '/' + maxLength;
            
            if (currentLength > maxLength * 0.9) {
                counter.classList.add('text-warning');
            } else {
                counter.classList.remove('text-warning');
            }
            
            if (currentLength >= maxLength) {
                counter.classList.add('text-danger');
                counter.classList.remove('text-warning');
            } else {
                counter.classList.remove('text-danger');
            }
        }
        
        // Initialize character counters
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea[data-max-length]');
            textareas.forEach(function(textarea) {
                const maxLength = parseInt(textarea.dataset.maxLength);
                const counter = document.getElementById(textarea.id + '-counter');
                
                if (counter) {
                    updateCharCount(textarea, counter, maxLength);
                    textarea.addEventListener('input', function() {
                        updateCharCount(textarea, counter, maxLength);
                    });
                }
            });
        });
        
        // Form validation
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