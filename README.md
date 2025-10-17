# 🚛 İstanbul Nakliyat - Custom PHP Script

Modern, SEO-optimized, mobile-first local moving (nakliyat) website script built with PHP and MySQL.

## ✨ Features

### Frontend Features
- **Responsive Design**: Mobile-first, fully responsive layout
- **SEO Optimized**: 
  - Dynamic meta tags for all pages
  - Schema.org markup for local business
  - XML sitemap generation
  - SEO-friendly URLs
  - Breadcrumb navigation
  - Open Graph and Twitter Card support
- **Location-Based Pages**: 
  - Individual pages for each Istanbul district
  - Individual pages for each neighborhood
  - Internal linking between related locations
- **Dynamic Content**: 
  - Service pages
  - Blog system
  - Customer reviews with ratings
  - Price calculator
- **User Experience**: 
  - WhatsApp floating button
  - Contact form
  - Review submission
  - Smooth animations
  - Fast page loading

### Admin Panel Features
- **Secure Authentication**: Login system with password hashing
- **Dashboard**: Quick stats and overview
- **District Management**: Add, edit, delete districts with SEO fields
- **Neighborhood Management**: Manage neighborhoods linked to districts
- **Price Management**: Route-based pricing (from → to)
- **Review Management**: Approve, feature, or delete customer reviews
- **Message Management**: View contact form submissions
- **Settings**: Global site settings (contact info, social media, etc.)
- **SEO Control**: Meta titles, descriptions for all pages

## 🛠️ Technical Stack

- **Backend**: PHP 8+ with MVC architecture
- **Database**: MySQL with PDO
- **Frontend**: Bootstrap 5, Font Awesome 6
- **JavaScript**: Vanilla JS (no frameworks)
- **Architecture**: 
  - Clean MVC structure
  - Separation of concerns
  - Reusable components
  - Secure database queries with prepared statements

## 📋 Requirements

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- mod_rewrite enabled (for clean URLs)

## 🚀 Installation

### Method 1: Using Installation Wizard (Recommended)

1. **Upload Files**: Upload all files to your web server

2. **Set Permissions**:
   ```bash
   chmod 755 -R /path/to/project
   chmod 777 config/config.php
   ```

3. **Run Installer**: Navigate to `http://yourdomain.com/install.php`

4. **Fill in Database Details**:
   - Database host (usually `localhost`)
   - Database name (e.g., `istanbul_nakliyat`)
   - Database username
   - Database password
   - Site URL

5. **Complete Installation**: Click "Start Installation"

6. **Remove Installer**: Delete or rename `install.php` for security

### Method 2: Manual Installation

1. **Create Database**:
   ```sql
   CREATE DATABASE istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. **Import SQL**:
   ```bash
   mysql -u username -p istanbul_nakliyat < config/database.sql
   ```

3. **Edit Configuration**: Update `/config/config.php` with your settings:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'istanbul_nakliyat');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   define('SITE_URL', 'http://yourdomain.com');
   ```

4. **Configure Apache**: Ensure `.htaccess` is working properly

## 🔐 Default Login

- **URL**: `http://yourdomain.com/admin`
- **Username**: `admin`
- **Password**: `admin123`

⚠️ **Important**: Change the admin password immediately after first login!

## 📁 Project Structure

```
istanbul-nakliyat/
├── app/
│   ├── controllers/         # All controller files
│   ├── models/             # Database models
│   ├── views/
│   │   ├── admin/          # Admin panel views
│   │   └── frontend/       # Public website views
│   ├── Controller.php      # Base controller
│   ├── Database.php        # Database connection
│   └── Router.php          # URL routing
├── config/
│   ├── config.php          # Configuration file
│   └── database.sql        # Database schema
├── public/
│   └── assets/
│       ├── css/            # Stylesheets
│       ├── js/             # JavaScript files
│       └── images/         # Image files
├── .htaccess               # Apache rewrite rules
├── index.php               # Application entry point
├── install.php             # Installation wizard
└── README.md               # Documentation
```

## 🎯 Usage Guide

### Adding New Districts

1. Log in to Admin Panel
2. Navigate to "İlçeler" (Districts)
3. Click "Yeni İlçe Ekle" (Add New District)
4. Fill in:
   - District name
   - Slug (auto-generated if left empty)
   - Meta title (SEO)
   - Meta description (SEO)
   - Content
5. Check "Active" to publish
6. Click "Save"

### Adding Neighborhoods

