// Admin Panel JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
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
    
    // Confirm delete actions
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Bu öğeyi silmek istediğinizden emin misiniz?')) {
                e.preventDefault();
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
    
    // Add loading state to forms
    const submitButtons = document.querySelectorAll('button[type="submit"]');
    submitButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.form && this.form.checkValidity()) {
                this.innerHTML = '<span class="spinner me-2"></span>Kaydediliyor...';
                this.disabled = true;
            }
        });
    });
    
    // Toggle sidebar on mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.admin-sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768 && sidebar && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });
    
    // Table row selection
    const selectAllCheckbox = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActions();
        });
    }
    
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
    
    function updateBulkActions() {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const bulkActions = document.getElementById('bulkActions');
        
        if (bulkActions) {
            if (checkedBoxes.length > 0) {
                bulkActions.style.display = 'block';
                document.getElementById('selectedCount').textContent = checkedBoxes.length;
            } else {
                bulkActions.style.display = 'none';
            }
        }
    }
    
    // Bulk actions
    const bulkActionForm = document.getElementById('bulkActionForm');
    if (bulkActionForm) {
        bulkActionForm.addEventListener('submit', function(e) {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const action = document.getElementById('bulkAction').value;
            
            if (checkedBoxes.length === 0) {
                e.preventDefault();
                alert('Lütfen en az bir öğe seçin.');
                return;
            }
            
            if (action === 'delete') {
                if (!confirm('Seçili öğeleri silmek istediğinizden emin misiniz?')) {
                    e.preventDefault();
                }
            }
        });
    }
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Sortable tables
    const sortableHeaders = document.querySelectorAll('.sortable');
    sortableHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const table = this.closest('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const column = Array.from(this.parentNode.children).indexOf(this);
            const isAscending = this.classList.contains('sort-asc');
            
            // Remove sort classes from all headers
            sortableHeaders.forEach(h => h.classList.remove('sort-asc', 'sort-desc'));
            
            // Add appropriate sort class to current header
            this.classList.add(isAscending ? 'sort-desc' : 'sort-asc');
            
            // Sort rows
            rows.sort((a, b) => {
                const aText = a.children[column].textContent.trim();
                const bText = b.children[column].textContent.trim();
                
                if (isAscending) {
                    return bText.localeCompare(aText);
                } else {
                    return aText.localeCompare(bText);
                }
            });
            
            // Re-append sorted rows
            rows.forEach(row => tbody.appendChild(row));
        });
    });
    
    // Image preview for file inputs
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    imageInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(input.dataset.preview);
                    if (preview) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });
    
    // Character counter for textareas
    const textareas = document.querySelectorAll('textarea[data-max-length]');
    textareas.forEach(textarea => {
        const maxLength = parseInt(textarea.dataset.maxLength);
        const counter = document.createElement('small');
        counter.className = 'text-muted';
        counter.style.display = 'block';
        counter.style.textAlign = 'right';
        textarea.parentNode.appendChild(counter);
        
        function updateCounter() {
            const remaining = maxLength - textarea.value.length;
            counter.textContent = `${remaining} karakter kaldı`;
            counter.className = remaining < 0 ? 'text-danger' : 'text-muted';
        }
        
        textarea.addEventListener('input', updateCounter);
        updateCounter();
    });
    
    // Auto-save functionality for forms
    const autoSaveForms = document.querySelectorAll('.auto-save');
    autoSaveForms.forEach(form => {
        const inputs = form.querySelectorAll('input, textarea, select');
        let saveTimeout;
        
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(saveTimeout);
                saveTimeout = setTimeout(() => {
                    saveFormData(form);
                }, 2000); // Save after 2 seconds of inactivity
            });
        });
    });
    
    function saveFormData(form) {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        
        // Save to localStorage
        localStorage.setItem(`form_${form.id}`, JSON.stringify(data));
        
        // Show save indicator
        const indicator = document.createElement('div');
        indicator.className = 'alert alert-info alert-dismissible fade show position-fixed';
        indicator.style.top = '20px';
        indicator.style.right = '20px';
        indicator.style.zIndex = '9999';
        indicator.innerHTML = `
            <i class="fas fa-save me-2"></i>
            Form verisi kaydedildi
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(indicator);
        
        setTimeout(() => {
            indicator.remove();
        }, 3000);
    }
    
    // Load saved form data
    const formsWithId = document.querySelectorAll('form[id]');
    formsWithId.forEach(form => {
        const savedData = localStorage.getItem(`form_${form.id}`);
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input && input.type !== 'file') {
                    input.value = data[key];
                }
            });
        }
    });
    
    // Clear saved form data on successful submit
    const submitForms = document.querySelectorAll('form');
    submitForms.forEach(form => {
        form.addEventListener('submit', function() {
            if (this.id) {
                localStorage.removeItem(`form_${this.id}`);
            }
        });
    });
    
    // Export functionality
    const exportButtons = document.querySelectorAll('.btn-export');
    exportButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const format = this.dataset.format;
            const table = this.closest('.card').querySelector('table');
            
            if (format === 'csv') {
                exportToCSV(table);
            } else if (format === 'excel') {
                exportToExcel(table);
            }
        });
    });
    
    function exportToCSV(table) {
        const rows = Array.from(table.querySelectorAll('tr'));
        const csv = rows.map(row => {
            const cells = Array.from(row.querySelectorAll('th, td'));
            return cells.map(cell => `"${cell.textContent.trim()}"`).join(',');
        }).join('\n');
        
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'export.csv';
        a.click();
        window.URL.revokeObjectURL(url);
    }
    
    function exportToExcel(table) {
        // This would require a library like SheetJS for full Excel export
        // For now, we'll export as CSV
        exportToCSV(table);
    }
    
    // Print functionality
    const printButtons = document.querySelectorAll('.btn-print');
    printButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            window.print();
        });
    });
    
    // Refresh data
    const refreshButtons = document.querySelectorAll('.btn-refresh');
    refreshButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            location.reload();
        });
    });
    
    // Real-time updates (if needed)
    if (window.location.pathname.includes('/admin/reviews')) {
        // Check for new reviews every 30 seconds
        setInterval(() => {
            fetch('/admin/api/reviews/count')
                .then(response => response.json())
                .then(data => {
                    const badge = document.querySelector('.reviews-badge');
                    if (badge && badge.textContent !== data.count) {
                        badge.textContent = data.count;
                        badge.classList.add('animate__animated', 'animate__pulse');
                        setTimeout(() => {
                            badge.classList.remove('animate__animated', 'animate__pulse');
                        }, 1000);
                    }
                })
                .catch(error => console.log('Error checking for updates:', error));
        }, 30000);
    }
});

// Utility functions
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

function confirmAction(message, callback) {
    if (confirm(message)) {
        callback();
    }
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('tr-TR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('tr-TR', {
        style: 'currency',
        currency: 'TRY'
    }).format(amount);
}