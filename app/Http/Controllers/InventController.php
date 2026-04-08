<?php

namespace App\Http\Controllers;

use App\Models\Invent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class InventController extends Controller
{
    public function index()
    {
        $userStore = Auth::user()->store;

        $cacheKey = "invents_{$userStore->id}";

        $invents = Cache::remember($cacheKey, 180, function () use ($userStore) {
            return $userStore->invents()->get();
        });

        return view('invent', compact('invents'));
    }

    public function store(Request $request)
    {
        $userStore = Auth::user()->store;

        $data = $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'unit' => 'required',
        ]);

        $data['store_id'] = $userStore->id;

        Invent::create([
            'name' => $data['name'],
            'stock' => $data['stock'],
            'unit' => $data['unit'],
            'store_id' => $userStore->id,
        ]);

        $this->clearCache($userStore->id);

        return redirect(route('invent'))->with('success', 'Invent Sukses Dibuat !');
    }

    public function update(Request $request, $id)
    {
        $userStore = Auth::user()->store;

        $data = $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'unit' => 'required',
        ]);

        $invent = Invent::where('id', $id)
            ->where('store_id', $userStore->id)
            ->firstOrFail();

        $invent->update([
            'name' => $data['name'],
            'stock' => $data['stock'],
            'unit' => $data['unit'],
        ]);

        $this->clearCache($userStore->id);

        return redirect(route('invent'))->with('success', 'Invent Sukses Diupdate !');
    }

    public function destroy($id)
    {
        $userStore = Auth::user()->store;

        $invent = Invent::where('id', $id)
            ->where('store_id', $userStore->id)
            ->first();

        if (! $invent) {
            return redirect(route('invent'))->withErrors(['msg' => 'Invent tidak ditemukan.']);
        }

        $invent->delete();

        $this->clearCache($userStore->id);

        return redirect(route('invent'))->with('success', 'Invent Berhasil Dihapus !');
    }

    private function clearCache($storeId)
    {
        Cache::forget("invents_{$storeId}");
    }
}
