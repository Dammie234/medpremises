<?php

namespace App\Http\Controllers;
use DB;
use Str;
use App\Stock;
use App\User;
use App\Item;
use App\StockInflow;
use App\StockOutflow;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required',
            'manufacturer' => 'required|string',
            'shelf_name' => 'required',
            'delivery' => 'required'
        ]);
        $user = User::where('id', $request->user_id)->first();
        $name = ucwords($request->name);
        $data = [
            'unique_id' => Str::random(10),
            'facility_id' => $user->facility_id,
            'delivery_id' => $request->delivery,
            'category' => $request->category,
            'nafdac_number' => $request->nafdac_number,
            'name' => $name,
            'manufacturer' => $request->manufacturer,
            'shelf_name' => $request->shelf_name,
            'added_by' => $user->name
        ];
        Item::create($data);
        $item = Item::where(['name' => $name, 'facility_id' => $user->facility_id])->first();
        Stock::create([
            'item_id' => $item->id,
            'stock_type' => 'Item',
            'added_by' => $user->name,
            'facility_id' => $user->facility_id
        ]);
    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        $items = DB::table('items')
                    ->leftJoin('deliveries', 'deliveries.id', '=', 'items.delivery_id')
                    ->where('items.facility_id', $user->facility_id)
                    ->orderBy('items.shelf_name', 'asc')
                    ->select('items.*', 'deliveries.delivery_name')
                    ->get();
        return response()->json($items);
    }
    public function show($id)
    {
        return response()->json(Item::where('unique_id', $id)->first());
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required',
            'manufacturer' => 'required|string',
            'shelf_name' => 'required',
            'delivery' => 'required'
        ]);

        $data = [
            'delivery_id' => $request->delivery,
            'category' => $request->category,
            'nafdac_number' => $request->nafdac_number,
            'name' => ucwords($request->name),
            'manufacturer' => $request->manufacturer,
            'shelf_name' => $request->shelf_name
        ];
        Item::where('unique_id', $id)->update($data);
    }
    public function destroy($id)
    {
        $item = Item::where('unique_id', $id)->first();
        $stock = Stock::where(['item_id' => $item->id, 'facility_id' => $item->facility_id])->first();
        if ($stock->total_quantity == 0) {
            Item::where('unique_id', $id)->delete();
            Stock::where('id', $stock->id)->delete();
            $inflow = StockInflow::where(['item_id' => $item->id, 'facility_id' => $item->facility_id])->first();
            if (isset($inflow)) {
                StockInflow::where(['item_id' => $item->id, 'facility_id' => $item->facility_id])->delete();
            }
            $outflow = StockOutflow::where(['item_id' => $item->id, 'facility_id' => $item->facility_id])->first();
            if (isset($outflow)) {
                StockOutflow::where(['item_id' => $item->id, 'facility_id' => $item->facility_id])->delete();
            }
        } else {
            return response()->json(['error' => 'You can not delete this item because the total quantity is not zero.'], 401);
        }
    }
}