# İstanbul Nakliyat - Custom PHP Moving Company Website

A professional, SEO-optimized, mobile-first local moving company website built with custom PHP. Features a complete admin panel, dynamic pricing, location-based pages, and perfect internal linking for SEO.

## 🚀 Features

### Frontend Features
- ✅ Modern, responsive design with Tailwind CSS
- ✅ SEO-optimized with meta tags, schema markup, and sitemap
- ✅ Dynamic pages for Istanbul districts and neighborhoods
- ✅ Route-based pricing calculator
- ✅ Customer reviews and testimonials
- ✅ Blog system
- ✅ Contact form with email notifications
- ✅ WhatsApp integration (floating button)
- ✅ Mobile-first responsive design
- ✅ Fast page load times
- ✅ Clean, semantic HTML structure

### Admin Panel Features
- ✅ Secure login system
- ✅ Dashboard with statistics
- ✅ Manage districts (ilçeler)
- ✅ Manage neighborhoods (semtler)
- ✅ Manage route-based prices
- ✅ Manage customer reviews (approve/delete)
- ✅ Manage blog posts
- ✅ Manage pages
- ✅ General settings (contact info, social media, etc.)
- ✅ SEO metadata management for all pages

### Technical Features
- ✅ PHP 8+ with MVC architecture
- ✅ MySQL database with PDO
- ✅ Clean URL routing with .htaccess
- ✅ Session management
- ✅ XSS and SQL injection protection
- ✅ Image upload handling
- ✅ Slug generation (Turkish character support)
- ✅ Helper functions for common tasks

## 📋 Requirements

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache web server with mod_rewrite enabled
- Composer (optional, for future package management)

## 🔧 Installation

### 1. Clone or Download the Repository

```bash
git clone <repository-url>
cd istanbul-nakliyat
```

### 2. Configure Database

Edit `config/database.php` with your database credentials:

```php
return [
    'host' => 'localhost',
    'dbname' => 'istanbul_nakliyat',
    'username' => 'your_username',
    'password' => 'your_password',
    'charset' => 'utf8mb4',
];
```

### 3. Create Database

Create a new MySQL database:

```sql
CREATE DATABASE istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Import Database Schema

Import the database schema:

```bash
mysql -u your_username -p istanbul_nakliyat < database/schema.sql
```

Or import via phpMyAdmin by importing `database/schema.sql`

### 5. Configure Application

Edit `config/app.php` and update settings:

```php
'url' => 'http://yourdomain.com',
'contact_email' => 'your@email.com',
'phone' => '+90 555 123 4567',
'whatsapp' => '+905551234567',
```

### 6. Set File Permissions

Set proper permissions for upload directories:

```bash
chmod 755 public/uploads
chmod 755 public/images
```

### 7. Configure Apache

Make sure your Apache virtual host points to the `public` directory:

```apache
<VirtualHost *:80>
    DocumentRoot "/path/to/istanbul-nakliyat/public"
    ServerName yourdomain.com
    
    <Directory "/path/to/istanbul-nakliyat/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Or if using shared hosting, make sure to upload files and set the web root to the `public` folder.

## 🔐 Admin Panel Access

### Default Admin Credentials

- **URL**: `http://yourdomain.com/admin`
- **Username**: `admin`
- **Password**: `admin123`

**⚠️ IMPORTANT**: Change the default password immediately after first login!

### Changing Admin Password

To change the admin password, run this SQL query (replace `newpassword` with your desired password):

```sql
UPDATE admin_users 
SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE username = 'admin';
```

Or use this PHP code to generate a new password hash:

```php
echo password_hash('newpassword', PASSWORD_DEFAULT);
```

## 📁 Project Structure

```
istanbul-nakliyat/
├── app/
│   ├── controllers/        # Application controllers
│   ├── models/            # Database models
│   └── views/             # View templates
│       ├── admin/         # Admin panel views
│       ├── frontend/      # Frontend views
│       ├── layouts/       # Layout templates
│       └── partials/      # Reusable components
├── config/                # Configuration files
│   ├── app.php           # App settings
│   └── database.php      # Database config
├── core/                  # Core framework files
│   ├── Controller.php    # Base controller
│   ├── Database.php      # Database handler
│   ├── Router.php        # URL router
│   ├── Session.php       # Session manager
│   └── helpers.php       # Helper functions
├── database/             # Database files
│   └── schema.sql       # Database schema
├── public/              # Public web root
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   ├── images/         # Static images
│   ├── uploads/        # User uploads
│   ├── .htaccess       # Apache config
│   └── index.php       # Entry point
└── README.md
```

