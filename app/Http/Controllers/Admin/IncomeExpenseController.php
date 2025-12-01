<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\IncomeExpense;
use Illuminate\Http\Request;

class IncomeExpenseController extends Controller
{
    // Show financial recap for an event
    public function recap(Event $event)
    {
        $incomes = $event->incomes()->orderBy('transaction_date', 'desc')->get();
        $expenses = $event->expenses()->orderBy('transaction_date', 'desc')->get();
        
        $totalRegistrationIncome = $event->getTotalIncome();
        $totalManualIncome = $event->getTotalManualIncome();
        $totalExpenses = $event->getTotalExpenses();
        $netBalance = $event->getNetBalance();
        $budgetUsage = $event->getBudgetUsagePercentage();
        
        return view('admin.income-expense.recap', compact(
            'event', 
            'incomes', 
            'expenses',
            'totalRegistrationIncome',
            'totalManualIncome',
            'totalExpenses',
            'netBalance',
            'budgetUsage'
        ));
    }

    // Show form to add income
    public function createIncome(Event $event)
    {
        return view('admin.income-expense.create', [
            'event' => $event,
            'type' => 'income'
        ]);
    }

    // Show form to add expense
    public function createExpense(Event $event)
    {
        return view('admin.income-expense.create', [
            'event' => $event,
            'type' => 'expense'
        ]);
    }

    // Store income or expense
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date'
        ]);

        $validated['event_id'] = $event->id;

        IncomeExpense::create($validated);

        $message = $validated['type'] === 'income' 
            ? 'Income entry added successfully!' 
            : 'Expense entry added successfully!';

        return redirect()
            ->route('admin.events.finances.recap', $event->id)
            ->with('success', $message);
    }

    // Show edit form
    public function edit(Event $event, IncomeExpense $incomeExpense)
    {
        // Ensure the income/expense belongs to this event
        if ($incomeExpense->event_id !== $event->id) {
            abort(404);
        }

        return view('admin.income-expense.edit', [
            'event' => $event,
            'incomeExpense' => $incomeExpense
        ]);
    }

    // Update income or expense
    public function update(Request $request, Event $event, IncomeExpense $incomeExpense)
    {
        // Ensure the income/expense belongs to this event
        if ($incomeExpense->event_id !== $event->id) {
            abort(404);
        }

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date'
        ]);

        $incomeExpense->update($validated);

        $message = $incomeExpense->type === 'income' 
            ? 'Income entry updated successfully!' 
            : 'Expense entry updated successfully!';

        return redirect()
            ->route('admin.events.finances.recap', $event->id)
            ->with('success', $message);
    }

    // Delete income or expense
    public function destroy(Event $event, IncomeExpense $incomeExpense)
    {
        // Ensure the income/expense belongs to this event
        if ($incomeExpense->event_id !== $event->id) {
            abort(404);
        }

        $type = $incomeExpense->type;
        $incomeExpense->delete();

        $message = $type === 'income' 
            ? 'Income entry deleted successfully!' 
            : 'Expense entry deleted successfully!';

        return redirect()
            ->route('admin.events.finances.recap', $event->id)
            ->with('success', $message);
    }
}
