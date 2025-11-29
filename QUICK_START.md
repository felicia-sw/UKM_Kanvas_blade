# 🚀 Quick Start Guide - Event Financial Management

## 📋 What You Got

A complete financial management system for events that tracks:
- ✅ Event registration income (automatic from payments)
- ✅ Manual income entries (sponsorships, donations, etc.)
- ✅ Expense entries (venue, equipment, food, etc.)
- ✅ Budget monitoring with visual alerts
- ✅ Net balance calculation (profit/loss)

## ⚡ 3 Steps to Start

### 1️⃣ Run Migration (Required)
```bash
php artisan migrate
```

### 2️⃣ Add Test Data (Optional)
```bash
php artisan db:seed --class=IncomeExpenseSeeder
```

### 3️⃣ Go to Admin Panel
- Login → Events → Click "Finances" button

## 🎯 Main Features

### Financial Recap Page
**URL:** `/admin/events/{event}/finances`

Shows you:
- 💰 Total Registration Income
- 💵 Total Manual Income  
- 💸 Total Expenses
- 💼 Net Balance (profit/loss)
- 📊 Budget Usage Progress Bar

### Add Income (Pemasukan)
Click green "Add Income" button
- Sponsorships
- Donations
- Merchandise sales
- Other income sources

### Add Expense (Pengeluaran)
Click red "Add Expense" button
- Venue rental
- Equipment
- Food & beverages
- Transportation
- Marketing

## 🎨 Color Codes

Budget Status:
- 🟢 **Green** (0-79%): You're safe!
- 🟡 **Yellow** (80-100%): Warning, getting close
- 🔴 **Red** (>100%): Budget exceeded! ⚠️

Balance:
- 🟢 **Green** (Positive): Making profit
- 🔴 **Red** (Negative): Running at loss

## 🔗 Where to Access

### From Events Page
Each event has: `[Registrations] [Finances] [View Docs] [Edit] [Delete]`
                                  ⬆️ Click this!

### From Registrations Page
Header has: `[View Financial Recap]`
                    ⬆️ Click this!

## 📝 Quick Example

### Scenario: Workshop Event

**Registration Income** (automatic)
- 10 people × Rp 150,000 = Rp 1,500,000

**Manual Income** (you add)
- Sponsorship: Rp 5,000,000
- Merchandise: Rp 500,000
- Total: Rp 5,500,000

**Expenses** (you add)
- Venue: Rp 3,000,000
- Equipment: Rp 1,500,000
- Food: Rp 800,000
- Total: Rp 5,300,000

**Results**
- Total Income: Rp 7,000,000
- Total Expenses: Rp 5,300,000
- Net Balance: Rp 1,700,000 🟢 (PROFIT!)
- Budget (Rp 10M): 53% used 🟢 (SAFE!)

## 🛠️ Common Tasks

### Adding Sponsorship Income
1. Go to Financial Recap
2. Click "Add Income"
3. Item: "Sponsorship - PT ABC"
4. Amount: 5000000
5. Date: Select date
6. Description: "Gold sponsor package"
7. Save!

### Adding Venue Expense
1. Go to Financial Recap
2. Click "Add Expense"
3. Item: "Venue Rental"
4. Amount: 3000000
5. Date: Event date
6. Description: "Main hall, 2 days"
7. Save!

### Editing Entry
1. Click ✏️ (edit icon)
2. Modify fields
3. Click "Update"

### Deleting Entry
1. Click 🗑️ (delete icon)
2. Confirm deletion
3. Done!

## 🚨 Troubleshooting

### "Migration Failed"
```bash
# Check your database connection
php artisan config:clear
php artisan migrate
```

### "Page Not Loading"
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### "Can't See the Page"
- Make sure you're logged in as admin
- Check: User → is_admin = true in database

### "Numbers Don't Match"
- Verify registrations have `payment_status = 'verified'`
- Check entries in database table `income_expenses`
- Refresh the page

## 📚 Full Documentation

For detailed info, check:
1. **SETUP_INSTRUCTIONS.md** - Step-by-step setup
2. **FINANCIAL_MANAGEMENT_README.md** - Complete feature guide
3. **IMPLEMENTATION_SUMMARY.md** - Technical details
4. **DATABASE_DIAGRAM.md** - How it all works
5. **CHECKLIST.md** - Testing checklist

## 💡 Pro Tips

1. **Set Event Budget First** - Enable budget monitoring
2. **Add Entries Regularly** - Keep finances up to date
3. **Use Descriptions** - Note why you spent/earned
4. **Check Before Event** - Review financial status
5. **Review After Event** - Analyze profit/loss

## 🎉 You're Ready!

Now you can:
- ✅ Track all event income
- ✅ Track all event expenses
- ✅ Monitor your budget
- ✅ See profit/loss instantly
- ✅ Make better financial decisions

**Happy event managing! 🚀**

---

Need help? Check the documentation files or:
- Laravel Docs: https://laravel.com/docs
- Bootstrap Docs: https://getbootstrap.com/docs

**Version:** 1.0  
**Created:** November 30, 2025  
**Status:** ✅ Ready to Use
