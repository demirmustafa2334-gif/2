# İstanbul Nakliyat - Custom PHP Script

Modern, SEO-optimized, mobile-first Istanbul local moving company website built with custom PHP, MySQL, and Bootstrap 5.

## 🚛 Features

### Frontend Features
- **Responsive Design**: Mobile-first approach with Bootstrap 5
- **SEO Optimized**: Dynamic meta tags, structured data, XML sitemap
- **Clean URLs**: SEO-friendly URLs for all pages
- **Dynamic Content**: Auto-generated pages for districts and neighborhoods
- **WhatsApp Integration**: Floating WhatsApp button for instant contact
- **Contact Forms**: Quote request and contact forms with validation
- **Blog System**: Full-featured blog with categories and tags
- **Review System**: Customer reviews with rating system
- **Pricing Calculator**: Dynamic route-based pricing calculator

### Admin Panel Features
- **Secure Authentication**: Password-protected admin login
- **Content Management**: Full CRUD operations for all content
- **District Management**: Add/edit/delete Istanbul districts
- **Neighborhood Management**: Add/edit/delete neighborhoods with district association
- **Review Management**: Approve/delete customer reviews
- **Blog Management**: Create/edit/publish blog posts with rich text editor
- **Pricing Management**: Manage route-based pricing
- **Settings Management**: Site-wide settings and configuration

### SEO Features
- **Dynamic Meta Tags**: Auto-generated meta titles, descriptions, and keywords
- **Structured Data**: Schema.org markup for local business
- **XML Sitemap**: Auto-generated sitemap for search engines
- **Internal Linking**: Smart internal linking between related pages
- **Open Graph**: Social media sharing optimization
- **Breadcrumbs**: SEO-friendly breadcrumb navigation

## 🛠️ Technical Stack

- **Backend**: PHP 8+ with PDO
- **Database**: MySQL 5.7+
- **Frontend**: Bootstrap 5, Font Awesome, Swiper.js
- **Architecture**: MVC pattern
- **Security**: CSRF protection, input sanitization, password hashing

## 📁 Project Structure

```
istanbul-nakliyat/
├── admin/                  # Admin panel
│   ├── includes/          # Admin header/footer
│   ├── index.php          # Admin main controller
│   ├── dashboard.php      # Admin dashboard
│   ├── districts.php      # District management
│   ├── neighborhoods.php  # Neighborhood management
│   ├── reviews.php        # Review management
│   ├── blog.php           # Blog management
│   ├── pricing.php        # Pricing management
│   └── settings.php       # Site settings
├── config/                # Configuration files
│   ├── config.php         # Main configuration
│   └── database.php       # Database connection
├── models/                # Data models
│   ├── PageModel.php
│   ├── DistrictModel.php
│   ├── NeighborhoodModel.php
│   ├── ReviewModel.php
│   ├── BlogModel.php
│   └── PricingModel.php
├── views/                 # Frontend views
│   ├── includes/          # Header/footer
│   ├── home.php           # Homepage
│   ├── district.php       # District pages
│   ├── neighborhood.php   # Neighborhood pages
│   ├── services.php       # Services page
│   ├── pricing.php        # Pricing page
│   ├── reviews.php        # Reviews page
│   ├── blog.php           # Blog listing
│   ├── blog_post.php      # Blog post detail
│   ├── contact.php        # Contact page
│   ├── quote.php          # Quote request page
│   └── 404.php            # 404 error page
├── database.sql           # Database schema
├── index.php              # Main router
├── sitemap.php            # XML sitemap generator
├── robots.php             # Robots.txt generator
├── .htaccess              # URL rewriting rules
└── README.md              # This file
```

## 🚀 Installation

### Prerequisites
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- mod_rewrite enabled (for Apache)

### Installation Steps

1. **Clone/Download** the project files to your web server directory

2. **Create Database**
   ```sql
   CREATE DATABASE istanbul_moving CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. **Import Database Schema**
   ```bash
   mysql -u username -p istanbul_moving < database.sql
   ```

4. **Configure Database Connection**
   Edit `config/database.php` with your database credentials:
   ```php
   private $host = 'localhost';
   private $db_name = 'istanbul_moving';
   private $username = 'your_username';
   private $password = 'your_password';
   ```

5. **Set Permissions**
   ```bash
   chmod 755 uploads/
   chmod 644 .htaccess
   ```

6. **Access the Website**
   - Frontend: `http://yourdomain.com`
   - Admin Panel: `http://yourdomain.com/admin`
   - Default admin credentials: `admin` / `admin123`

## 🔧 Configuration

### Site Settings
Access the admin panel and go to Settings to configure:
- Site title and description
- Contact information
- Social media links
- Google Maps API key
- WhatsApp number

### SEO Settings
Each page supports individual SEO settings:
- Meta title
- Meta description
- Meta keywords
- Open Graph tags

### Pricing Configuration
Set up route-based pricing in the admin panel:
- Base prices for district-to-district routes
- Price per kilometer
- Estimated distances
- Neighborhood-specific pricing

## 📱 Mobile Responsiveness

The website is fully responsive and optimized for:
- Mobile phones (320px+)
- Tablets (768px+)
- Desktop computers (1024px+)

## 🔍 SEO Features

### URL Structure
- Homepage: `/`
- Services: `/hizmetlerimiz`
- Pricing: `/fiyat-listesi`
- Reviews: `/musteri-yorumlari`
- Blog: `/blog`
- Contact: `/iletisim`
- Quote: `/teklif-al`
- Districts: `/istanbul/{district-slug}-evden-eve-nakliyat`
- Neighborhoods: `/istanbul/{district-slug}/{neighborhood-slug}-evden-eve-nakliyat`
- Blog Posts: `/blog/{post-slug}`

### SEO Optimizations
- Dynamic meta tags for all pages
- Structured data markup
- XML sitemap generation
- Internal linking system
- Mobile-friendly design
- Fast loading times
- Clean URL structure

## 🛡️ Security Features

- CSRF token protection
- Input sanitization and validation
- Password hashing
- SQL injection prevention with PDO
- XSS protection
- Secure file upload handling

## 📊 Performance

- Optimized database queries
- Lazy loading for images
- Minified CSS and JavaScript
- Gzip compression
- Browser caching
- CDN-ready structure

## 🎨 Customization

### Adding New Districts/Neighborhoods
1. Go to Admin Panel > Districts
2. Add new district with SEO data
3. Go to Admin Panel > Neighborhoods
4. Add neighborhoods and associate with districts

### Customizing Design
- Edit CSS in `views/includes/header.php`
- Modify Bootstrap classes in view files
- Update color scheme in CSS variables

### Adding New Features
- Create new models in `models/` directory
- Add new views in `views/` directory
- Update router in `index.php`
- Add admin pages in `admin/` directory

## 📞 Support

For support and customization requests, please contact the development team.

## 📄 License

This project is proprietary software. All rights reserved.

---

**İstanbul Nakliyat** - Professional Moving Services in Istanbul
Built with ❤️ using modern web technologies