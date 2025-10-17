# İstanbul Evden Eve Nakliyat Website

Modern, SEO-optimized, mobile-first İstanbul local moving (nakliyat) website with full admin panel, dynamic pricing, and location-based pages.

## Features

### 🏠 Frontend Features
- **Responsive Design**: Mobile-first approach with Bootstrap 5
- **SEO Optimized**: Dynamic meta tags, schema markup, XML sitemap
- **Location Pages**: Individual pages for every Istanbul district and neighborhood
- **Dynamic Pricing**: Route-based pricing calculator
- **Customer Reviews**: Review system with rating display
- **Blog System**: Content management for blog posts
- **Contact Forms**: Quote requests and contact forms
- **WhatsApp Integration**: Floating WhatsApp button for instant contact

### ⚙️ Admin Panel Features
- **Dashboard**: Statistics and quick actions
- **Content Management**: Manage districts, neighborhoods, pages
- **Pricing Management**: Set route-based prices
- **Review Management**: Approve/reject customer reviews
- **Blog Management**: Create and manage blog posts
- **Settings**: Site configuration and SEO settings

### 🔍 SEO Features
- **Dynamic Meta Tags**: Title, description, keywords for each page
- **Schema Markup**: LocalBusiness structured data
- **XML Sitemap**: Auto-generated sitemap
- **Internal Linking**: Smart linking between related locations
- **Clean URLs**: SEO-friendly URL structure
- **Open Graph**: Social media optimization

## Requirements

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- mod_rewrite enabled

## Installation

### 1. Download and Setup

```bash
# Clone or download the project
git clone [repository-url]
cd istanbul-nakliyat

# Set proper permissions
chmod 755 -R .
chmod 777 -R uploads/
```

### 2. Database Setup

1. Create a MySQL database:
```sql
CREATE DATABASE istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Import the database schema:
```bash
mysql -u username -p istanbul_nakliyat < database/schema.sql
```

### 3. Configuration

1. Update database credentials in `config/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'istanbul_nakliyat');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

2. Update site settings in `config/config.php`:
```php
define('SITE_URL', 'https://yourdomain.com');
define('ADMIN_EMAIL', 'admin@yourdomain.com');
define('WHATSAPP_NUMBER', '+905551234567');
```

### 4. Web Server Configuration

#### Apache (.htaccess)
The included `.htaccess` file should work with most Apache configurations. Ensure mod_rewrite is enabled.

#### Nginx
Add this configuration to your Nginx server block:
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
```

### 5. Admin Access

Default admin credentials:
- Username: `admin`
- Password: `admin123`

**Important**: Change the admin password immediately after first login!

## Usage

### Admin Panel

1. Access admin panel at `/admin`
2. Login with admin credentials
3. Manage content through the dashboard

### Adding Districts and Neighborhoods

1. Go to Admin Panel > İlçeler
2. Add new districts with SEO metadata
3. Go to Admin Panel > Semtler
4. Add neighborhoods and assign to districts

### Setting Up Pricing

1. Go to Admin Panel > Fiyatlar
2. Add pricing routes between districts/neighborhoods
3. Set base prices, per-km rates, and minimum prices

### Managing Reviews

1. Go to Admin Panel > Yorumlar
2. Approve or reject customer reviews
3. Reviews appear on the frontend after approval

## File Structure

```
├── assets/
│   ├── css/
│   │   ├── style.css          # Frontend styles
│   │   └── admin.css          # Admin panel styles
│   └── js/
│       ├── script.js          # Frontend JavaScript
│       └── admin.js           # Admin panel JavaScript
├── config/
│   ├── config.php             # Site configuration
│   └── database.php           # Database connection
├── controllers/
│   ├── AdminController.php    # Admin panel controller
│   ├── HomeController.php     # Home page controller
│   ├── PageController.php     # Static pages controller
│   └── LocationController.php # District/neighborhood pages
├── core/
│   ├── Controller.php         # Base controller
│   ├── Model.php             # Base model
│   └── Router.php            # URL routing
├── database/
│   └── schema.sql            # Database schema
├── models/
│   ├── District.php          # District model
│   ├── Neighborhood.php      # Neighborhood model
│   ├── Pricing.php           # Pricing model
│   ├── Review.php            # Review model
│   ├── Page.php              # Page model
│   └── BlogPost.php          # Blog post model
├── views/
│   ├── layouts/
│   │   └── main.php          # Main layout
│   ├── admin/
│   │   ├── layout.php        # Admin layout
│   │   ├── login.php         # Admin login
│   │   └── dashboard.php     # Admin dashboard
│   ├── home/
│   │   └── index.php         # Home page
│   ├── pages/
│   │   ├── services.php      # Services page
│   │   ├── pricing.php       # Pricing page
│   │   ├── reviews.php       # Reviews page
│   │   ├── blog.php          # Blog page
│   │   └── contact.php       # Contact page
│   └── location/
│       ├── district.php      # District page
│       └── neighborhood.php  # Neighborhood page
├── .htaccess                 # URL rewriting
├── index.php                 # Main entry point
├── sitemap.php              # XML sitemap generator
└── robots.txt               # Search engine directives
```

## Customization

### Adding New Districts

1. Go to Admin Panel > İlçeler
2. Click "Yeni İlçe Ekle"
3. Fill in district information and SEO metadata
4. Save to automatically generate frontend page

### Customizing Styles

Edit `assets/css/style.css` for frontend styles and `assets/css/admin.css` for admin panel styles.

### Adding New Features

The MVC structure makes it easy to add new features:
1. Create model in `models/` directory
2. Add controller methods
3. Create views in appropriate directory
4. Update routing in `index.php`

## SEO Optimization

### Meta Tags
Each page automatically generates SEO-optimized meta tags based on content and location.

### Schema Markup
LocalBusiness schema is included for better search engine understanding.

### Sitemap
XML sitemap is automatically generated at `/sitemap.xml`

### Internal Linking
Pages are automatically linked based on geographic proximity.

## Performance

- Optimized database queries
- Lazy loading for images
- Minified CSS and JavaScript
- Browser caching headers
- GZIP compression

## Security

- Password hashing for admin users
- SQL injection prevention with PDO
- XSS protection with input sanitization
- CSRF protection for forms
- Secure file upload handling

## Support

For support and customization requests, please contact the development team.

## License

This project is proprietary software. All rights reserved.

## Changelog

### Version 1.0.0
- Initial release
- Full admin panel
- SEO optimization
- Mobile-responsive design
- Dynamic pricing system
- Review management
- Blog system