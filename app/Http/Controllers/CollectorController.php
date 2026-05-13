<?php

namespace App\Http\Controllers;

use App\Models\Kolektor;
use Illuminate\Http\Request;

class CollectorController extends Controller
{
    public function index()
    {
        $collectors = Kolektor::latest()->get();
        return view('collectors.index', compact('collectors'));
    }

    public function create()
    {
        return view('collectors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'wilayah' => 'required',
            'no_hp' => 'required',
        ]);

        // Create User account
        \App\Models\User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'kolektor',
        ]);

        // Create Collector record
        Kolektor::create([
            'nama' => $request->nama,
            'wilayah' => $request->wilayah,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('collectors.index')->with('success', 'Kolektor dan Akun Login berhasil dibuat');
    }

    public function edit(Kolektor $collector)
    {
        return view('collectors.edit', compact('collector'));
    }

    public function update(Request $request, Kolektor $collector)
    {
        $request->validate([
            'nama' => 'required',
            'wilayah' => 'required',
            'no_hp' => 'required',
        ]);

        $collector->update($request->all());

        return redirect()->route('collectors.index')->with('success', 'Kolektor berhasil diperbarui');
    }

    public function destroy(Kolektor $collector)
    {
        $collector->delete();
        return redirect()->route('collectors.index')->with('success', 'Kolektor berhasil dihapus');
    }
}

