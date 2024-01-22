<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\GroupMenuPermissions;
use App\Menu;


class ExpenseController extends Controller
{

    public function index($menuid)
    {
        $allExpenses = Expense::all();
        return View('admin.Expenses.index', compact('allExpenses', 'menuid'));
    }

    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Expenses.add', compact('allmenus', 'menuid'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $newExpense = new Expense();
        $newExpense->name = $data['name'];
        $newExpense->save();
        return redirect()->route('expense.index', $data['menuid']);
    }
    public function update(Request $request, Expense $Expense)
    {
        $data = $request->all();

        $Expense->name = $data['name'];


        $Expense->save();


        return redirect()->route('expense.index', $data['menuid']);
    }
    public function edit(Expense $Expense, $menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Expenses.edit', compact('allmenus', 'Expense', 'menuid'));

    }

    public function destory(Expense $Expense, $menuid)
    {
        GroupMenuPermissions::where('menu_id', '=', $Expense->id)->delete();
        $Expense->delete();

        return redirect()->route('expense.index', $menuid);

    }
}
