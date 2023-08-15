<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\User;
use App\Drug;
use App\Item;
use App\Stock;
use App\Mail\DeleteStockMail;
use App\StockInflow;
class StockController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'pack' => 'required|integer',
            'price' => 'required|integer',
            'purchase_price' => 'required|integer'
        ]);
        $user = User::where('id', $request->user_id)->first();

        if ($request->stock_type == 'Drug') {
            $stock = Stock::where(['drug_id' => $request->drug, 'stock_type' => 'Drug', 'facility_id' => $user->facility_id])->first();
            if (isset($request->counting) && $request->counting == 1) {
                Stock::where(['drug_id' => $request->drug, 'stock_type' => 'Drug', 'facility_id' => $user->facility_id])->update([
                    'pack' => ($stock->pack + $request->pack),
                    'quantity' => $request->quantity,
                    'total_quantity' => ($stock->total_quantity + ($request->pack * $request->quantity)),
                    'price' => ($request->price / $request->quantity),
                    'purchase_price' => ($request->purchase_price / $request->quantity),
                    'counting' => $request->counting,
                    'minimum_counts' => $request->minimum_counts,
                    'mfg_date' => $request->mfg_date,
                    'exp_date' => $request->exp_date,
                    'added_by' => $user->name
                ]);
                StockInflow::create([
                    'drug_id' => $request->drug,
                    'added_by' => $user->name,
                    'stock_type' => 'Drug',
                    'facility_id' => $user->facility_id,
                    'pack' => $request->pack,
                    'quantity' => $request->quantity,
                    'total_quantity' => ($request->pack * $request->quantity),
                    'price' => ($request->price / $request->quantity),
                    'purchase_price' => ($request->purchase_price / $request->quantity),
                    'counting' => $request->counting,
                    'minimum_counts' => $request->minimum_counts,
                    'mfg_date' => $request->mfg_date,
                    'exp_date' => $request->exp_date
                ]);
            } else {
                Stock::where(['drug_id' => $request->drug, 'stock_type' => 'Drug', 'facility_id' => $user->facility_id])->update([
                    'pack' => ($stock->pack + $request->pack),
                    'quantity' => $request->quantity,
                    'total_quantity' => ($stock->total_quantity + ($request->pack * $request->quantity)),
                    'price' => ($request->price / $request->quantity) ,
                    'purchase_price' => ($request->purchase_price / $request->quantity),
                    'mfg_date' => $request->mfg_date,
                    'exp_date' => $request->exp_date
                ]);
                StockInflow::create([
                    'drug_id' => $request->drug,
                    'added_by' => $user->name,
                    'stock_type' => 'Drug',
                    'facility_id' => $user->facility_id,
                    'pack' => $request->pack,
                    'quantity' => $request->quantity,
                    'total_quantity' => ($request->pack * $request->quantity),
                    'price' => ($request->price / $request->quantity),
                    'purchase_price' => ($request->purchase_price / $request->quantity),
                    'mfg_date' => $request->mfg_date,
                    'exp_date' => $request->exp_date
                ]);
            }

        } else {
            $stock = Stock::where(['item_id' => $request->item, 'stock_type' => 'Item', 'facility_id' => $user->facility_id])->first();
            Stock::where(['item_id' => $request->item, 'stock_type' => 'Item', 'facility_id' => $user->facility_id])->update([

                'total_quantity' => ($stock->total_quantity + $request->pack),
                'price' => $request->price,
                'purchase_price' => $request->purchase_price,
                'mfg_date' => $request->mfg_date,
                'exp_date' => $request->exp_date,
                'added_by' => $user->name,
            ]);
            StockInflow::create([
                'item_id' => $request->item,
                'added_by' => $user->name,
                'facility_id' => $user->facility_id,
                'pack' => $request->pack,
                'total_quantity' => $request->pack,
                'price' => $request->price,
                'purchase_price' => $request->purchase_price,
                'mfg_date' => $request->mfg_date,
                'exp_date' => $request->exp_date,
                'stock_type' => 'Item'
            ]);
        }

    }
    public function drugs($id)
    {
        $user = User::where('id', $id)->first();
        $stocks = DB::table('stocks')
                    ->leftJoin('drugs', 'drugs.id', '=', 'stocks.drug_id')
                    ->where([
                        ['stocks.stock_type', '=', 'Drug'],
                        ['stocks.facility_id', '=', $user->facility_id],
                        ['stocks.total_quantity', '!=', 0]
                    ])
                    ->select('stocks.*', 'drugs.name')
                    ->get();
        return response()->json($stocks);
    }
    public function items($id)
    {
        $user = User::where('id', $id)->first();
        $stocks = DB::table('stocks')
                    ->leftJoin('items', 'items.id', '=', 'stocks.item_id')
                    ->where([
                        ['stocks.stock_type', '=', 'Item'],
                        ['stocks.facility_id', '=', $user->facility_id],
                        ['stocks.total_quantity', '!=', 0]
                    ])
                    ->select('stocks.*', 'items.name')
                    ->get();
        return response()->json($stocks);
    }
    public function drugInflows($id)
    {
        $user = User::where('id', $id)->first();
        $inflows = DB::table('stock_inflows')
                        ->leftJoin('drugs', 'drugs.id', '=', 'stock_inflows.drug_id')
                        ->where([
                            ['stock_inflows.stock_type', '=', 'Drug'],
                            ['stock_inflows.facility_id', '=', $user->facility_id]
                        ])
                        ->select('drugs.name', 'stock_inflows.*')
                        ->get();
        return response()->json($inflows);
    }
    public function itemInflows($id)
    {
        $user = User::where('id', $id)->first();
        $inflows = DB::table('stock_inflows')
                        ->leftJoin('items', 'items.id', '=', 'stock_inflows.item_id')
                        ->where([
                            ['stock_inflows.stock_type', '=', 'Item'],
                            ['stock_inflows.facility_id', '=', $user->facility_id]
                        ])
                        ->select('items.name', 'stock_inflows.*')
                        ->get();
        return response()->json($inflows);
    }
    public function drugInflowMonth($id, $date)
    {

        $user = User::where('id', $id)->first();
        $drugs = DB::table('stock_inflows')
                    ->leftJoin('drugs', 'drugs.id', '=', 'stock_inflows.drug_id')
                    ->where([
                            ['stock_inflows.facility_id', $user->facility_id],
                            ['stock_inflows.created_at', 'like', '%' . $date . '%'],
                            ['stock_inflows.stock_type', '=', 'Drug']
                        ])
                    ->select('stock_inflows.*', 'drugs.name')
                    ->get();
        return response()->json($drugs);
    }
    public function itemInflowMonth($id, $date)
    {

        $user = User::where('id', $id)->first();
        $items = DB::table('stock_inflows')
                    ->leftJoin('items', 'items.id', '=', 'stock_inflows.item_id')
                    ->where([
                            ['stock_inflows.facility_id', $user->facility_id],
                            ['stock_inflows.created_at', 'like', '%' . $date . '%'],
                            ['stock_inflows.stock_type', '=', 'Item']
                        ])
                    ->select('stock_inflows.*', 'items.name')
                    ->get();
        return response()->json($items);
    }
    public function drugOutflows($id)
    {
        $user = User::where('id', $id)->first();
        $outflows = DB::table('stock_outflows')
                        ->leftJoin('drugs', 'drugs.id', '=', 'stock_outflows.drug_id')
                        ->leftJoin('stocks', 'stocks.drug_id', '=', 'stock_outflows.drug_id')
                        ->where([
                            ['stock_outflows.type', '=', 'Drug'],
                            ['stock_outflows.facility_id', '=', $user->facility_id]
                        ])
                        ->select('drugs.name', 'stock_outflows.*', 'stocks.price', 'stocks.purchase_price', 'stocks.counting')
                        ->get();
        return response()->json($outflows);
    }
    public function drugOutflowMonth($id, $date)
    {
        $user = User::where('id', $id)->first();
        $outflows = DB::table('stock_outflows')
                        ->leftJoin('drugs', 'drugs.id', '=', 'stock_outflows.drug_id')
                        ->leftJoin('stocks', 'stocks.drug_id', '=', 'stock_outflows.drug_id')
                        ->where([
                            ['stock_outflows.type', '=', 'Drug'],
                            ['stock_outflows.facility_id', '=', $user->facility_id],
                            ['stock_outflows.created_at', 'like', '%' . $date . '%']
                        ])
                        ->select('drugs.name', 'stock_outflows.*', 'stocks.price', 'stocks.purchase_price', 'stocks.counting')
                        ->get();
        return response()->json($outflows);
    }
    public function itemOutflows($id)
    {
        $user = User::where('id', $id)->first();
        $outflows = DB::table('stock_outflows')
                        ->leftJoin('items', 'items.id', '=', 'stock_outflows.item_id')
                        ->leftJoin('stocks', 'stocks.item_id', '=', 'stock_outflows.item_id')
                        ->where([
                            ['stock_outflows.type', '=', 'Item'],
                            ['stock_outflows.facility_id', '=', $user->facility_id]
                        ])
                        ->select('items.name', 'stock_outflows.*', 'stocks.price', 'stocks.purchase_price')
                        ->get();
        return response()->json($outflows);
    }
    public function itemOutflowMonth($id, $date)
    {
        $user = User::where('id', $id)->first();
        $outflows = DB::table('stock_outflows')
                        ->leftJoin('items', 'items.id', '=', 'stock_outflows.item_id')
                        ->leftJoin('stocks', 'stocks.item_id', '=', 'stock_outflows.item_id')
                        ->where([
                            ['stock_outflows.type', '=', 'Item'],
                            ['stock_outflows.facility_id', '=', $user->facility_id],
                            ['stock_outflows.created_at', 'like', '%' . $date . '%']
                        ])
                        ->select('items.name', 'stock_outflows.*', 'stocks.price', 'stocks.purchase_price')
                        ->get();
        return response()->json($outflows);
    }
    public function drugOutflowToday($id)
    {
        $date = date('Y-m-d');
        $user = User::where('id', $id)->first();
        $outflows = DB::table('stock_outflows')
                        ->leftJoin('drugs', 'drugs.id', '=', 'stock_outflows.drug_id')
                        ->leftJoin('stocks', 'stocks.drug_id', '=', 'stock_outflows.drug_id')
                        ->where([
                            ['stock_outflows.type', '=', 'Drug'],
                            ['stock_outflows.facility_id', '=', $user->facility_id],
                            ['stock_outflows.created_at', 'like', '%' . $date . '%']
                        ])
                        ->select('drugs.name', 'stock_outflows.*', 'stocks.price', 'stocks.purchase_price', 'stocks.counting')
                        ->get();
        return response()->json($outflows);
    }
    public function itemOutflowToday($id)
    {
        $date = date('Y-m-d');
        $user = User::where('id', $id)->first();
        $outflows = DB::table('stock_outflows')
                        ->leftJoin('items', 'items.id', '=', 'stock_outflows.item_id')
                        ->leftJoin('stocks', 'stocks.item_id', '=', 'stock_outflows.item_id')
                        ->where([
                            ['stock_outflows.type', '=', 'Item'],
                            ['stock_outflows.facility_id', '=', $user->facility_id],
                            ['stock_outflows.created_at', 'like', '%' . $date . '%']
                        ])
                        ->select('items.name', 'stock_outflows.*', 'stocks.price', 'stocks.purchase_price')
                        ->get();
        return response()->json($outflows);
    }
    public function drugOutflowDate($id, $date)
    {
        $user = User::where('id', $id)->first();
        $outflows = DB::table('stock_outflows')
                        ->leftJoin('drugs', 'drugs.id', '=', 'stock_outflows.drug_id')
                        ->leftJoin('stocks', 'stocks.drug_id', '=', 'stock_outflows.drug_id')
                        ->where([
                            ['stock_outflows.type', '=', 'Drug'],
                            ['stock_outflows.facility_id', '=', $user->facility_id],
                            ['stock_outflows.created_at', 'like', '%' . $date . '%']
                        ])
                        ->select('drugs.name', 'stock_outflows.*', 'stocks.price', 'stocks.purchase_price', 'stocks.counting')
                        ->get();
        return response()->json($outflows);
    }
    public function itemOutflowDate($id, $date)
    {
        $user = User::where('id', $id)->first();
        $outflows = DB::table('stock_outflows')
                        ->leftJoin('items', 'items.id', '=', 'stock_outflows.item_id')
                        ->leftJoin('stocks', 'stocks.item_id', '=', 'stock_outflows.item_id')
                        ->where([
                            ['stock_outflows.type', '=', 'Item'],
                            ['stock_outflows.facility_id', '=', $user->facility_id],
                            ['stock_outflows.created_at', 'like', '%' . $date . '%']
                        ])
                        ->select('items.name', 'stock_outflows.*', 'stocks.price')
                        ->get();
        return response()->json($outflows);
    }
    public function deleteStockInflow($id, $user_id)
    {
        $inflow =  StockInflow::where('id', $id)->first();
        // subtract the inflow from the stock
        $user = User::where('id', $user_id)->first();
        $stock =  Stock::where(['drug_id' => $inflow->drug_id, 'facility_id' => $user->facility_id])->first();
        if ($stock->stock_type == 'Drug') {
            Stock::where(['drug_id' => $inflow->drug_id, 'facility_id' => $user->facility_id, 'stock_type' => 'Drug'])->update([
                'pack' => ($stock->pack - $inflow->pack),
                'quantity' => ($stock->quantity - $inflow->quantity),
                'total_quantity' => ($stock->total_quantity - $inflow->total_quantity)
            ]);
            $drug = Drug::where(['id' => $inflow->drug_id, 'facility_id' => $user->facility_id])->first();
            $name = $drug->name;
        } else {
            Stock::where(['item_id' => $inflow->item_id, 'facility_id' => $user->facility_id, 'stock_type' => 'Item'])->update([
                'pack' => ($stock->pack - $inflow->pack),
                'quantity' => ($stock->quantity - $inflow->quantity),
                'total_quantity' => ($stock->total_quantity - $inflow->total_quantity)
            ]);
           $item = Item::where(['id' => $inflow->item_id, 'facility_id' => $user->facility_id])->first();
           $name = $item->name;
        }

        // send a mail to the admin for what was deleted
        $admin = User::where('id', $user->facility_id)->first();
        $data = [
            'pack' => $inflow->pack,
            'quantity' => $inflow->quantity,
            'total_quantity' => $inflow->total_quantity,
            'admin' => $admin->name,
            'user' => $user->name,
            'stock_type' => $stock->stock_type,
            'name' => $name
        ];
        Mail::to($admin->email)->send(new DeleteStockMail($data));
        StockInflow::where('id', $id)->delete();
    }
    function monthlyDrugSales($id) {
        $user = User::where('id', $id)->first();
        $facility_id = $user->facility_id;
        $date = date('Y');
        $sales = DB::select("SELECT MONTH(stock_outflows.created_at) as months, SUM(stock_outflows.qty * (stocks.price - stocks.purchase_price)) as profit, SUM(stock_outflows.qty * stocks.price) as total FROM stock_outflows, stocks WHERE stock_outflows.drug_id = stocks.drug_id && stock_outflows.facility_id = $facility_id && stock_outflows.created_at LIKE '%$date%' GROUP BY MONTH(stock_outflows.created_at)");
        return response()->json($sales);
    }
    function monthlyItemSales($id) {
        $user = User::where('id', $id)->first();
        $facility_id = $user->facility_id;
        $date = date('Y');
        $sales = DB::select("SELECT MONTH(stock_outflows.created_at) as months, SUM(stock_outflows.qty * (stocks.price - stocks.purchase_price)) as profit, SUM(stock_outflows.qty * stocks.price) as total FROM stock_outflows, stocks WHERE stock_outflows.item_id = stocks.item_id && stock_outflows.facility_id = $facility_id && stock_outflows.created_at LIKE '%$date%' GROUP BY MONTH(stock_outflows.created_at)");
        return response()->json($sales);
    }
    function monthlyInflows($id, $type) {
        $user = User::where('id', $id)->first();
        $facility_id = $user->facility_id;
        $date = date('Y');
        $inflows = DB::select("SELECT MONTH(created_at) as months, SUM(total_quantity * price) as total FROM stock_inflows WHERE stock_type = '$type' && facility_id = $facility_id && created_at LIKE '%$date%' GROUP BY MONTH(created_at)");
        return response()->json($inflows);
    }

}