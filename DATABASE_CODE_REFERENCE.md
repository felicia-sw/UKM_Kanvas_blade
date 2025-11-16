# Complete Database Code Reference

## 1. Migration: Add Budget to Events

**File:** `database/migrations/2025_11_16_174734_add_budget_to_events_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->decimal('budget', 15, 2)->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('budget');
        });
    }
};
```

---

## 2. Migration: Create Dues Periods Table

**File:** `database/migrations/2025_11_16_174736_create_dues_periods_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dues_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('amount', 15, 2);
            $table->date('due_date');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dues_periods');
    }
};
```

---

## 3. Migration: Create Dues Payments Table

**File:** `database/migrations/2025_11_16_174737_create_dues_payments_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dues_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('dues_period_id')->constrained('dues_periods')->onDelete('cascade');
            $table->enum('payment_status', ['pending', 'verified'])->default('pending');
            $table->string('payment_proof')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dues_payments');
    }
};
```

---

## 4. Model: DuesPeriod

**File:** `app/Models/DuesPeriod.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuesPeriod extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'due_date',
        'description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'due_date' => 'date',
    ];

    // One DuesPeriod has many payments
    public function payments()
    {
        return $this->hasMany(DuesPayment::class);
    }
}
```

---

## 5. Model: DuesPayment

**File:** `app/Models/DuesPayment.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuesPayment extends Model
{
    protected $fillable = [
        'user_id',
        'dues_period_id',
        'payment_status',
        'payment_proof',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    // A payment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A payment belongs to a dues period
    public function duesPeriod()
    {
        return $this->belongsTo(DuesPeriod::class);
    }

    // Get the admin who verified this payment
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
```

---

## 6. Model: Event (Updated)

**File:** `app/Models/Event.php` (relevant sections)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster_image',
        'start_date',
        'end_date',
        'registration_deadline',
        'price',
        'budget',  // ← NEW
        'location',
        'max_participants',
        'is_active',
        'has_multiple_days',
        'day_1_price',
        'day_2_price',
        'both_days_price',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'date',
        'price' => 'decimal:2',
        'budget' => 'decimal:2',  // ← NEW
        'is_active' => 'boolean',
        'has_multiple_days' => 'boolean',
        'day_1_price' => 'decimal:2',
        'day_2_price' => 'decimal:2',
        'both_days_price' => 'decimal:2',
    ];

    // ... rest of the model remains the same
}
```

---

## 7. Model: User (Updated)

**File:** `app/Models/User.php` (relevant sections)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ... existing code ...

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->hasMany(Notification::class)->where('is_read', false);
    }

    // ← NEW RELATIONSHIPS
    public function duesPayments()
    {
        return $this->hasMany(DuesPayment::class);
    }

    public function verifiedDuesPayments()
    {
        return $this->hasMany(DuesPayment::class, 'verified_by');
    }
}
```

---

## Usage Examples

### Creating a Dues Period

```php
// In a controller or command
$period = DuesPeriod::create([
    'name' => 'Kas November 2025',
    'amount' => 50000,
    'due_date' => '2025-11-30',
    'description' => 'Monthly membership dues'
]);
```

### Recording a Payment

```php
$payment = DuesPayment::create([
    'user_id' => Auth::id(),
    'dues_period_id' => $period->id,
    'payment_status' => 'pending',
    'payment_proof' => 'dues_proofs/user_1.jpg'
]);
```

### Verifying a Payment (Admin)

```php
$payment = DuesPayment::find($paymentId);
$payment->update([
    'payment_status' => 'verified',
    'verified_by' => Auth::id(),
    'verified_at' => now()
]);
```

### Finding Unpaid Members

```php
$unpaidMembers = DuesPayment::where('dues_period_id', $periodId)
                             ->where('payment_status', 'pending')
                             ->with('user')
                             ->get();
```

### Getting Member's Payment Status

```php
$payment = DuesPayment::where('user_id', $userId)
                      ->where('dues_period_id', $periodId)
                      ->first();

if ($payment) {
    echo "Status: " . $payment->payment_status; // pending or verified
} else {
    echo "Not found";
}
```

### Getting All Payments for a Period

```php
$period = DuesPeriod::with('payments.user')->find($periodId);

foreach ($period->payments as $payment) {
    echo $payment->user->name . " - " . $payment->payment_status;
}
```

### Setting Event Budget

```php
$event = Event::find($eventId);
$event->update(['budget' => 10000000]);
```

### Calculating Budget vs Expenses

```php
$event = Event::with('incomeExpenses')->find($eventId);

$totalExpenses = $event->incomeExpenses()
                      ->where('type', 'expense')
                      ->sum('amount');

$remaining = $event->budget - $totalExpenses;
```

---

## Database Queries

### Find All Pending Payments

```php
$pending = DuesPayment::where('payment_status', 'pending')
                      ->with('user', 'duesPeriod')
                      ->orderBy('due_date')
                      ->get();
```

### Find Overdue Payments

```php
$overdue = DuesPayment::whereHas('duesPeriod', function($query) {
               $query->where('due_date', '<', now()->toDateString());
           })
           ->where('payment_status', 'pending')
           ->with('user', 'duesPeriod')
           ->get();
```

### Get Verified Payments Count

```php
$verified = DuesPayment::where('dues_period_id', $periodId)
                       ->where('payment_status', 'verified')
                       ->count();
```

### Get Member's Payment History

```php
$history = $user->duesPayments()->with('duesPeriod')->get();

foreach ($history as $payment) {
    echo "Period: " . $payment->duesPeriod->name;
    echo " - Status: " . $payment->payment_status;
    echo " - Amount: " . $payment->duesPeriod->amount;
}
```

---

## Relationships Summary

```
User (1) ──── (N) DuesPayment (N to 1)
         └──── (N) DuesPayment as Verifier (verified_by)

DuesPeriod (1) ──── (N) DuesPayment

DuesPayment
├─ belongsTo User (member)
├─ belongsTo DuesPeriod
└─ belongsTo User (verifier)
```

---

## Database Constraints

- `ON DELETE CASCADE`: When user deleted → all their payments deleted
- `ON DELETE CASCADE`: When period deleted → all related payments deleted  
- `ON DELETE SET NULL`: When verifier deleted → verified_by becomes NULL

---

## Indexes (Auto-created by Laravel)

- Primary Key: `dues_periods.id`, `dues_payments.id`
- Foreign Keys: `dues_payments.user_id`, `dues_payments.dues_period_id`, `dues_payments.verified_by`
- Consider adding: `dues_payments.payment_status`, `dues_payments.user_id + dues_period_id` (composite)

---

