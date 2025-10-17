<?php
require_once '../config/database.php';
require_once '../config/config.php';
require_once '../includes/functions.php';

requireLogin();

$db = new Database();
$conn = $db->getConnection();

$message = '';
$error = '';

// Handle form submissions
if ($_POST) {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        $name = sanitize($_POST['name']);
        $slug = generateSlug($name);
        $description = sanitize($_POST['description']);
        $meta_title = sanitize($_POST['meta_title']);
        $meta_description = sanitize($_POST['meta_description']);
        $meta_keywords = sanitize($_POST['meta_keywords']);
        
        $stmt = $conn->prepare("INSERT INTO districts (name, slug, description, meta_title, meta_description, meta_keywords) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$name, $slug, $description, $meta_title, $meta_description, $meta_keywords])) {
            $message = 'İlçe başarıyla eklendi.';
            generateSitemap(); // Regenerate sitemap
        } else {
            $error = 'İlçe eklenirken bir hata oluştu.';
        }
    } elseif ($action === 'edit') {
        $id = (int)$_POST['id'];
        $name = sanitize($_POST['name']);
        $slug = generateSlug($name);
        $description = sanitize($_POST['description']);
        $meta_title = sanitize($_POST['meta_title']);
        $meta_description = sanitize($_POST['meta_description']);
        $meta_keywords = sanitize($_POST['meta_keywords']);
        $status = isset($_POST['status']) ? 1 : 0;
        
        $stmt = $conn->prepare("UPDATE districts SET name = ?, slug = ?, description = ?, meta_title = ?, meta_description = ?, meta_keywords = ?, status = ? WHERE id = ?");
        
        if ($stmt->execute([$name, $slug, $description, $meta_title, $meta_description, $meta_keywords, $status, $id])) {
            $message = 'İlçe başarıyla güncellendi.';
            generateSitemap(); // Regenerate sitemap
        } else {
            $error = 'İlçe güncellenirken bir hata oluştu.';
        }
    } elseif ($action === 'delete') {
        $id = (int)$_POST['id'];
        
        $stmt = $conn->prepare("DELETE FROM districts WHERE id = ?");
        
        if ($stmt->execute([$id])) {
            $message = 'İlçe başarıyla silindi.';
            generateSitemap(); // Regenerate sitemap
        } else {
            $error = 'İlçe silinirken bir hata oluştu.';
        }
    }
}

// Get all districts
$stmt = $conn->prepare("SELECT * FROM districts ORDER BY name");
$stmt->execute();
$districts = $stmt->fetchAll();

// Get district for editing
$edit_district = null;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM districts WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_district = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlçe Yönetimi - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 12px 20px;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        .sidebar .nav-link.active {
            background: #007bff;
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0">
                <div class="sidebar">
                    <div class="p-3">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="/admin">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link active" href="/admin/districts">
                            <i class="fas fa-map-marker-alt me-2"></i>İlçeler
                        </a>
                        <a class="nav-link" href="/admin/neighborhoods">
                            <i class="fas fa-location-dot me-2"></i>Semtler
                        </a>
                        <a class="nav-link" href="/admin/pages">
                            <i class="fas fa-file-alt me-2"></i>Sayfalar
                        </a>
                        <a class="nav-link" href="/admin/blog">
                            <i class="fas fa-blog me-2"></i>Blog
                        </a>
                        <a class="nav-link" href="/admin/reviews">
                            <i class="fas fa-star me-2"></i>Yorumlar
                        </a>
                        <a class="nav-link" href="/admin/pricing">
                            <i class="fas fa-dollar-sign me-2"></i>Fiyatlandırma
                        </a>
                        <a class="nav-link" href="/admin/messages">
                            <i class="fas fa-envelope me-2"></i>Mesajlar
                        </a>
                        <a class="nav-link" href="/admin/settings">
                            <i class="fas fa-cog me-2"></i>Ayarlar
                        </a>
                        <a class="nav-link" href="/admin/logout">
                            <i class="fas fa-sign-out-alt me-2"></i>Çıkış
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10">
                <div class="main-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>İlçe Yönetimi</h2>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fas fa-plus me-2"></i>Yeni İlçe Ekle
                        </button>
                    </div>
                    
                    <?php if ($message): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>İlçe Adı</th>
                                            <th>Slug</th>
                                            <th>Durum</th>
                                            <th>Oluşturulma</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($districts as $district): ?>
                                        <tr>
                                            <td><?php echo $district['id']; ?></td>
                                            <td><?php echo sanitize($district['name']); ?></td>
                                            <td><?php echo sanitize($district['slug']); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $district['status'] ? 'success' : 'danger'; ?>">
                                                    <?php echo $district['status'] ? 'Aktif' : 'Pasif'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d.m.Y H:i', strtotime($district['created_at'])); ?></td>
                                            <td>
                                                <a href="?edit=<?php echo $district['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="/istanbul/<?php echo $district['slug']; ?>" target="_blank" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteDistrict(<?php echo $district['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add/Edit Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php echo $edit_district ? 'İlçe Düzenle' : 'Yeni İlçe Ekle'; ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="<?php echo $edit_district ? 'edit' : 'add'; ?>">
                        <?php if ($edit_district): ?>
                            <input type="hidden" name="id" value="<?php echo $edit_district['id']; ?>">
                        <?php endif; ?>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">İlçe Adı *</label>
                                <input type="text" class="form-control" id="name" name="name" required 
                                       value="<?php echo $edit_district ? sanitize($edit_district['name']) : ''; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" readonly 
                                       value="<?php echo $edit_district ? sanitize($edit_district['slug']) : ''; ?>">
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Açıklama</label>
                                <textarea class="form-control" id="description" name="description" rows="3"><?php echo $edit_district ? sanitize($edit_district['description']) : ''; ?></textarea>
                            </div>
                            <div class="col-12">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                       value="<?php echo $edit_district ? sanitize($edit_district['meta_title']) : ''; ?>">
                            </div>
                            <div class="col-12">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="2"><?php echo $edit_district ? sanitize($edit_district['meta_description']) : ''; ?></textarea>
                            </div>
                            <div class="col-12">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                       value="<?php echo $edit_district ? sanitize($edit_district['meta_keywords']) : ''; ?>">
                            </div>
                            <?php if ($edit_district): ?>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" 
                                           <?php echo $edit_district['status'] ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary">
                            <?php echo $edit_district ? 'Güncelle' : 'Ekle'; ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Delete Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" id="deleteId">
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-generate slug
        document.getElementById('name').addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .replace(/ç/g, 'c')
                .replace(/ğ/g, 'g')
                .replace(/ı/g, 'i')
                .replace(/ö/g, 'o')
                .replace(/ş/g, 's')
                .replace(/ü/g, 'u')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s-]+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
        });
        
        // Delete function
        function deleteDistrict(id) {
            if (confirm('Bu ilçeyi silmek istediğinizden emin misiniz?')) {
                document.getElementById('deleteId').value = id;
                document.getElementById('deleteForm').submit();
            }
        }
        
        // Show modal if editing
        <?php if ($edit_district): ?>
        document.addEventListener('DOMContentLoaded', function() {
            new bootstrap.Modal(document.getElementById('addModal')).show();
        });
        <?php endif; ?>
    </script>
</body>
</html>