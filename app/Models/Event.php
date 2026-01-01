<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'poster_image',
        'start_date',
        'end_date',
        'registration_deadline',
        'price',
        'location',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // ==========================
    // RELATIONSHIPS
    // ==========================

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function documentations()
    {
        return $this->hasMany(Documentation::class);
    }

    // NEW: Relationship to Rundown
    public function rundowns()
    {
        return $this->hasMany(Rundown::class);
    }

    // UPDATED: Relationship to new Budget Items
    public function budgetItems()
    {
        return $this->hasMany(EventBudgetItem::class);
    }

    // Helper: Get only incomes
    public function incomes()
    {
        return $this->hasMany(EventBudgetItem::class)->where('type', 'income');
    }

    // Helper: Get only expenses
    public function expenses()
    {
        return $this->hasMany(EventBudgetItem::class)->where('type', 'expense');
    }

    // ==========================
    // QUERY SCOPES
    // ==========================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    // ==========================
    // LOGIC & CALCULATIONS
    // ==========================

    public function isPastEvent()
    {
        $dateToCheck = $this->end_date ?? $this->start_date;
        return $dateToCheck < now();
    }

    public function canRegister()
    {
        return !$this->isPastEvent() &&
            ($this->registration_deadline ? $this->registration_deadline >= now() : true) &&
            $this->is_active;
    }

    // Total from Registrations
    public function getTotalIncome()
    {
        return $this->registrations()
            ->where('payment_status', 'verified')
            ->sum('amount_paid');
    }

    // Get count of verified participants
    public function getVerifiedParticipantsCount()
    {
        return $this->registrations()
            ->where('payment_status', 'verified')
            ->count();
    }

    // Total from Budget Income items
    public function getTotalManualIncome()
    {
        return $this->incomes()->get()->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    // Total Expenses
    public function getTotalExpenses()
    {
        return $this->expenses()->get()->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    // Grand Total (Registrations + Manual Income)
    // Get total income including registration fees (now part of manual income)
    public function getTotalAllIncome()
    {
        return $this->getTotalManualIncome();
    }

    // Net Profit/Loss
    public function getNetBalance()
    {
        return $this->getTotalAllIncome() - $this->getTotalExpenses();
    }
}
