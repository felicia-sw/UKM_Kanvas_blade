# Database Schema Documentation - UKM Kanvas New Features

## Overview
This document describes the database schema for three new features added to the UKM Kanvas system:
1. Budget Tracking for Events
2. Membership Dues System
3. Calendar Integration (no database changes required)

---

## Feature 1: Budget Tracking

### Migration: `2025_11_16_174734_add_budget_to_events_table.php`

**Table Modified:** `events`

**New Column:**
- `budget` (decimal, 15,2, nullable) - Budget allocation for the event

**Model Changes:** `app/Models/Event.php`
- Added `budget` to `$fillable` array
- Added `budget` to `$casts` with `decimal:2` precision

**Usage:**
```php
// Example in code
$event->budget = 5000000; // Rp 5,000,000
$event->save();

// Retrieve
$budget = $event->budget; // decimal(15,2)
```

---

## Feature 2: Membership Dues System

### Migration 1: `2025_11_16_174736_create_dues_periods_table.php`

**Table Created:** `dues_periods`

**Columns:**
- `id` (PK) - Primary key
- `name` (string) - e.g., "Kas November 2025"
- `amount` (decimal, 15,2) - Amount members must pay
- `due_date` (date) - Payment deadline
- `description` (text, nullable) - Optional details
- `created_at` (timestamp)
- `updated_at` (timestamp)

**Model:** `app/Models/DuesPeriod.php`

**Relationships:**
```php
public function payments()
{
    return $this->hasMany(DuesPayment::class);
}
```

**Fillable Fields:**
```php
protected $fillable = [
    'name',
    'amount',
    'due_date',
    'description',
];
```

**Casts:**
```php
protected $casts = [
    'amount' => 'decimal:2',
    'due_date' => 'date',
];
```

---

### Migration 2: `2025_11_16_174737_create_dues_payments_table.php`

**Table Created:** `dues_payments`

**Columns:**
- `id` (PK) - Primary key
- `user_id` (FK) - Foreign key to `users` table
- `dues_period_id` (FK) - Foreign key to `dues_periods` table
- `payment_status` (enum) - Values: 'pending' or 'verified' (default: 'pending')
- `payment_proof` (string, nullable) - Path to uploaded payment proof file
- `verified_by` (FK, nullable) - Foreign key to `users` table (admin who verified)
- `verified_at` (timestamp, nullable) - When payment was verified
- `created_at` (timestamp)
- `updated_at` (timestamp)

**Model:** `app/Models/DuesPayment.php`

**Relationships:**
```php
public function user()
{
    return $this->belongsTo(User::class);
}

public function duesPeriod()
{
    return $this->belongsTo(DuesPeriod::class);
}

public function verifiedBy()
{
    return $this->belongsTo(User::class, 'verified_by');
}
```

**Fillable Fields:**
```php
protected $fillable = [
    'user_id',
    'dues_period_id',
    'payment_status',
    'payment_proof',
    'verified_by',
    'verified_at',
];
```

**Casts:**
```php
protected $casts = [
    'verified_at' => 'datetime',
];
```

---

## Updated Models

### User Model (`app/Models/User.php`)

**New Relationships Added:**

```php
public function duesPayments()
{
    return $this->hasMany(DuesPayment::class);
}

public function verifiedDuesPayments()
{
    return $this->hasMany(DuesPayment::class, 'verified_by');
}
```

**Usage:**
```php
// Get all dues payments for a user
$payments = $user->duesPayments;

// Get all payments this admin verified
$verifiedPayments = $admin->verifiedDuesPayments;
```

---

### Event Model (`app/Models/Event.php`)

**Updated Fillable:**
```php
protected $fillable = [
    'title',
    'description',
    'poster_image',
    'start_date',
    'end_date',
    'registration_deadline',
    'price',
    'budget',  // <-- NEW
    'location',
    'max_participants',
    'is_active',
    'has_multiple_days',
    'day_1_price',
    'day_2_price',
    'both_days_price',
];
```

**Updated Casts:**
```php
protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
    'registration_deadline' => 'date',
    'price' => 'decimal:2',
    'budget' => 'decimal:2',  // <-- NEW
    'is_active' => 'boolean',
    'has_multiple_days' => 'boolean',
    'day_1_price' => 'decimal:2',
    'day_2_price' => 'decimal:2',
    'both_days_price' => 'decimal:2',
];
```

---

## Entity Relationship Diagram (ERD) Summary

```
USERS
├── has Many → DUES_PAYMENTS (via user_id)
├── has Many → DUES_PAYMENTS (via verified_by as admin)
└── has Many → NOTIFICATIONS

DUES_PERIODS
└── has Many → DUES_PAYMENTS

DUES_PAYMENTS
├── belongs To → USERS (user_id)
├── belongs To → DUES_PERIODS
└── belongs To → USERS (verified_by)

EVENTS
├── has Many → REGISTRATIONS
├── has Many → DOCUMENTATIONS
├── has Many → INCOME_EXPENSES
└── NEW: budget column added

INCOME_EXPENSES
└── belongs To → EVENTS
```

---

## Usage Examples

### Creating a Dues Period
```php
$period = DuesPeriod::create([
    'name' => 'Kas November 2025',
    'amount' => 50000,
    'due_date' => '2025-11-30',
    'description' => 'Monthly membership dues for November'
]);
```

### Recording a Dues Payment
```php
$payment = DuesPayment::create([
    'user_id' => auth()->id(),
    'dues_period_id' => $period->id,
    'payment_status' => 'pending',
    'payment_proof' => 'dues_proofs/user_1_period_1.jpg'
]);
```

### Verifying a Dues Payment
```php
$payment->update([
    'payment_status' => 'verified',
    'verified_by' => auth()->id(), // admin id
    'verified_at' => now()
]);
```

### Setting Budget for an Event
```php
$event = Event::find(1);
$event->update([
    'budget' => 10000000 // Rp 10,000,000
]);
```

### Querying Unpaid Members
```php
$unpaidUsers = DuesPayment::where('dues_period_id', $periodId)
                           ->where('payment_status', 'pending')
                           ->with('user')
                           ->get();
```

### Getting Budget vs Expenses
```php
$event = Event::with('incomeExpenses')->find($eventId);
$budget = $event->budget;
$expenses = $event->incomeExpenses()
                  ->where('type', 'expense')
                  ->sum('amount');
$remaining = $budget - $expenses;
```

---

## Database Statistics

### Total New Tables: 2
- `dues_periods`
- `dues_payments`

### Modified Tables: 1
- `events` (added `budget` column)

### Total New Columns: 7
- In `dues_periods`: 5 columns (name, amount, due_date, description, timestamps)
- In `dues_payments`: 6 columns (user_id, dues_period_id, payment_status, payment_proof, verified_by, verified_at, timestamps)
- In `events`: 1 column (budget)

---

## Migration Status

All migrations have been successfully run:
- ✅ `2025_11_16_174734_add_budget_to_events_table` - COMPLETED
- ✅ `2025_11_16_174736_create_dues_periods_table` - COMPLETED
- ✅ `2025_11_16_174737_create_dues_payments_table` - COMPLETED

---

## Next Steps

1. **Create Controllers** for managing dues periods and payments
2. **Create Views** for admin interfaces and user payment pages
3. **Create Routes** for accessing the new features
4. **Create Console Command** for sending dues reminder notifications
5. **Integrate with Notification System** for reminding users of upcoming due dates

---

## Data Types Reference

- `decimal(15,2)` - Up to 999,999,999.99 (suitable for Indonesian currency)
- `enum` - Restricted set of values
- `FK` - Foreign Key with cascading delete by default

