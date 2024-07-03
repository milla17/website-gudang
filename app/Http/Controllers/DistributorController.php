<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distributors = Distributor::all(); // "SELECT * FROM distributors"

        return view('distributors.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('distributors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
        ]);

        Distributor::create($request->all()); // "INSERT INTO distributors VALUES(......."

        session()->flash('message', 'Data distributor berhasil ditambah!');
        return redirect()->route('distributors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distributor $distributor)
    {
        return view('distributors.edit', compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distributor $distributor)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
        ]);

        $distributor->update($request->all()); // "UPDATE distributors SET ...."

        session()->flash('message', 'Data distributor berhasil diedit!');
        return redirect()->route('distributors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distributor $distributor)
    {
        $distributor->delete();

        session()->flash('message', 'Data distributor berhasil dihapus!');
        return redirect()->route('distributors.index');
    }
}
