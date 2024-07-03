<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function getTotalProduksi($kategori_id)
    {
        return DB::table('items')
            ->where('category_id', $kategori_id)
            ->where('tipe', 'HASIL PRODUKSI')
            ->sum('kuantitas');
    }

    function getTotalBarangKeluar($kategori_id)
    {
        return DB::table('items')
            ->where('category_id', $kategori_id)
            ->where('tipe', 'BARANG KELUAR')
            ->sum('kuantitas');
    }

    function tampilkanGrafikDasbor()
    {
        $categories = Category::all()->toArray();

        $returnArray = [
            'kategori' => array_map(function ($category) {
                $id_kategori = $category['id'];
                $total_produksi = $this->getTotalProduksi($id_kategori);
                $total_barang_keluar = $this->getTotalBarangKeluar($id_kategori);
                $stock = $total_produksi - $total_barang_keluar;

                return [
                    'nama' => $category['nama'],
                    'total_produksi' => $total_produksi,
                    'total_barang_keluar' => $total_barang_keluar,
                    'stok' => $stock
                ];
            }, $categories),
        ];

        return json_encode($returnArray, true);
    }

    public function index()
    {
        $grafik = $this->tampilkanGrafikDasbor();

        $categories = Category::all();
        return view('dashboard', compact('categories', 'grafik'));
    }
}
