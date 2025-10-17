// Admin Panel JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Confirm delete actions
    const deleteLinks = document.querySelectorAll('a[href*="/delete/"]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Bu öğeyi silmek istediğinizden emin misiniz?')) {
                e.preventDefault();
            }
        });
    });
    
    // Auto-generate slug from title
    const nameInput = document.querySelector('input[name="name"]');
    const slugInput = document.querySelector('input[name="slug"]');
    
    if (nameInput && slugInput) {
        let slugManuallyEdited = false;
        
        slugInput.addEventListener('input', function() {
            slugManuallyEdited = true;
        });
        
        nameInput.addEventListener('input', function() {
            if (!slugManuallyEdited) {
                slugInput.value = generateSlug(this.value);
            }
        });
    }
    
    // Character counter for text fields
    const textareas = document.querySelectorAll('textarea[data-max-length]');
    textareas.forEach(textarea => {
        const maxLength = textarea.dataset.maxLength;
        const counter = document.createElement('div');
        counter.className = 'text-sm text-gray-500 mt-1';
        textarea.parentNode.appendChild(counter);
        
        function updateCounter() {
            const remaining = maxLength - textarea.value.length;
            counter.textContent = `${remaining} karakter kaldı`;
            if (remaining < 0) {
                counter.classList.add('text-red-500');
            } else {
                counter.classList.remove('text-red-500');
            }
        }
        
        textarea.addEventListener('input', updateCounter);
        updateCounter();
    });
    
    // Table row actions
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.classList.add('bg-gray-50');
        });
        row.addEventListener('mouseleave', function() {
            this.classList.remove('bg-gray-50');
        });
    });
    
    // Image preview
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    imageInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let preview = input.parentNode.querySelector('.image-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.className = 'image-preview mt-2 max-w-xs rounded';
                        input.parentNode.appendChild(preview);
                    }
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
    
    // Sortable tables (if needed, requires additional library)
    // Example: SortableJS
    
    // Quick search in tables
    const searchInputs = document.querySelectorAll('input[data-table-search]');
    searchInputs.forEach(input => {
        const tableId = input.dataset.tableSearch;
        const table = document.getElementById(tableId);
        
        input.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});

// Utility function to generate slug
function generateSlug(text) {
    const turkish = ['ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'ç', 'Ç'];
    const english = ['s', 's', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c'];
    
    for (let i = 0; i < turkish.length; i++) {
        text = text.replace(new RegExp(turkish[i], 'g'), english[i]);
    }
    
    return text
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
}

// Bulk actions
function toggleAllCheckboxes(source) {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selected[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}

function performBulkAction(action) {
    const selected = Array.from(document.querySelectorAll('input[name="selected[]"]:checked'))
        .map(cb => cb.value);
    
    if (selected.length === 0) {
        alert('Lütfen en az bir öğe seçin.');
        return;
    }
    
    if (!confirm(`${selected.length} öğe üzerinde "${action}" işlemini gerçekleştirmek istediğinizden emin misiniz?`)) {
        return;
    }
    
    // Perform action via AJAX or form submission
    console.log(`Performing ${action} on:`, selected);
}
