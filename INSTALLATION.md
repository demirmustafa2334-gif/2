# Quick Installation Guide

## 🚀 Quick Start (5 Minutes)

### Step 1: Database Setup
```sql
-- Create database
CREATE DATABASE istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Import schema
mysql -u root -p istanbul_nakliyat < database/schema.sql
```

### Step 2: Configure Database
Edit `config/database.php`:
```php
'host' => 'localhost',
'dbname' => 'istanbul_nakliyat',
'username' => 'your_db_user',
'password' => 'your_db_password',
```

### Step 3: Configure Application
Edit `config/app.php`:
```php
'url' => 'http://yourdomain.com',
'contact_email' => 'your@email.com',
'phone' => '+90 555 123 4567',
'whatsapp' => '+905551234567',
```

### Step 4: Set Permissions
```bash
chmod 755 public/uploads
chmod 644 config/*.php
```

### Step 5: Access Admin Panel
- URL: `http://yourdomain.com/admin`
- Username: `admin`
- Password: `admin123`

**⚠️ Change password immediately after first login!**

## 📋 Requirements Checklist

- [ ] PHP 8.0+
- [ ] MySQL 5.7+
- [ ] Apache with mod_rewrite
- [ ] 50MB disk space
- [ ] SSL certificate (recommended)

## 🔧 Apache Configuration

### Virtual Host Example
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /var/www/istanbul-nakliyat/public
    
    <Directory /var/www/istanbul-nakliyat/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

### Enable mod_rewrite
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

## 🎯 First Steps After Installation

1. **Login to Admin Panel**
   - Go to `/admin`
   - Login with default credentials
   - Change password in database

2. **Update Settings**
   - Navigate to "Ayarlar" (Settings)
   - Fill in your contact information
   - Add social media links

3. **Add Districts**
   - Go to "İlçeler" (Districts)
   - Add Istanbul districts you serve
   - Fill in SEO metadata

4. **Add Neighborhoods**
   - Go to "Semtler" (Neighborhoods)
   - Add neighborhoods for each district
   - Customize content

5. **Set Prices**
   - Go to "Fiyatlar" (Prices)
   - Add route-based prices
   - Users can calculate prices on homepage

## 🔐 Security Checklist

- [ ] Change default admin password
- [ ] Update database credentials
- [ ] Enable HTTPS
- [ ] Set proper file permissions
- [ ] Disable error display in production
- [ ] Configure firewall
- [ ] Regular backups

## 💾 Backup Recommendations

### Database Backup
```bash
mysqldump -u username -p istanbul_nakliyat > backup_$(date +%Y%m%d).sql
```

### File Backup
```bash
tar -czf backup_files_$(date +%Y%m%d).tar.gz /path/to/istanbul-nakliyat
```

## 🐛 Common Issues

### Issue: "404 on all pages"
**Solution:**
- Check `.htaccess` is in `public/` directory
- Enable mod_rewrite: `sudo a2enmod rewrite`
- Set `AllowOverride All` in Apache config

### Issue: "Database connection failed"
**Solution:**
- Verify credentials in `config/database.php`
- Check MySQL is running
- Ensure database exists

### Issue: "Permission denied on uploads"
**Solution:**
```bash
chmod 755 public/uploads
chown www-data:www-data public/uploads
```

### Issue: "Blank admin panel"
**Solution:**
- Enable error reporting temporarily
- Check PHP error logs
- Verify all files uploaded correctly

## 📱 Testing

### Frontend Testing
- [ ] Homepage loads correctly
- [ ] All navigation links work
- [ ] Contact form sends emails
- [ ] Price calculator works
- [ ] District pages display
- [ ] Neighborhood pages display
- [ ] Mobile responsive
- [ ] WhatsApp button works

### Admin Testing
- [ ] Login works
- [ ] Dashboard displays stats
- [ ] Can create/edit districts
- [ ] Can create/edit neighborhoods
- [ ] Can manage prices
- [ ] Can approve reviews
- [ ] Settings save correctly

## 🚀 Going Live Checklist

- [ ] Change admin password
- [ ] Update contact information
- [ ] Add all Istanbul districts
- [ ] Add neighborhoods
- [ ] Set up pricing
- [ ] Add customer reviews
- [ ] Configure email settings
- [ ] Test contact form
- [ ] Enable HTTPS
- [ ] Submit sitemap to Google
- [ ] Test mobile version
- [ ] Check page load speed
- [ ] Verify SEO metadata

## 📞 Need Help?

If you encounter any issues:
1. Check the main README.md
2. Review error logs
3. Verify server requirements
4. Contact support

---

**Installation Time:** ~5-10 minutes  
**Difficulty:** Easy  
**Support:** Full documentation available in README.md