1. Go to "Semtler" (Neighborhoods)
2. Click "Yeni Semt Ekle"
3. Select parent district
4. Fill in details and SEO fields
5. Save

### Managing Prices

1. Go to "Fiyatlar" (Prices)
2. Click "Yeni Fiyat Ekle"
3. Select "From District" and "To District"
4. Enter base price and price per km
5. Add optional notes
6. Save

### Approving Reviews

1. Go to "Yorumlar" (Reviews)
2. Find pending reviews (marked as "Beklemede")
3. Click "Onayla" to approve
4. Approved reviews appear on the website

## ⚙️ Configuration

### Site Settings

Access via Admin Panel → Settings:
- Site title and tagline
- Contact information
- WhatsApp number
- Social media links
- Google Maps API key
- Footer text

### SEO Configuration

Each page type has SEO fields:
- **Meta Title**: Appears in search results
- **Meta Description**: Brief page description
- **Schema Markup**: Auto-generated for local business

### URL Structure

- Homepage: `/`
- Services: `/hizmetler`
- District: `/istanbul/{district-slug}`
- Neighborhood: `/semt/{neighborhood-slug}`
- Blog: `/blog/{post-slug}`
- Prices: `/fiyatlar`
- Reviews: `/yorumlar`
- Contact: `/iletisim`
- Admin: `/admin`
- Sitemap: `/sitemap.xml`

## 🔒 Security Features

- Password hashing with bcrypt
- SQL injection protection (PDO prepared statements)
- XSS protection (output sanitization)
- CSRF protection
- Session security
- Input validation
- Secure admin area

## 🎨 Customization

### Changing Colors

Edit `/public/assets/css/style.css`:
```css
:root {
    --primary-color: #0d6efd;  /* Change to your brand color */
    --secondary-color: #6c757d;
    /* ... */
}
```

### Adding Custom Pages

1. Create route in `index.php`
2. Create controller method
3. Create view file
4. Link from navigation

## 📱 Mobile Optimization

- Responsive design (Bootstrap 5)
- Touch-friendly interface
- Fast loading times
- Optimized images
- Mobile-first approach

## 🚀 Performance

- Lightweight (no heavy frameworks)
- Optimized database queries
- Lazy loading images
- Minified assets
- Server-side rendering
- Clean code structure

## 🐛 Troubleshooting

### Clean URLs Not Working

Ensure mod_rewrite is enabled:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Check `.htaccess` is being read.

### Database Connection Error

Verify credentials in `config/config.php`
Check MySQL service is running

### 404 Errors

Ensure `.htaccess` file exists and is readable
Check Apache configuration allows `.htaccess` overrides

## 📊 Database Schema

Main tables:
- `districts` - Istanbul districts
- `neighborhoods` - Neighborhoods linked to districts
- `services` - Service offerings
- `prices` - Route-based pricing
- `reviews` - Customer reviews
- `blog_posts` - Blog articles
- `contact_messages` - Contact form submissions
- `settings` - Site-wide settings
- `admin_users` - Admin accounts

## 🔄 Updates

To update:
1. Backup your database
2. Backup your files
3. Replace files (keep `/config/config.php`)
4. Run any new SQL migrations
5. Clear browser cache

## 📝 License

This is a custom script. Modify and use as needed for your project.

## 💡 Tips

- **SEO**: Fill all meta fields for better search rankings
- **Content**: Add unique content to each location page
- **Reviews**: Encourage customers to leave reviews
- **Internal Linking**: Link related districts and neighborhoods
- **Performance**: Optimize images before uploading
- **Security**: Change default admin password
- **Backup**: Regularly backup database and files

## 🤝 Support

For issues or questions:
1. Check this README
2. Review the code comments
3. Check error logs (`/logs` if configured)

## 🎯 SEO Checklist

✅ Unique meta titles for all pages
✅ Meta descriptions under 160 characters
✅ Schema.org markup
✅ XML sitemap
✅ SEO-friendly URLs
✅ Breadcrumb navigation
✅ Internal linking
✅ Mobile-friendly
✅ Fast loading
✅ Social media tags

## 📈 Future Enhancements

Potential features to add:
- Multi-language support
- Online booking system
- Payment integration
- Real-time tracking
- Email notifications
- Advanced analytics
- Image gallery
- FAQ system
- Live chat

## 🙏 Credits

Built with:
- Bootstrap 5
- Font Awesome 6
- PHP 8
- MySQL
- Vanilla JavaScript

---

**Version**: 1.0
**Last Updated**: 2025

Made with ❤️ for Istanbul local moving companies
