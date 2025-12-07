<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventBudgetItem;
use Illuminate\Http\Request;

class IncomeExpenseController extends Controller
{
    // Show financial recap for an event
    public function recap(Event $event)
    {
        $incomes = $event->incomes()->orderBy('created_at', 'desc')->get();
        $expenses = $event->expenses()->orderBy('created_at', 'desc')->get();

        $totalManualIncome = $event->getTotalManualIncome();
        $totalExpenses = $event->getTotalExpenses();
        $netBalance = $event->getNetBalance();

        return view('admin.income-expense.recap', compact(
            'event',
            'incomes',
            'expenses',
            'totalManualIncome',
            'totalExpenses',
            'netBalance'
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
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        EventBudgetItem::create([
            'event_id' => $event->id,
            'type' => $validated['type'],
            'item_name' => $validated['item_name'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
        ]);

        $message = $validated['type'] === 'income'
            ? 'Income entry added successfully!'
            : 'Expense entry added successfully!';

        return redirect()
            ->route('admin.events.finances.recap', $event->id)
            ->with('success', $message);
    }

    // Show edit form
    public function edit(Event $event, EventBudgetItem $incomeExpense)
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
    public function update(Request $request, Event $event, EventBudgetItem $incomeExpense)
    {
        // Ensure the income/expense belongs to this event
        if ($incomeExpense->event_id !== $event->id) {
            abort(404);
        }

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
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
    public function destroy(Event $event, EventBudgetItem $incomeExpense)
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
