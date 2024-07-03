<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Distributor;
use App\Models\Item;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('reports.index', compact('categories'));
    }

    public function semua()
    {
        $category_id = request('category_id');

        if ($category_id) {
            $items = Item::where('category_id', $category_id)->get();
        } else {
            $items = Item::all();
        }
        $distributors = Distributor::all();

        if (request('dari') && request('sampai')) {
            $dari = request('dari');
            $sampai = request('sampai');
            $tipe = request('tipe');
            $distributor_id = request('distributor_id');
            $category_id = request('category_id');

            if (!$distributor_id) {
                $distributor_id = 'semua';
            }

            if (!$category_id) {
                $category_id = 'semua';
            }

            // "SELECT * FROM items WHERE created_at BETWEEN '$dari' AND '$sampai' AND tipe = '$tipe' AND distributor_id = '$distributor_id'";

            if ($category_id != 'semua') {
                if ($tipe == 'semua' && $distributor_id == 'semua') {
                    $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                        ->whereRaw("DATE(created_at) <= '$sampai' ")
                        ->where('category_id', $category_id)
                        ->get();
                } else if ($tipe == 'semua' && $distributor_id != 'semua') {
                    $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                        ->whereRaw("DATE(created_at) <= '$sampai' ")
                        ->where('distributor_id', $distributor_id)
                        ->where('category_id', $category_id)
                        ->get();
                } else {
                    $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                        ->whereRaw("DATE(created_at) <= '$sampai' ")
                        ->where('tipe', $tipe)
                        ->where('category_id', $category_id)
                        ->get();
                }
            } else {

                if ($tipe == 'semua' && $distributor_id == 'semua') {
                    $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                        ->whereRaw("DATE(created_at) <= '$sampai' ")
                        ->get();
                } else if ($tipe == 'semua' && $distributor_id != 'semua') {
                    $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                        ->whereRaw("DATE(created_at) <= '$sampai' ")
                        ->where('distributor_id', $distributor_id)
                        ->get();
                } else {
                    $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                        ->whereRaw("DATE(created_at) <= '$sampai' ")
                        ->where('tipe', $tipe)
                        ->get();
                }
            }
        }

        $category = Category::find($category_id);

        return view('reports.semua', compact('items', 'distributors', 'category'));
    }

    public function cetak_semua()
    {
        $dari = request('dari');
        $sampai = request('sampai');
        $tipe = request('tipe');
        $distributor_id = request('distributor_id');
        $category_id = request('category_id');

        if (!$distributor_id) {
            $distributor_id = 'semua';
        }

        if (!$category_id) {
            $category_id = 'semua';
        }

        // "SELECT * FROM items WHERE created_at BETWEEN '$dari' AND '$sampai' AND tipe = '$tipe' AND distributor_id = '$distributor_id'";

        if ($category_id != 'semua') {
            if ($tipe == 'semua' && $distributor_id == 'semua') {
                $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                    ->whereRaw("DATE(created_at) <= '$sampai' ")
                    ->where('category_id', $category_id)
                    ->get();
            } else if ($tipe == 'semua' && $distributor_id != 'semua') {
                $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                    ->whereRaw("DATE(created_at) <= '$sampai' ")
                    ->where('distributor_id', $distributor_id)
                    ->where('category_id', $category_id)
                    ->get();
            } else {
                $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                    ->whereRaw("DATE(created_at) <= '$sampai' ")
                    ->where('tipe', $tipe)
                    ->where('category_id', $category_id)
                    ->get();
            }
        } else {
            if ($tipe == 'semua' && $distributor_id == 'semua') {
                $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                    ->whereRaw("DATE(created_at) <= '$sampai' ")
                    ->get();
            } else if ($tipe == 'semua' && $distributor_id != 'semua') {
                $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                    ->whereRaw("DATE(created_at) <= '$sampai' ")
                    ->where('distributor_id', $distributor_id)
                    ->get();
            } else {
                $items = Item::whereRaw("DATE(created_at) >= '$dari' ")
                    ->whereRaw("DATE(created_at) <= '$sampai' ")
                    ->where('tipe', $tipe)
                    ->get();
            }
        }

        if ($category_id) {
            $category = Category::find($category_id);
        } else {
            $category = null;
        }

        return view('reports.cetak_semua', compact('items', 'category'));
    }
}
