<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('is_booked', 0)->where('is_active', 1);

        // FILTER HARGA
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // FILTER TIPE
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // FILTER LOKASI
        if ($request->location) {
            $query->where('location', $request->location);
        }

        // SORTING
        if ($request->sort == 'cheapest') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'expensive') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        if ($request->filled(['start_date', 'end_date'])) {
            $start = $request->start_date;
            $end = $request->end_date;

            $query->whereDoesntHave('bookings', function ($q) use ($start, $end) {
                $q->where('status', 'confirmed')
                    ->where(function ($q) use ($start, $end) {
                        $q->whereBetween('start_date', [$start, $end])
                            ->orWhereBetween('end_date', [$start, $end])
                            ->orWhere(function ($sub) use ($start, $end) {
                                $sub->where('start_date', '<=', $start)
                                    ->where('end_date', '>=', $end);
                            });
                    });
            });
        }

        $products = $query->paginate(8);

        $locations = Product::select('location')
            ->distinct()
            ->pluck('location');

        $types = Product::select('type')
            ->distinct()
            ->whereNotNull('type')
            ->pluck('type');

        return view('product.index', compact('products', 'locations', 'types'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.detail', compact('product'));
    }
}