## 🎯 Usage Guide

### Adding New Districts

1. Login to admin panel
2. Navigate to "İlçeler" (Districts)
3. Click "Yeni İlçe Ekle" (Add New District)
4. Fill in the form:
   - **Name**: District name (e.g., "Kadıköy")
   - **Slug**: Auto-generated or custom URL slug
   - **Description**: Short description
   - **Content**: Full page content
   - **SEO Settings**: Meta title, description, keywords
5. Click "Kaydet" (Save)

### Adding Neighborhoods

1. Navigate to "Semtler" (Neighborhoods)
2. Click "Yeni Semt Ekle"
3. Select parent district
4. Fill in name, content, and SEO settings
5. Save

### Managing Prices

1. Navigate to "Fiyatlar" (Prices)
2. Click "Yeni Fiyat Ekle"
3. Select "From District" and "To District"
4. Enter base price
5. Save

The price calculator on the homepage will automatically use these prices.

### Managing Reviews

1. Navigate to "Yorumlar" (Reviews)
2. View all submitted reviews
3. Click "Onayla" to approve a review
4. Approved reviews will appear on the website

### General Settings

1. Navigate to "Ayarlar" (Settings)
2. Update:
   - Site name and description
   - Contact information
   - WhatsApp number
   - Social media links
3. Save changes

## 🔍 SEO Features

### Automatic SEO Optimization

- **Meta Tags**: Each page has customizable meta titles and descriptions
- **Schema Markup**: Automatic LocalBusiness schema for better search visibility
- **Breadcrumbs**: Automatic breadcrumb navigation with schema
- **Sitemap**: Auto-generated XML sitemap at `/sitemap.xml`
- **Clean URLs**: SEO-friendly URLs for all pages
- **Internal Linking**: Automatic linking between districts and neighborhoods

### Customizing SEO

For each district/neighborhood page, you can set:
- Meta Title
- Meta Description  
- Meta Keywords
- Custom content with proper heading structure

## 🎨 Customization

### Changing Colors

Edit `public/css/style.css` or use Tailwind's configuration in your HTML templates.

### Adding New Pages

1. Admin Panel → "Sayfalar" → "Yeni Sayfa Ekle"
2. Or programmatically add routes in `public/index.php`

### Customizing Email Templates

Edit the email sending code in `app/controllers/FrontendController.php` (contact method)

## 🚀 Performance Optimization

### Recommended Optimizations

1. **Enable Caching**: Use OPcache for PHP
2. **Image Optimization**: Compress images before uploading
3. **CDN**: Use a CDN for static assets
4. **Minification**: Minify CSS and JavaScript for production
5. **Database Indexing**: Database already has proper indexes

### Production Settings

For production, edit `public/index.php`:

```php
// Disable error display
error_reporting(0);
ini_set('display_errors', 0);

// Enable error logging
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');
```

## 🔒 Security

### Security Features Included

- ✅ Password hashing with bcrypt
- ✅ SQL injection protection (PDO prepared statements)
- ✅ XSS protection (output escaping)
- ✅ CSRF protection (recommended to add tokens)
- ✅ Session security
- ✅ Input sanitization

### Additional Security Recommendations

1. Change default admin credentials
2. Use HTTPS in production
3. Keep PHP and MySQL updated
4. Set proper file permissions
5. Regular backups
6. Consider adding rate limiting for forms

## 📱 Mobile Optimization

The website is fully responsive and mobile-optimized:
- Mobile-first design approach
- Touch-friendly buttons and navigation
- Optimized images for mobile
- Fast loading on mobile networks

## 🌐 Browser Support

- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)
- ✅ Mobile browsers

## 🐛 Troubleshooting

### Common Issues

**"404 Not Found" on all pages**
- Check that mod_rewrite is enabled
- Verify .htaccess is in the public directory
- Check Apache AllowOverride is set to All

**Database connection error**
- Verify database credentials in config/database.php
- Ensure database exists
- Check MySQL is running

**Blank page / White screen**
- Enable error reporting to see errors
- Check PHP error logs
- Verify all required PHP extensions are installed

**Images not uploading**
- Check file permissions on public/uploads
- Verify upload_max_filesize in php.ini
- Check allowed file extensions in config

## 📞 Support

For issues, questions, or contributions, please contact:
- Email: support@example.com

## 📄 License

This project is proprietary software. All rights reserved.

## 🙏 Credits

Built with:
- PHP 8+
- MySQL
- Tailwind CSS
- Font Awesome
- Custom MVC Framework

---

**Made with ❤️ for Istanbul Nakliyat**
