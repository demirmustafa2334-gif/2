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
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pages.php' ? 'active' : ''; ?>" href="pages.php">
                            <i class="fas fa-file-alt"></i>
                            Sayfalar
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'districts.php' ? 'active' : ''; ?>" href="districts.php">
                            <i class="fas fa-map-marker-alt"></i>
                            İlçeler
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'neighborhoods.php' ? 'active' : ''; ?>" href="neighborhoods.php">
                            <i class="fas fa-location-dot"></i>
                            Mahalleler
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pricing.php' ? 'active' : ''; ?>" href="pricing.php">
                            <i class="fas fa-dollar-sign"></i>
                            Fiyatlandırma
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'reviews.php' ? 'active' : ''; ?>" href="reviews.php">
                            <i class="fas fa-star"></i>
                            Yorumlar
                            <?php 
                            $reviewModel = new Review();
                            $pendingCount = $reviewModel->count('is_approved = 0');
                            if ($pendingCount > 0): 
                            ?>
                                <span class="badge bg-warning ms-2"><?php echo $pendingCount; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>" href="blog.php">
                            <i class="fas fa-blog"></i>
                            Blog
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'messages.php' ? 'active' : ''; ?>" href="messages.php">
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
                    <span>Ayarlar</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>" href="settings.php">
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
                        <a class="nav-link" href="../sitemap.php" target="_blank">
                            <i class="fas fa-sitemap"></i>
                            Site Haritası
                        </a>
                    </li>
                </ul>
            </div>
        </nav>