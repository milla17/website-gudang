<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Distributor;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all(); // "SELECT * FROM items"

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $distributors = Distributor::all();

        return view('items.create', compact('categories', 'distributors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
        ]);

        $data = $request->all();
        $data['ditambahkan_oleh'] = Auth::user()->id;

        Item::create($data); // "INSERT INTO items VALUES(......."

        session()->flash('message', 'Data Barang berhasil ditambah!');
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        $distributors = Distributor::all();

        return view('items.edit', compact('item', 'categories', 'distributors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'category_id' => 'required',
        ]);

        $item->update($request->all()); // "UPDATE items SET ...."

        session()->flash('message', 'Data Barang berhasil diedit!');
        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        session()->flash('message', 'Data Barang berhasil dihapus!');
        return redirect()->route('items.index');
    }
}
