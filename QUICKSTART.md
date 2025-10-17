# 🚀 Quick Start Guide - İstanbul Nakliyat

Get your Istanbul moving company website up and running in 5 minutes!

## ⚡ Fast Installation (3 Steps)

### Step 1: Upload Files
Upload all project files to your web hosting (via FTP, cPanel, etc.)

### Step 2: Run Installer
Visit: `http://yourdomain.com/install.php`

Fill in the form:
- **Database Host**: `localhost`
- **Database Name**: `istanbul_nakliyat` (or any name)
- **Database User**: Your MySQL username
- **Database Password**: Your MySQL password
- **Site URL**: `http://yourdomain.com`

Click "Start Installation" ✅

### Step 3: Login
Visit: `http://yourdomain.com/admin`

Login credentials:
- **Username**: `admin`
- **Password**: `admin123`

**🔒 IMPORTANT**: Change your password immediately!

---

## 📝 After Installation

### 1. Update Site Settings (2 min)
Go to: **Admin Panel → Settings**

Update:
- ✅ Site title
- ✅ Phone number
- ✅ Email address
- ✅ WhatsApp number (format: 905XXXXXXXXX)
- ✅ Social media links

### 2. Add Your Districts (5 min)
Go to: **Admin Panel → Districts → Add New**

Example for Kadıköy:
- **Name**: Kadıköy
- **Slug**: kadikoy (auto-generated)
- **Meta Title**: Kadıköy Evden Eve Nakliyat | İstanbul Nakliyat
- **Meta Description**: Kadıköy'de güvenilir evden eve nakliyat hizmetleri...
- **Content**: Custom description
- ✅ Check "Active"

Repeat for other districts (Beşiktaş, Şişli, Üsküdar, etc.)

### 3. Add Neighborhoods (5 min)
Go to: **Admin Panel → Neighborhoods → Add New**

- Select parent district
- Add neighborhood name
- Fill SEO fields
- Save

### 4. Set Up Pricing (3 min)
Go to: **Admin Panel → Prices → Add New**

- **From**: Kadıköy
- **To**: Beşiktaş
- **Base Price**: 800
- **Price per KM**: 15
- Save

Add more routes as needed.

### 5. Approve Reviews (Optional)
Go to: **Admin Panel → Reviews**

Sample reviews are already added. Click "Approve" to publish them.

---

## ✅ You're Done!

Your website is now live! 🎉

Visit: `http://yourdomain.com`

---

## 🎯 Next Steps

### Recommended Actions:

1. **Delete Installer**: Remove or rename `install.php` for security
2. **Change Password**: Go to admin panel and update your password
3. **Add More Content**: 
   - Add more districts (aim for 20+)
   - Add neighborhoods to each district
   - Write blog posts
4. **Customize Design**: Edit `/public/assets/css/style.css`
5. **SEO**: 
   - Submit sitemap to Google: `http://yourdomain.com/sitemap.xml`
   - Set up Google Search Console
   - Add Google Analytics

---

## 📱 Main URLs

- **Homepage**: `/`
- **Services**: `/hizmetler`
- **Prices**: `/fiyatlar`
- **Reviews**: `/yorumlar`
- **Blog**: `/blog`
- **Contact**: `/iletisim`
- **Admin Panel**: `/admin`
- **Sitemap**: `/sitemap.xml`

Example district page: `/istanbul/kadikoy`
Example neighborhood page: `/semt/moda`

---

## 🆘 Common Issues

### Problem: "Database Connection Error"
**Solution**: Check your database credentials in `config/config.php`

### Problem: "404 Page Not Found"
**Solution**: 
1. Enable mod_rewrite in Apache
2. Ensure .htaccess file exists
3. Check AllowOverride is set to All in Apache config

### Problem: "Clean URLs not working"
**Solution**: 
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### Problem: "Cannot login to admin"
**Solution**: 
- Default username: `admin`
- Default password: `admin123`
- If changed and forgotten, reset via database

---

## 📊 SEO Checklist

After setup, verify:

✅ Each district has unique meta title
✅ Each district has meta description
✅ Sitemap is accessible
✅ WhatsApp button works
✅ Contact form works
✅ Reviews are visible
✅ Mobile-responsive (test on phone)
✅ Fast loading (use PageSpeed Insights)

---

## 💡 Pro Tips

1. **Content is King**: Add unique, valuable content to each district page
2. **Internal Linking**: Link related districts and neighborhoods
3. **Reviews**: Ask customers for reviews - they boost SEO
4. **Blog**: Post regularly about moving tips, guides
5. **Images**: Add quality images (optimize before uploading)
6. **Local SEO**: Include location keywords naturally
7. **Schema**: Already included - helps Google understand your business
8. **Mobile**: Most users are mobile - test thoroughly

---

## 📞 Support

If you encounter issues:
1. Check `README.md` for detailed documentation
2. Review error logs
3. Check database connection
4. Verify file permissions

---

## 🎨 Customization Tips

### Change Primary Color:
Edit `/public/assets/css/style.css`:
```css
:root {
    --primary-color: #YOUR_COLOR;
}
```

### Change Logo:
Edit `/app/views/frontend/header.php`

### Add More Services:
Insert directly into database or create admin interface

---

## 📈 Performance Tips

1. **Enable Caching**: Use browser caching in .htaccess
2. **Optimize Images**: Compress before upload
3. **CDN**: Consider using CDN for assets
4. **SSL**: Install SSL certificate (Let's Encrypt is free)
5. **Gzip**: Enable gzip compression

---

## 🔐 Security Tips

1. ✅ Delete install.php after installation
2. ✅ Change default admin password
3. ✅ Use strong passwords
4. ✅ Keep PHP/MySQL updated
5. ✅ Regular backups
6. ✅ Use HTTPS (SSL)

---

## 📦 What's Included

- ✅ Responsive design
- ✅ Admin panel
- ✅ SEO optimization
- ✅ Schema markup
- ✅ XML sitemap
- ✅ Contact forms
- ✅ Review system
- ✅ Blog system
- ✅ Price calculator
- ✅ WhatsApp integration
- ✅ 5 sample districts
- ✅ 4 services
- ✅ 3 sample reviews
- ✅ Clean, modern design

---

## 🚀 Launch Checklist

Before going live:

- [ ] Database created and imported
- [ ] Config file updated
- [ ] Admin password changed
- [ ] Site settings updated
- [ ] Districts added
- [ ] Prices configured
- [ ] Contact info updated
- [ ] WhatsApp number set
- [ ] Reviews approved
- [ ] install.php deleted
- [ ] SSL installed
- [ ] Tested on mobile
- [ ] Contact form tested
- [ ] Sitemap submitted to Google

---

**You're ready to launch! 🎉**

Your professional Istanbul moving company website is now live and optimized for SEO!

Need more help? Check `README.md` for complete documentation.
