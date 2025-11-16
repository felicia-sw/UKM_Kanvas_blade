# Quick Database Reference - UKM Kanvas

## Table: dues_periods
```
id (bigint, PK, auto-increment)
name (string)
amount (decimal 15,2)
due_date (date)
description (text, nullable)
created_at (timestamp)
updated_at (timestamp)
```

**Example:**
```
| id | name                | amount   | due_date   | description
| 1  | Kas November 2025   | 50000    | 2025-11-30 | Monthly dues
| 2  | Kas Desember 2025   | 50000    | 2025-12-31 | Monthly dues
```

---

## Table: dues_payments
```
id (bigint, PK, auto-increment)
user_id (bigint, FK → users)
dues_period_id (bigint, FK → dues_periods)
payment_status (enum: pending, verified)
payment_proof (string, nullable)
verified_by (bigint, FK → users, nullable)
verified_at (timestamp, nullable)
created_at (timestamp)
updated_at (timestamp)
```

**Example:**
```
| id | user_id | dues_period_id | payment_status | payment_proof          | verified_by | verified_at
| 1  | 5       | 1              | verified       | dues_proofs/user5.jpg  | 2           | 2025-11-15 10:00:00
| 2  | 6       | 1              | pending        | dues_proofs/user6.jpg  | NULL        | NULL
| 3  | 7       | 2              | verified       | dues_proofs/user7.jpg  | 2           | 2025-12-01 09:30:00
```

---

## Table: events (Modified)
**NEW COLUMN ADDED:**
```
budget (decimal 15,2, nullable) - Added after 'price' column
```

**Example:**
```
| id | title          | price  | budget      | ...
| 1  | Workshop 2025  | 50000  | 2000000     | ...
| 2  | Kompetisi      | 100000 | 5000000     | ...
```

---

## Model Relationships

### DuesPeriod Model
```php
DuesPeriod → has Many → DuesPayment
```

### DuesPayment Model
```php
DuesPayment → belongs To → User (user_id)
DuesPayment → belongs To → DuesPeriod
DuesPayment → belongs To → User (verified_by) [admin]
```

### User Model
```php
User → has Many → DuesPayment
User → has Many → DuesPayment (as verifier, via verified_by)
```

### Event Model
```php
Event → has Many → IncomeExpense
```

---

## Query Examples

### Find unpaid dues by member
```php
$unpaidDues = DuesPayment::where('user_id', $userId)
                          ->where('payment_status', 'pending')
                          ->get();
```

### Find overdue payments
```php
use Carbon\Carbon;

$overdue = DuesPayment::whereHas('duesPeriod', function($q) {
                          $q->where('due_date', '<', Carbon::today());
                      })
                      ->where('payment_status', 'pending')
                      ->with('user', 'duesPeriod')
                      ->get();
```

### Get member's payment status for a period
```php
$payment = DuesPayment::where('user_id', $userId)
                      ->where('dues_period_id', $periodId)
                      ->first();
                      
if ($payment) {
    echo $payment->payment_status; // 'pending' or 'verified'
} else {
    echo "Not registered for this period";
}
```

### Get all payments for a dues period
```php
$period = DuesPeriod::with('payments.user')->find($periodId);

foreach ($period->payments as $payment) {
    echo $payment->user->name . ": " . $payment->payment_status;
}
```

### Calculate budget remaining for event
```php
$event = Event::with('incomeExpenses')->find($eventId);

$totalExpenses = $event->incomeExpenses()
                      ->where('type', 'expense')
                      ->sum('amount');

$remaining = $event->budget - $totalExpenses;

echo "Budget: " . $event->budget;
echo "Spent: " . $totalExpenses;
echo "Remaining: " . $remaining;
```

### Verify a payment (Admin action)
```php
$payment = DuesPayment::find($paymentId);

$payment->update([
    'payment_status' => 'verified',
    'verified_by' => auth()->id(),
    'verified_at' => now()
]);
```

---

## Database Constraints

### Cascade Delete Rules
- If a user is deleted → all their dues_payments are deleted
- If a dues_period is deleted → all related dues_payments are deleted
- If verified_by admin is deleted → verified_by is set to NULL (but record remains)

### Default Values
- `payment_status` defaults to 'pending'
- `verified_at` and `verified_by` default to NULL until payment is verified

---

## Migration Files Location
```
database/migrations/
├── 2025_11_16_174734_add_budget_to_events_table.php
├── 2025_11_16_174736_create_dues_periods_table.php
└── 2025_11_16_174737_create_dues_payments_table.php
```

## Model Files Location
```
app/Models/
├── DuesPeriod.php
├── DuesPayment.php
├── Event.php (modified)
└── User.php (modified)
```

---

## Data Type Specifications

| Type | Max Value | Usage |
|------|-----------|-------|
| decimal(15,2) | 999,999,999.99 | Money amounts |
| date | 9999-12-31 | Due dates |
| timestamp | - | created_at, updated_at, verified_at |
| string | 255 chars | Names, file paths |
| text | 65,535 chars | Descriptions |
| enum | Set of values | payment_status: pending, verified |
| bigint FK | 18+ digits | Foreign keys |

---

## Status Codes

### payment_status in dues_payments
- `pending` - Awaiting admin verification
- `verified` - Payment confirmed by admin

