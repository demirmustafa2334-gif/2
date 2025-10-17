# 📦 Installation Guide - İstanbul Nakliyat

Complete step-by-step installation instructions.

---

## 🔧 System Requirements

### Minimum Requirements:
- **PHP**: 8.0 or higher
- **MySQL**: 5.7 or higher
- **Web Server**: Apache 2.4+ or Nginx
- **Disk Space**: 50 MB
- **Memory**: 128 MB

### Recommended:
- **PHP**: 8.1+
- **MySQL**: 8.0+
- **SSL Certificate**: For HTTPS
- **mod_rewrite**: Enabled (Apache)

### Required PHP Extensions:
- PDO
- PDO_MySQL
- mbstring
- json
- session

---

## 📥 Method 1: Automatic Installation (Recommended)

### Step 1: Download & Upload

1. Download the project files
2. Upload to your web server (via FTP, cPanel File Manager, etc.)
3. Extract if compressed

### Step 2: Set Permissions

**Linux/Unix:**
```bash
chmod 755 -R /path/to/project
chmod 777 /path/to/project/config/config.php
```

**cPanel:**
- Right-click folders → Permissions → 755
- Right-click config.php → Permissions → 666

### Step 3: Run Installation Wizard

1. Open browser and visit: `http://yourdomain.com/install.php`

2. Fill in the installation form:

   **Database Settings:**
   - Database Host: `localhost` (usually)
   - Database Name: `istanbul_nakliyat` (or your choice)
   - Database Username: Your MySQL username
   - Database Password: Your MySQL password

   **Site Settings:**
   - Site URL: `http://yourdomain.com` (no trailing slash)

3. Click **"Start Installation"**

4. Wait for completion message

5. **IMPORTANT**: Delete `install.php` for security:
   ```bash
   rm install.php
   ```

### Step 4: Login to Admin Panel

Visit: `http://yourdomain.com/admin`

**Default Credentials:**
- Username: `admin`
- Password: `admin123`

**🔒 CHANGE PASSWORD IMMEDIATELY!**

---

## 🛠️ Method 2: Manual Installation

For advanced users who prefer manual setup:

### Step 1: Create Database

**Using phpMyAdmin:**
1. Login to phpMyAdmin
2. Click "New" to create database
3. Name: `istanbul_nakliyat`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

**Using Command Line:**
```bash
mysql -u root -p
CREATE DATABASE istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Step 2: Import Database Schema

**Using phpMyAdmin:**
1. Select `istanbul_nakliyat` database
2. Click "Import" tab
3. Choose file: `config/database.sql`
4. Click "Go"

**Using Command Line:**
```bash
mysql -u username -p istanbul_nakliyat < config/database.sql
```

### Step 3: Configure Settings

Edit `config/config.php`:

```php
<?php
// Database Configuration
define('DB_HOST', 'localhost');           // Your database host
define('DB_NAME', 'istanbul_nakliyat');   // Your database name
define('DB_USER', 'root');                // Your database username
define('DB_PASS', '');                    // Your database password
define('DB_CHARSET', 'utf8mb4');

// Site Configuration
define('SITE_NAME', 'İstanbul Nakliyat');
define('SITE_URL', 'http://yourdomain.com');  // Your site URL (no trailing slash)
define('ADMIN_EMAIL', 'info@example.com');

// WhatsApp Configuration
define('WHATSAPP_NUMBER', '905xxxxxxxxx');

// Other settings...
?>
```

### Step 4: Configure Apache

Ensure `.htaccess` is working:

**Enable mod_rewrite (if not enabled):**
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

**Check Apache configuration:**
```apache
<Directory /var/www/html>
    AllowOverride All
    Require all granted
</Directory>
```

### Step 5: Set Permissions

```bash
chmod 755 -R /path/to/project
chmod 666 config/config.php
```

### Step 6: Test Installation

Visit: `http://yourdomain.com`

You should see the homepage.

---

## 🐳 Method 3: Docker Installation (Optional)

Create `docker-compose.yml`:

```yaml
version: '3.8'

services:
  web:
    image: php:8.1-apache
    ports:
      - "8080:80"
    volumes:
      - ./:/var/www/html
    depends_on:
      - db
    environment:
      - DB_HOST=db
      - DB_NAME=istanbul_nakliyat
      - DB_USER=root
      - DB_PASS=secret

  db:
    image: mysql:8.0
    environment:
      - MYSQL_ROOT_PASSWORD=secret
      - MYSQL_DATABASE=istanbul_nakliyat
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

Run:
```bash
docker-compose up -d
```

Visit: `http://localhost:8080`

---

## ✅ Post-Installation Steps

### 1. Change Admin Password

1. Login to admin panel
2. (Password change feature to be added)
3. Or update directly in database:
   ```sql
   UPDATE admin_users 
   SET password = '$2y$10$NEW_HASHED_PASSWORD' 
   WHERE username = 'admin';
   ```

### 2. Update Site Settings

Go to: **Admin Panel → Settings**

Update:
- ✅ Site title
- ✅ Contact phone
- ✅ Contact email
- ✅ WhatsApp number (format: 905XXXXXXXXX)
- ✅ Contact address
- ✅ Social media URLs
- ✅ Footer text

### 3. Add Content

**Add Districts:**
1. Go to: **Admin Panel → Districts → Add New**
2. Fill in district information
3. Add SEO metadata
4. Save

