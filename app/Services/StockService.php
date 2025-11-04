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

    public function out($request)
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'quantity'     => 'required|integer|min:1',
            'location_id'  => 'required|exists:product_locations,id',
            'description'  => 'nullable|string|max:500',
            'type'         => 'required|in:out',
        ]);

        DB::transaction(function () use ($request) {
            $stock = Stock::where('product_id', $request->product_id)
                ->where('location_id', $request->location_id)
                ->firstOrFail();

            if ($stock->quantity < $request->quantity) {
                throw new \Exception('Insufficient stock for the requested operation.');
            }

            $previousQuantity = $stock->quantity;

            $stock->quantity -= $request->quantity;
            $stock->save();

            StockMovements::create([
                'product_id'        => $request->product_id,
                'quantity'          => $request->quantity,
                'location_id'       => $request->location_id,
                'previous_quantity' => $previousQuantity,
                'new_quantity'      => $stock->quantity,
                'description'       => $request->description,
                'type'              => 'out',
                'created_by'        => Auth::id(),
            ]);
        });
    }

    public function transfer($request)
    {
        $request->validate([
            'product_id'        => 'required|exists:products,id',
            'quantity'          => 'required|integer|min:1',
            'from_location_id'  => 'required|exists:product_locations,id',
            'to_location_id'    => 'required|exists:product_locations,id|different:from_location_id',
            'description'       => 'nullable|string|max:500',
            'type'              => 'required|in:transfer',
        ]);

        DB::transaction(function () use ($request) {
            $fromStock = Stock::where('product_id', $request->product_id)
                ->where('location_id', $request->from_location_id)
                ->firstOrFail();

            if ($fromStock->quantity < $request->quantity) {
                throw new \Exception('Insufficient stock at the source location for the requested transfer.');
            }

            $previousFromQuantity = $fromStock->quantity;

            $fromStock->quantity -= $request->quantity;
            $fromStock->save();

            StockMovements::create([
                'product_id'        => $request->product_id,
                'quantity'          => $request->quantity,
                'location_id'       => $request->from_location_id,
                'previous_quantity' => $previousFromQuantity,
                'new_quantity'      => $fromStock->quantity,
                'description'       => $request->description,
                'type'              => 'transfer',
                'created_by'        => Auth::id(),
            ]);

            // Increase stock at the destination location
            $toStock = Stock::firstOrCreate(
                [
                    'product_id'  => $request->product_id,
                    'location_id' => $request->to_location_id,
                ],
                [
                    'quantity' => 0,
                ]
            );

            $previousToQuantity = $toStock->quantity;

            $toStock->quantity += $request->quantity;
            $toStock->save();

            StockMovements::create([
                'product_id'        => $request->product_id,
                'quantity'          => $request->quantity,
                'location_id'       => $request->to_location_id,
                'previous_quantity' => $previousToQuantity,
            ]);
        });
    }
}
