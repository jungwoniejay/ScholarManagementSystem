# Admin & Donor Account Setup

This guide explains how to create admin and donor accounts for ScholarHub.

## Account Credentials

### Admin Account
- **Email:** admin@scholarhub.com
- **Password:** admin123
- **Role:** Administrator
- **Access:** Full system access, manage scholarships, students, donors, and applications

### Donor Account
- **Email:** donor@scholarhub.com
- **Password:** donor123
- **Role:** Donor
- **Organization:** ScholarHub Foundation
- **Initial Fund:** ₱100,000.00
- **Access:** View and fund scholarships, track contributions

## How to Run the Seeders

### Option 1: Run Both Admin & Donor Seeder (Recommended)
```bash
php artisan db:seed --class=AdminAndDonorSeeder
```

### Option 2: Run Individual Seeders
```bash
# Create admin account only
php artisan db:seed --class=AdminUserSeeder

# Create donor account only
php artisan db:seed --class=DonorSeeder
```

### Option 3: Run All Seeders (includes admin, donor, and other data)
```bash
php artisan db:seed
```

## Verification

After running the seeder, you can verify the accounts were created:

1. **Check in Database:**
   - Open your database management tool (phpMyAdmin, MySQL Workbench, etc.)
   - Check the `users` table for the admin and donor accounts
   - Check the `donators` table for the donor profile

2. **Login Test:**
   - Navigate to your application login page
   - Try logging in with the credentials above
   - Verify you can access the respective dashboards

## Troubleshooting

### If accounts already exist:
The seeders check for existing accounts and won't create duplicates. You'll see a message like:
```
⚠ Admin account already exists: admin@scholarhub.com
```

### If you need to reset:
```bash
# Reset database and run all seeders
php artisan migrate:fresh --seed
```

**Warning:** This will delete all existing data!

### If you get permission errors:
Make sure your database connection is properly configured in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Security Notes

⚠️ **Important:** These are default credentials for development/testing purposes only.

For production environments:
1. Change the default passwords immediately
2. Use strong, unique passwords
3. Consider implementing two-factor authentication
4. Never commit real credentials to version control

## Next Steps

After creating the accounts:
1. Login as admin to configure system settings
2. Login as donor to explore funding options
3. Create student accounts for testing applications
4. Set up scholarships and test the application workflow

---

**Need Help?** Check the Laravel documentation or contact your development team.