**Add Neighborhoods:**
1. Go to: **Admin Panel → Neighborhoods → Add New**
2. Select parent district
3. Fill in neighborhood information
4. Save

**Add Prices:**
1. Go to: **Admin Panel → Prices → Add New**
2. Select from/to districts
3. Enter pricing
4. Save

### 4. Enable SSL (HTTPS)

**Using Let's Encrypt (Free):**
```bash
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
```

Update `config/config.php`:
```php
define('SITE_URL', 'https://yourdomain.com');
```

Update `.htaccess` to force HTTPS:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### 5. Submit Sitemap to Google

1. Visit: [Google Search Console](https://search.google.com/search-console)
2. Add your property
3. Submit sitemap: `https://yourdomain.com/sitemap.xml`

### 6. Set Up Backups

**Automated Backup Script:**
```bash
#!/bin/bash
# backup.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups"

# Backup database
mysqldump -u username -p istanbul_nakliyat > $BACKUP_DIR/db_$DATE.sql

# Backup files
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /path/to/project

# Delete old backups (older than 30 days)
find $BACKUP_DIR -type f -mtime +30 -delete
```

**Add to cron (daily at 2 AM):**
```bash
0 2 * * * /path/to/backup.sh
```

---

## 🔍 Verification Checklist

After installation, verify:

- [ ] Homepage loads correctly
- [ ] Admin panel accessible
- [ ] Can login with default credentials
- [ ] District pages work (e.g., /istanbul/kadikoy)
- [ ] Contact form works
- [ ] Price calculator works
- [ ] Reviews display correctly
- [ ] WhatsApp button works
- [ ] Sitemap accessible (/sitemap.xml)
- [ ] Mobile responsive
- [ ] No PHP errors

---

## 🚨 Troubleshooting

### Issue: "Database Connection Error"

**Solution:**
1. Check database credentials in `config/config.php`
2. Verify database exists
3. Test MySQL connection:
   ```bash
   mysql -u username -p
   SHOW DATABASES;
   ```

### Issue: "404 - Page Not Found"

**Solution:**
1. Check `.htaccess` file exists
2. Enable mod_rewrite:
   ```bash
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```
3. Check Apache AllowOverride:
   ```apache
   AllowOverride All
   ```

### Issue: "Clean URLs Not Working"

**Solution:**
1. Verify mod_rewrite is enabled
2. Check `.htaccess` permissions (644)
3. Test rewrite manually:
   ```apache
   # Test .htaccess
   RewriteEngine On
   RewriteRule ^test$ index.php [L]
   ```
   Visit: `/test` - should load homepage

### Issue: "Permission Denied"

**Solution:**
```bash
# Fix permissions
chmod 755 -R /path/to/project
chown -R www-data:www-data /path/to/project
```

### Issue: "White Screen / No Output"

**Solution:**
1. Enable error reporting in `config/config.php`:
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```
2. Check PHP error log:
   ```bash
   tail -f /var/log/apache2/error.log
   ```

### Issue: "Cannot Login to Admin"

**Solution:**
1. Verify credentials: `admin` / `admin123`
2. Check sessions are working
3. Clear browser cache/cookies
4. Reset password in database:
   ```sql
   UPDATE admin_users 
   SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
   WHERE username = 'admin';
   -- Password: admin123
   ```

---

## 🌐 Different Hosting Environments

### Shared Hosting (cPanel)

1. Upload files via File Manager or FTP
2. Create database via MySQL Databases
3. Import SQL via phpMyAdmin
4. Edit config.php
5. Done!

### VPS / Dedicated Server

1. Install LAMP stack
2. Upload files to `/var/www/html`
3. Create database
4. Import SQL
5. Configure Apache
6. Set permissions
7. Enable SSL

### Nginx Configuration

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/html;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?url=$uri&$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    }
}
```

---

## 📊 Performance Optimization

### Enable Gzip Compression

Add to `.htaccess`:
```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>
```

### Enable Browser Caching

Add to `.htaccess`:
```apache
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### Enable OPcache (PHP)

In `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=60
```

---

## 🔐 Security Hardening

### 1. Change Default Credentials
Update admin password immediately

### 2. Disable Directory Listing
Already included in `.htaccess`

### 3. Hide PHP Version
In `.htaccess`:
```apache
Header unset X-Powered-By
ServerSignature Off
```

### 4. SQL Injection Protection
Already implemented via PDO prepared statements

### 5. XSS Protection
Already implemented via input sanitization

### 6. Update Regularly
Keep PHP and MySQL updated

---

## 📞 Support & Help

If you encounter issues:

1. **Check Documentation**
   - README.md
   - QUICKSTART.md
   - This file

2. **Check Logs**
   - PHP error log
   - Apache error log
   - MySQL error log

3. **Common Solutions**
   - Clear cache
   - Check permissions
   - Verify database
   - Test .htaccess

---

## ✅ Installation Complete!

Your Istanbul Nakliyat website is now installed and ready to use!

**Next Steps:**
1. ✅ Configure settings
2. ✅ Add districts
3. ✅ Add neighborhoods
4. ✅ Set prices
5. ✅ Approve reviews
6. ✅ Test everything
7. ✅ Go live!

---

**Need help?** Check README.md for complete documentation.

**Ready to launch?** See QUICKSTART.md for next steps.

🚀 **Happy Moving!**
