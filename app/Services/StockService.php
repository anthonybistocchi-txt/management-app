<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockMovements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function in(array $request)
    {

        return DB::transaction(function () use ($request) {
            $stock = Stock::firstOrCreate(
                [
                    'product_id'  => $request['product_id'],
                    'location_id' => $request['location_id'],
                ],
                [
                    'quantity' => 0,
                ]
            );

            $previousQuantity = $stock->quantity;

            $stock->increment('quantity', $request['quantity']); // mais clean

            StockMovements::create([
                'product_id'        => $request['product_id'],
                'quantity_moved'    => $request['quantity'],
                'location_id'       => $request['location_id'],
                'previous_quantity' => $previousQuantity,
                'new_quantity'      => $stock->quantity,
                'description'       => $request['description'] ?? null,
                'type'              => 'in',
                'provider_id'       => $request['provider_id'] ?? null,
                'created_by'        => Auth::id(),
            ]);

            return [
                'product_id'        => $request['product_id'],
                'location_id'       => $request['location_id'],
                'previous_quantity' => $previousQuantity,
                'new_quantity'      => $stock->quantity,
            ];
        });
    }

    public function out($request)
    {

        DB::transaction(function () use ($request) {
            $stock = Stock::where('product_id', $request->product_id)
                ->where('location_id', $request->location_id)
                ->firstOrFail();

            if ($stock->quantity < $request->quantity) {
                throw new \Exception('Insufficient stock for the data$requested operation.');
            }

            $previousQuantity = $stock->quantity;

            $stock->quantity -= $request->quantity;
            $stock->save();

            StockMovements::create([
                'product_id'        => $request->product_id,
                'quantity_moved'    => $request->quantity,
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

        DB::transaction(function () use ($request) {
            $fromStock = Stock::where('product_id', $request->product_id)
                ->where('location_id', $request->from_location_id)
                ->firstOrFail();

            if ($fromStock->quantity < $request->quantity) {
                throw new \Exception('Insufficient stock at the source location for the data$requested transfer.');
            }

            $previousFromQuantity = $fromStock->quantity;

            $fromStock->quantity -= $request->quantity;
            $fromStock->save();

            StockMovements::create([
                'product_id'        => $request->product_id,
                'quantity_moved'    => $request->quantity,
                'location_id'       => $request->from_location_id,
                'previous_quantity' => $previousFromQuantity,
                'new_quantity'      => $fromStock->quantity,
                'description'       => $request->description,
                'type'              => 'transfer',
                'created_by'        => Auth::id(),
            ]);

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
                'quantity_moved'    => $request->quantity,
                'location_id'       => $request->to_location_id,
                'previous_quantity' => $previousToQuantity,
            ]);
        });
    }
}
