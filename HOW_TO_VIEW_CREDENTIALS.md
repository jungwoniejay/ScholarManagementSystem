# 🔑 How to View Login Credentials

## Quick Access Methods

### Method 1: Credentials Page (Recommended)
Visit: **http://localhost/ScholarManagementSystem/credentials**

This page displays:
- ✅ Admin login credentials
- ✅ Donor login credentials  
- ✅ Copy buttons for easy use
- ✅ Direct login links
- ✅ Beautiful interface matching the landing page

### Method 2: Login Page Banner
Visit: **http://localhost/ScholarManagementSystem/login**

You'll see a gold banner at the top showing:
- Admin email & password
- Donor email & password
- Link to full credentials page

### Method 3: Navigation Menu
On the landing page (**http://localhost/ScholarManagementSystem**):
- Look for "🔑 Credentials" in the navigation menu (gold colored)
- Click it to view the full credentials page

### Method 4: Text Files
Check these files in your project folder:
- `LOGIN_CREDENTIALS.txt` - Formatted credentials card
- `SEEDER_INSTRUCTIONS.md` - Full setup guide

---

## 📧 Login Credentials

### ADMIN ACCOUNT
```
Email:    admin@scholarhub.com
Password: admin123
```

### DONOR ACCOUNT
```
Email:    donor@scholarhub.com
Password: donor123
```

---

## 🚀 Quick Login Steps

1. Go to: http://localhost/ScholarManagementSystem/login
2. See the credentials in the gold banner at the top
3. Copy the email and password
4. Paste into the login form
5. Click "Sign In"

---

## 💡 Tips

- The credentials page has **copy buttons** for easy copying
- Credentials are also shown on the **login page** itself
- All pages use the same elegant design as your landing page
- The navigation menu has a gold "🔑 Credentials" link

---

**Need to recreate accounts?**
Run: `php artisan db:seed --class=AdminAndDonorSeeder`
