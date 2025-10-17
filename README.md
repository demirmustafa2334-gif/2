# İstanbul Evden Eve Nakliyat Website

Modern, SEO-optimized, mobile-first İstanbul local moving company website built with custom PHP and MySQL.

## Features

### 🏠 Frontend Features
- **Responsive Design**: Mobile-first approach with Bootstrap 5
- **SEO Optimized**: Dynamic meta tags, structured data, XML sitemap
- **Location Pages**: Auto-generated pages for all Istanbul districts and neighborhoods
- **Dynamic Pricing**: Interactive price calculator with route-based pricing
- **Contact Forms**: WhatsApp integration and contact form with email notifications
- **Customer Reviews**: Review system with rating display
- **Blog System**: Content management for blog posts
- **Performance**: Optimized for Lighthouse scores >90

### 🔧 Admin Panel Features
- **Dashboard**: Statistics and recent activity overview
- **Content Management**: CRUD operations for all content types
- **Location Management**: Add/edit districts and neighborhoods
- **Pricing Management**: Route-based pricing system
- **Review Management**: Approve/manage customer reviews
- **SEO Management**: Meta tags and content optimization
- **Contact Management**: Handle customer inquiries

### 🎯 SEO Features
- **Clean URLs**: SEO-friendly URL structure
- **Meta Tags**: Dynamic title, description, and keywords
- **Schema Markup**: Local business structured data
- **Internal Linking**: Automatic linking between related locations
- **XML Sitemap**: Auto-generated sitemap for search engines
- **Breadcrumbs**: Navigation breadcrumbs for better UX

## Installation

### Requirements
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- mod_rewrite enabled

### Setup Instructions

1. **Clone/Download** the project files to your web server directory

2. **Database Setup**:
   ```sql
   -- Create database
   CREATE DATABASE istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   
   -- Import the schema
   mysql -u username -p istanbul_nakliyat < database/schema.sql
   ```

3. **Configuration**:
   - Update `config/database.php` with your database credentials
   - Update `config/config.php` with your site settings
   - Change the admin password in the database (default: admin/password)

4. **File Permissions**:
   ```bash
   chmod 755 uploads/
   chmod 644 .htaccess
   ```

5. **Web Server Configuration**:
   - Ensure mod_rewrite is enabled
   - Point document root to the project directory
   - Test the installation by visiting your domain

## Usage

### Admin Panel Access
- URL: `yourdomain.com/admin`
- Default credentials: `admin` / `password`
- **Important**: Change the default password immediately

### Adding Content

#### Districts (İlçeler)
1. Go to Admin Panel → İlçeler
2. Click "Yeni İlçe Ekle"
3. Fill in the district information
4. SEO fields will auto-generate but can be customized

#### Neighborhoods (Semtler)
1. Go to Admin Panel → Semtler
2. Select the parent district
3. Add neighborhood details
4. SEO-optimized pages will be auto-generated

#### Pricing
1. Go to Admin Panel → Fiyatlandırma
2. Add route-based pricing
3. Prices will appear on the frontend calculator

#### Reviews
1. Go to Admin Panel → Yorumlar
2. Approve customer reviews
3. Reviews will display on relevant pages

### SEO Optimization

#### Meta Tags
- Each location page has customizable meta tags
- Auto-generated titles and descriptions
- Keywords can be customized per page

#### Internal Linking
- Automatic linking between related districts
- Footer links to all locations
- Breadcrumb navigation

#### Sitemap
- Auto-generated XML sitemap
- Accessible at `yourdomain.com/sitemap.xml`
- Updates automatically when content changes

## File Structure

```
/
├── admin/                 # Admin panel files
│   ├── index.php         # Dashboard
│   ├── login.php         # Login page
│   ├── districts.php     # District management
│   └── ...
├── config/               # Configuration files
│   ├── database.php      # Database connection
│   └── config.php        # Site settings
├── includes/             # Shared functions
│   └── functions.php     # Utility functions
├── views/                # Frontend pages
│   ├── layout.php        # Main layout template
│   ├── home.php          # Homepage
│   ├── services.php      # Services page
│   ├── pricing.php       # Pricing page
│   ├── contact.php       # Contact page
│   └── location.php      # Dynamic location pages
├── database/             # Database files
│   └── schema.sql        # Database schema
├── index.php             # Main entry point
├── .htaccess             # URL rewriting rules
└── sitemap.php           # Sitemap generator
```

## Customization

### Styling
- Modify CSS in `views/layout.php`
- Bootstrap 5 classes for responsive design
- Custom color scheme in CSS variables

### Content
- All text content is editable through admin panel
- Images can be uploaded and managed
- Contact information in `config/config.php`

### Functionality
- Add new features by extending the existing structure
- Database schema is easily extensible
- Admin panel can be customized for additional features

## Security Features

- **Password Hashing**: Secure password storage
- **SQL Injection Protection**: PDO prepared statements
- **XSS Protection**: Input sanitization
- **CSRF Protection**: Form token validation
- **File Upload Security**: Type and size validation

## Performance Optimization

- **Database Indexing**: Optimized queries
- **Image Optimization**: Lazy loading
- **Caching**: Static file caching
- **Compression**: Gzip compression
- **Minification**: CSS/JS minification

## Support

For technical support or customization requests, please contact the development team.

## License

This project is proprietary software. All rights reserved.

---

**Note**: This is a custom PHP application designed specifically for Istanbul moving companies. It includes all necessary features for a professional moving company website with full SEO optimization and admin management capabilities.