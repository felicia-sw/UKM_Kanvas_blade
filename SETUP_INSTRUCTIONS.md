# Quick Setup Guide

## Step 1: Run the Migration
Open your terminal and navigate to your project directory, then run:

```bash
php artisan migrate
```

This will create the `income_expenses` table in your database.

## Step 2: (Optional) Add Test Data
If you want to test the system with sample data:

```bash
php artisan db:seed --class=IncomeExpenseSeeder
```

This will create random income and expense entries for all your events.

## Step 3: Access the Feature
1. Login to admin panel
2. Go to **Events** page
3. Click **"Finances"** button next to any event
4. You'll see the financial recap page with all the features!

## What You Can Do Now

### View Financial Summary
- See total income from event registrations
- See manual income entries
- See all expenses
- See net balance (profit/loss)
- Monitor budget usage with color-coded progress bar

### Manage Income (Pemasukan)
- Click "Add Income" (green button)
- Add items like: sponsorships, donations, merchandise sales, etc.
- Edit or delete existing entries

### Manage Expenses (Pengeluaran)
- Click "Add Expense" (red button)
- Add items like: venue rental, equipment, food, transportation, etc.
- Edit or delete existing entries

### Budget Tracking
- The system automatically compares expenses to your event budget
- Shows warning if budget is exceeded
- Color indicators:
  - 🟢 Green: Under 80% of budget
  - 🟡 Yellow: 80-100% of budget
  - 🔴 Red: Over budget!

## Quick Navigation

### From Events Page
Each event has a **"Finances"** button that takes you directly to the financial recap.

### From Registrations Page
The header has a **"View Financial Recap"** button that shows you the full financial picture including registration income.

## Troubleshooting

### If migration fails:
1. Check your database connection in `.env`
2. Make sure your database exists
3. Try: `php artisan migrate:fresh` (WARNING: This will delete all data!)

### If you see errors:
1. Clear cache: `php artisan cache:clear`
2. Clear config: `php artisan config:clear`
3. Clear views: `php artisan view:clear`

## Tips

1. **Set Budget First**: When creating/editing events, set a budget amount
2. **Regular Updates**: Add income/expenses as they happen for accurate tracking
3. **Use Descriptions**: Add notes to each entry for better record-keeping
4. **Review Reports**: Check financial recap regularly during event planning

## Example Usage

### Adding Sponsorship Income
1. Go to event's financial recap
2. Click "Add Income"
3. Item Name: "Sponsorship - PT ABC"
4. Amount: 5,000,000
5. Date: Today's date
6. Description: "Gold sponsor package"
7. Save!

### Adding Venue Expense
1. Go to event's financial recap
2. Click "Add Expense"
3. Item Name: "Venue Rental"
4. Amount: 3,000,000
5. Date: Event date
6. Description: "Main hall for 2 days"
7. Save!

Now you can see:
- Total Income: Rp 5,000,000
- Total Expenses: Rp 3,000,000
- Net Balance: Rp 2,000,000 (profit!)

Enjoy your new financial management system! 🎉
