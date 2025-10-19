        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'sehirler.php' ? 'active' : ''; ?>" href="sehirler.php">
                            <i class="fas fa-city"></i>
                            Şehirler
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'ilceler.php' ? 'active' : ''; ?>" href="ilceler.php">
                            <i class="fas fa-map-marker-alt"></i>
                            İlçeler
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>" href="blog.php">
                            <i class="fas fa-newspaper"></i>
                            Blog Yazıları
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'ai-yazi-olustur.php' ? 'active' : ''; ?>" href="ai-yazi-olustur.php">
                            <i class="fas fa-robot"></i>
                            AI Yazı Oluştur
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'mesajlar.php' ? 'active' : ''; ?>" href="mesajlar.php">
                            <i class="fas fa-envelope"></i>
                            Mesajlar
                            <?php 
                            $messageModel = new ContactMessage();
                            $unreadCount = $messageModel->getUnreadCount();
                            if ($unreadCount > 0): 
                            ?>
                                <span class="badge bg-danger ms-2"><?php echo $unreadCount; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase text-light">
                    <span>İçerik Yönetimi</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="sehir-ekle.php">
                            <i class="fas fa-plus"></i>
                            Yeni Şehir Ekle
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="blog-ekle.php">
                            <i class="fas fa-pen"></i>
                            Yeni Yazı Ekle
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="toplu-icerik.php">
                            <i class="fas fa-layer-group"></i>
                            Toplu İçerik
                        </a>
                    </li>
                </ul>
                
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase text-light">
                    <span>Ayarlar</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'ayarlar.php' ? 'active' : ''; ?>" href="ayarlar.php">
                            <i class="fas fa-cog"></i>
                            Site Ayarları
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                            Siteyi Görüntüle
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="../sitemap.xml" target="_blank">
                            <i class="fas fa-sitemap"></i>
                            Site Haritası
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="yedekleme.php">
                            <i class="fas fa-download"></i>
                            Yedekleme
                        </a>
                    </li>
                </ul>
            </div>
        </nav>