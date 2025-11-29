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
        'budget',
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
        'budget' => 'decimal:2',
        'is_active' => 'boolean',
        'has_multiple_days' => 'boolean',
        'day_1_price' => 'decimal:2',
        'day_2_price' => 'decimal:2',
        'both_days_price' => 'decimal:2',
    ];

    public function documentations()
    {
        return $this->hasMany(Documentation::class, 'event_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function incomeExpenses()
    {
        return $this->hasMany(IncomeExpense::class);
    }

    public function incomes()
    {
        return $this->hasMany(IncomeExpense::class)->where('type', 'income');
    }

    public function expenses()
    {
        return $this->hasMany(IncomeExpense::class)->where('type', 'expense');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now())->orderBy('start_date');
    }

    public function isPastEvent()
    {
        return $this->end_date < now();
    }

    public function canRegister()
    {
        return !$this->isPastEvent() && 
               $this->registration_deadline >= now() &&
               $this->is_active;
    }

    public function getTotalIncome()
    {
        return $this->registrations()
            ->where('payment_status', 'verified')
            ->sum('amount_paid');
    }

    public function getVerifiedParticipantsCount()
    {
        return $this->registrations()
            ->where('payment_status', 'verified')
            ->count();
    }

    // Get total income from manual entries (pemasukan)
    public function getTotalManualIncome()
    {
        return $this->incomes()->sum('amount');
    }

    // Get total expenses (pengeluaran)
    public function getTotalExpenses()
    {
        return $this->expenses()->sum('amount');
    }

    // Get total income including registration fees
    public function getTotalAllIncome()
    {
        return $this->getTotalIncome() + $this->getTotalManualIncome();
    }

    // Get net balance (income - expenses)
    public function getNetBalance()
    {
        return $this->getTotalAllIncome() - $this->getTotalExpenses();
    }

    // Check if budget is exceeded
    public function isBudgetExceeded()
    {
        if (!$this->budget) {
            return false;
        }
        return $this->getTotalExpenses() > $this->budget;
    }

    // Get budget status percentage
    public function getBudgetUsagePercentage()
    {
        if (!$this->budget || $this->budget == 0) {
            return 0;
        }
        return ($this->getTotalExpenses() / $this->budget) * 100;
    }
}