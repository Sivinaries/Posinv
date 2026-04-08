<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ExpenseController extends Controller
{
    private function clearCache()
    {
        Cache::forget('expenses');
    }

    public function index()
    {
        $expenses = Cache::remember(
            'expenses',
            now()->addMinutes(60),
            fn () => Expense::all()
        );

        return view('expense', compact('expenses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'nominal' => 'required',
        ]);

        Expense::create($data);

        $this->clearCache();

        return redirect(route('expense'))->with('success', 'Expense Sukses Dibuat !');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'nominal' => 'required',
        ]);

        $expense = Expense::findOrFail($id);

        $expense->update($data);

        $this->clearCache();

        return redirect(route('expense'))->with('success', 'Expense Sukses Diupdate !');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        $this->clearCache();

        return redirect(route('expense'))->with('success', 'Expense Berhasil Dihapus !');
    }
}
