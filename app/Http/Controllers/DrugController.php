<?php

namespace App\Http\Controllers;
use DB;
use Str;
use App\User;
use App\Drug;
use App\Stock;
use App\StockInflow;
use App\StockOutflow;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required',
            'nafdac_number' => 'required|string',
            'manufacturer' => 'required|string',
            'shelf_name' => 'required',
            'delivery' => 'required',
            'prescription_slip' => 'required'
        ]);
        $user = User::where('id', $request->user_id)->first();

        $data = [
            'uniqueId' => Str::random(10),
            'facility_id' => $user->facility_id,
            'delivery_id' => $request->delivery,
            'category' => $request->category,
            'nafdac_number' => $request->nafdac_number,
            'name' => ucwords($request->name),
            'manufacturer' => $request->manufacturer,
            'shelf_name' => $request->shelf_name,
            'prescription_slip' => $request->prescription_slip,
            'added_by' => $user->name
        ];
        Drug::create($data);
        $drug = Drug::where(['nafdac_number' => $request->nafdac_number, 'facility_id' => $user->facility_id])->first();
        Stock::create([
            'drug_id' => $drug->id,
            'stock_type' => 'Drug',
            'added_by' => $user->name,
            'facility_id' => $user->facility_id
        ]);
    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        $drugs = DB::table('drugs')
                    ->leftJoin('deliveries', 'deliveries.id', '=', 'drugs.delivery_id')
                    ->where('drugs.facility_id', $user->facility_id)
                    ->select('drugs.*', 'deliveries.delivery_name')
                    ->get();
        return response()->json($drugs);
    }
    public function show($id)
    {
        return response()->json(Drug::where('uniqueId', $id)->first());
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required',
            'nafdac_number' => 'required|string',
            'manufacturer' => 'required|string',
            'shelf_name' => 'required',
            'delivery' => 'required',
            'prescription_slip' => 'required'
        ]);

        $user = User::where('id', $request->id)->first();
        $data = [
            'delivery_id' => $request->delivery,
            'category' => $request->category,
            'nafdac_number' => $request->nafdac_number,
            'name' => ucwords($request->name),
            'manufacturer' => $request->manufacturer,
            'shelf_name' => $request->shelf_name,
            'prescription_slip' => $request->prescription_slip,
            'added_by' => $user->name
        ];
        Drug::where('uniqueId', $id)->update($data);
    }
    public function destroy($id)
    {
        $drug = Drug::where('uniqueId', $id)->first();
        $stock = Stock::where(['drug_id' => $drug->id, 'facility_id' => $drug->facility_id])->first();
        if ($stock->total_quantity == 0) {
            Drug::where('uniqueId', $id)->delete();
            Stock::where('id', $stock->id)->delete();
            $inflow = StockInflow::where(['drug_id' => $drug->id, 'facility_id' => $drug->facility_id])->first();
            if (isset($inflow)) {
                StockInflow::where(['drug_id' => $drug->id, 'facility_id' => $drug->facility_id])->delete();
            }
            $outflow = StockOutflow::where(['drug_id' => $drug->id, 'facility_id' => $drug->facility_id])->first();
            if (isset($outflow)) {
                StockOutflow::where(['drug_id' => $drug->id, 'facility_id' => $drug->facility_id])->delete();
            }
        } else {
            return response()->json(['error' => 'You can not delete this drug because the total quantity is not zero.'], 401);
        }
        
        
    }
    
}