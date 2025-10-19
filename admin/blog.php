<?php
$page_title = 'Blog Yönetimi';
include 'includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-blog me-2"></i>Blog Yönetimi
            </h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">
                <i class="fas fa-plus me-2"></i>Yeni Yazı Ekle
            </button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Başlık</th>
                        <th>Slug</th>
                        <th>Durum</th>
                        <th>Yayın Tarihi</th>
                        <th>Oluşturulma</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($post['title']); ?></strong>
                            <?php if ($post['excerpt']): ?>
                                <br><small class="text-muted"><?php echo htmlspecialchars(substr($post['excerpt'], 0, 100)); ?>...</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <code><?php echo htmlspecialchars($post['slug']); ?></code>
                        </td>
                        <td>
                            <?php if ($post['is_published']): ?>
                                <span class="badge bg-success">Yayında</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Taslak</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $post['published_at'] ? date('d.m.Y H:i', strtotime($post['published_at'])) : '-'; ?>
                        </td>
                        <td>
                            <?php echo date('d.m.Y H:i', strtotime($post['created_at'])); ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="editPost(<?php echo htmlspecialchars(json_encode($post)); ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?action=blog&toggle=<?php echo $post['id']; ?>" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-toggle-<?php echo $post['is_published'] ? 'on' : 'off'; ?>"></i>
                                </a>
                                <a href="?action=blog&delete=<?php echo $post['id']; ?>" class="btn btn-sm btn-outline-danger btn-delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Post Modal -->
<div class="modal fade" id="createPostModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Blog Yazısı Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Başlık *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" readonly>
                                <small class="form-text text-muted">Otomatik oluşturulur</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Özet</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">İçerik *</label>
                        <textarea class="form-control summernote" id="content" name="content" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Öne Çıkan Görsel URL</label>
                        <input type="url" class="form-control" id="featured_image" name="featured_image">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Başlık</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">Meta Anahtar Kelimeler</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Açıklama</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="2"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published">
                            <label class="form-check-label" for="is_published">
                                Hemen yayınla
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" name="create_post" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" class="needs-validation" novalidate>
                <input type="hidden" id="edit_post_id" name="post_id">
                <div class="modal-header">
                    <h5 class="modal-title">Blog Yazısı Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="edit_title" class="form-label">Başlık *</label>
                                <input type="text" class="form-control" id="edit_title" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="edit_slug" name="slug" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_excerpt" class="form-label">Özet</label>
                        <textarea class="form-control" id="edit_excerpt" name="excerpt" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_content" class="form-label">İçerik *</label>
                        <textarea class="form-control summernote" id="edit_content" name="content" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_featured_image" class="form-label">Öne Çıkan Görsel URL</label>
                        <input type="url" class="form-control" id="edit_featured_image" name="featured_image">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_meta_title" class="form-label">Meta Başlık</label>
                                <input type="text" class="form-control" id="edit_meta_title" name="meta_title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_meta_keywords" class="form-label">Meta Anahtar Kelimeler</label>
                                <input type="text" class="form-control" id="edit_meta_keywords" name="meta_keywords">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_meta_description" class="form-label">Meta Açıklama</label>
                        <textarea class="form-control" id="edit_meta_description" name="meta_description" rows="2"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_is_published" name="is_published">
                            <label class="form-check-label" for="edit_is_published">
                                Yayında
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" name="update_post" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    const slug = this.value
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
    document.getElementById('slug').value = slug;
});

// Edit post function
function editPost(post) {
    document.getElementById('edit_post_id').value = post.id;
    document.getElementById('edit_title').value = post.title;
    document.getElementById('edit_slug').value = post.slug;
    document.getElementById('edit_excerpt').value = post.excerpt || '';
    document.getElementById('edit_content').value = post.content || '';
    document.getElementById('edit_featured_image').value = post.featured_image || '';
    document.getElementById('edit_meta_title').value = post.meta_title || '';
    document.getElementById('edit_meta_description').value = post.meta_description || '';
    document.getElementById('edit_meta_keywords').value = post.meta_keywords || '';
    document.getElementById('edit_is_published').checked = post.is_published == 1;
    
    const editModal = new bootstrap.Modal(document.getElementById('editPostModal'));
    editModal.show();
}
</script>