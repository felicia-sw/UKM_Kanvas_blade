# Event Financial Management System

## Overview
This system allows admins to manage event finances including:
- Event registrations income tracking
- Manual income entries (pemasukan)
- Expense entries (pengeluaran)
- Budget monitoring and alerts
- Financial recap and reporting

## Database Structure

### `income_expenses` Table
- `id`: Primary key
- `event_id`: Foreign key to events table
- `type`: ENUM ('income', 'expense')
- `item_name`: Name of income/expense item
- `amount`: Decimal amount (10,2)
- `description`: Optional text description
- `transaction_date`: Date of transaction
- `created_at`, `updated_at`: Timestamps

## Setup Instructions

### 1. Run Migration
```bash
php artisan migrate
```

This will create the `income_expenses` table.

### 2. (Optional) Seed Test Data
```bash
php artisan db:seed --class=IncomeExpenseSeeder
```

This will create sample income and expense entries for all events.

## Features

### 1. Financial Recap Page
**Route:** `/admin/events/{event}/finances`

Displays:
- Total registration income (from verified payments)
- Total manual income entries
- Total expenses
- Net balance (income - expenses)
- Budget usage progress bar with color indicators:
  - Green: < 80% of budget
  - Yellow: 80-100% of budget
  - Red: > 100% of budget (exceeded)
- List of all income entries with edit/delete options
- List of all expense entries with edit/delete options

### 2. Add Income
**Route:** `/admin/events/{event}/finances/income/create`

Form fields:
- Item Name (required)
- Amount in Rupiah (required)
- Transaction Date (required)
- Description (optional)

### 3. Add Expense
**Route:** `/admin/events/{event}/finances/expense/create`

Form fields:
- Item Name (required)
- Amount in Rupiah (required)
- Transaction Date (required)
- Description (optional)

### 4. Edit Income/Expense
**Route:** `/admin/events/{event}/finances/{incomeExpense}/edit`

Same fields as create form, pre-filled with existing data.

### 5. Delete Income/Expense
Delete button with confirmation dialog on the financial recap page.

## Access Points

### From Event Management
1. **Event Index Page** (`/admin/events`)
   - Each event row has a "Finances" button
   - Links directly to financial recap

2. **Event Registrations Page** (`/admin/events/{event}/registrations`)
   - Header has "View Financial Recap" button
   - Shows total income from registrations in statistics card

## Model Methods

### Event Model
New methods added:

```php
// Get total income from verified registrations
$event->getTotalIncome()

// Get total from manual income entries
$event->getTotalManualIncome()

// Get total expenses
$event->getTotalExpenses()

// Get combined income (registrations + manual)
$event->getTotalAllIncome()

// Get net balance (all income - expenses)
$event->getNetBalance()

// Check if budget exceeded
$event->isBudgetExceeded()

// Get budget usage percentage
$event->getBudgetUsagePercentage()
```

### Relationships

```php
// Get all income/expense entries
$event->incomeExpenses

// Get only income entries
$event->incomes

// Get only expense entries
$event->expenses

// Get event from income/expense
$incomeExpense->event
```

## Controller: IncomeExpenseController

Located at: `app/Http/Controllers/Admin/IncomeExpenseController.php`

Methods:
- `recap(Event $event)` - Show financial recap
- `createIncome(Event $event)` - Show income form
- `createExpense(Event $event)` - Show expense form
- `store(Request $request, Event $event)` - Store new entry
- `edit(Event $event, IncomeExpense $incomeExpense)` - Show edit form
- `update(Request $request, Event $event, IncomeExpense $incomeExpense)` - Update entry
- `destroy(Event $event, IncomeExpense $incomeExpense)` - Delete entry

## Views Structure

```
resources/views/admin/income-expense/
├── recap.blade.php    # Main financial recap page
├── create.blade.php   # Form to add income/expense
└── edit.blade.php     # Form to edit income/expense
```

## Routes

All routes are in the `admin` middleware group:

```php
// Financial recap
GET  /admin/events/{event}/finances

// Add income
GET  /admin/events/{event}/finances/income/create
// Add expense
GET  /admin/events/{event}/finances/expense/create

// Store (both income and expense)
POST /admin/events/{event}/finances

// Edit
GET  /admin/events/{event}/finances/{incomeExpense}/edit

// Update
PUT  /admin/events/{event}/finances/{incomeExpense}

// Delete
DELETE /admin/events/{event}/finances/{incomeExpense}
```

## Usage Examples

### Example 1: Adding Income
1. Navigate to Events page
2. Click "Finances" button for desired event
3. Click "Add Income" button (green)
4. Fill in form:
   - Item Name: "Sponsorship from PT ABC"
   - Amount: 5000000
   - Date: 2025-11-25
   - Description: "Gold sponsor package"
5. Click "Add Income"

### Example 2: Adding Expense
1. Navigate to Financial Recap page
2. Click "Add Expense" button (red)
3. Fill in form:
   - Item Name: "Venue Rental"
   - Amount: 3000000
   - Date: 2025-11-20
   - Description: "Main hall rental for 2 days"
4. Click "Add Expense"

### Example 3: Budget Monitoring
The system automatically:
- Calculates total expenses
- Compares with event budget
- Shows progress bar with color coding
- Displays warning if budget exceeded

## Security Features

- All routes protected by `auth` and `admin` middleware
- Each operation validates that the income/expense belongs to the specified event
- CSRF protection on all forms
- Soft validation on form inputs
- Confirmation dialogs on delete operations

## Tips for Usage

1. **Regular Updates**: Update financial entries regularly for accurate tracking
2. **Detailed Descriptions**: Use descriptions to provide context for each entry
3. **Budget Setting**: Always set a budget for events to enable monitoring
4. **Review Before Events**: Check financial recap before event starts
5. **Post-Event Analysis**: Review final recap after event completion

## Future Enhancements (Optional)

- Export financial recap to PDF/Excel
- Financial reports across multiple events
- Category-based expense tracking
- Receipt/proof upload for expenses
- Financial approval workflow
- Historical comparison reports

## Support

For issues or questions about the financial management system, refer to:
- Laravel documentation: https://laravel.com/docs
- Bootstrap documentation: https://getbootstrap.com/docs
