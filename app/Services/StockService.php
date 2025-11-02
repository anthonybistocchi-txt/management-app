<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockMovements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function in($request)
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'quantity'     => 'required|integer|min:1',
            'location_id'  => 'required|exists:product_locations,id',
            'description'  => 'nullable|string|max:500',
            'provider_id'  => 'nullable|exists:providers,id',
            'type'         => 'required|in:in',
        ]);

        DB::transaction(function () use ($request) {
            $stock = Stock::firstOrCreate(
                [
                    'product_id'  => $request->product_id,
                    'location_id' => $request->location_id,
                ],
                [
                    'quantity' => 0,
                ]
            );

            $previousQuantity = $stock->quantity;

            $stock->quantity += $request->quantity;
            $stock->save();

            StockMovements::create([
                'product_id'        => $request->product_id,
                'quantity'          => $request->quantity,
                'location_id'       => $request->location_id,
                'previous_quantity' => $previousQuantity,
                'new_quantity'      => $stock->quantity,
                'description'       => $request->description,
                'type'              => 'in',
                'provider_id'       => $request->provider_id,
                'created_by'        => Auth::id(),
            ]);
        });
    }
}
