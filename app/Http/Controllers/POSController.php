<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Str;
use Mail;
use App\User;
use App\Drug;
use App\Item;
use App\Stock;
use App\POS;
use App\Customer;
use App\StockOutflow;
use App\PharmacyCustomerOrder;
use App\PatientInvoice;
use App\PharmacySale;
use App\Mail\PharmacyInvoiceMail;
class POSController extends Controller
{
    public function addToCart($id, $type, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $data = array();
        if ($type == 'Drug') {
            $drug = DB::table('drugs')
                        ->leftJoin('stocks', 'stocks.drug_id', '=', 'drugs.id')
                        ->where([
                            ['drugs.facility_id', '=', $user->facility_id],
                            ['drugs.id', '=', $id]
                        ])
                        ->select('stocks.price', 'drugs.name', 'drugs.id', 'stocks.counting', 'stocks.minimum_counts')
                        ->first();

            if ($drug->counting) {
                $data['product_id'] = $drug->id;
                $data['facility_id'] = $user->facility_id;
                $data['user_id'] = $user->id;
                $data['product_type'] = 'Drug';
                $data['usages'] = 1;
                $data['times'] = 1;
                $data['product_name'] = $drug->name;
                $data['product_qty'] = $drug->minimum_counts;
                $data['product_price'] = $drug->price;
                $data['sub_total'] = $drug->price * $drug->minimum_counts;
                $data['added_by'] = $user->name;
            }else{
                $data['product_id'] = $drug->id;
                $data['facility_id'] = $user->facility_id;
                $data['user_id'] = $user->id;
                $data['product_type'] = 'Drug';
                $data['usages'] = 1;
                $data['times'] = 1;
                $data['product_name'] = $drug->name;
                $data['product_qty'] = 1;
                $data['product_price'] = $drug->price;
                $data['sub_total'] = $drug->price;
                $data['added_by'] = $user->name;
            }
            $pos = POS::where(['product_id' => $id, 'facility_id' => $user->facility_id, 'product_type' => 'Drug'])->first();
            if($pos){
                if ($drug->counting) {
                    POS::where(['product_id' => $id, 'facility_id' => $user->facility_id, 'product_type' => 'Drug'])->update([
                        'product_qty' => $pos->product_qty + $drug->minimum_counts
                    ]);
                } else {
                    POS::where(['product_id' => $id, 'facility_id' => $user->facility_id, 'product_type' => 'Drug'])->update([
                        'product_qty' => $pos->product_qty + 1
                    ]);
                }
            }else{
                POS::create($data);
            }
        }elseif($type == 'Item'){
            $item = DB::table('items')
                        ->leftJoin('stocks', 'stocks.item_id', '=', 'items.id')
                        ->where([
                            ['items.facility_id', '=', $user->facility_id],
                            ['items.id', '=', $id]
                        ])
                        ->select('stocks.price', 'items.name', 'items.id')
                        ->first();

            $data['product_id'] = $item->id;
            $data['facility_id'] = $user->facility_id;
            $data['user_id'] = $user->id;
            $data['product_type'] = 'Item';
            $data['product_name'] = $item->name;
            $data['product_qty'] = 1;
            $data['product_price'] = $item->price;
            $data['sub_total'] = $item->price;
            $data['added_by'] = $user->name;

            $pos = POS::where(['product_id' => $id, 'facility_id' => $user->facility_id, 'product_type' => 'Item'])->first();
            if ($pos) {
                POS::where(['product_id' => $id, 'facility_id' => $user->facility_id, 'product_type' => 'Item'])->update([
                    'product_qty' => $pos->product_qty + 1
                ]);
            }else{
                POS::create($data);
            }
        }else{

            $facility_id = $user->facility_id;

            $test = DB::table('medical_laboratory_tests')->where('id', $id)->first();
            $lab_test = DB::table('laboratory_medical_tests')->where('test_id', $id)->first();
            $data = array();
            $data['product_id'] = $test->id;
            $data['facility_id'] = $user->facility_id;
            $data['user_id'] = $user->id;
            $data['product_type'] = 'Laboratory Test';
            $data['product_name'] = $test->test_name;
            $data['product_qty'] = 1;
            $data['product_price'] = $lab_test->price;
            $data['sub_total'] = $lab_test->price;
            $data['added_by'] = $user->name;

            $pos = Pos::where(['product_id' => $id, 'facility_id' => $facility_id, 'user_id' => $user->id])->first();
            if(!$pos){
                Pos::create($data);
            }else{
                return response()->json(['error' => 'Medical Diagnostic or Labratory has already been added to Cart'], 401);
            }
        }
    }
    public function carts($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $carts = POS::where(['facility_id'=> $user->facility_id, 'user_id' => $user->id])->get();
        return response()->json($carts);
    }
    public function removeCart($id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        POS::where(['id' => $id, 'facility_id' => $user->facility_id, 'user_id' => $user->id])->delete();
    }
    public function incrementQty($id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $product = POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->first();
        if ($product->product_type == 'Drug') {
            $drug = DB::table('drugs')
                        ->leftJoin('stocks', 'stocks.drug_id', '=', 'drugs.id')
                        ->where([
                            ['drugs.facility_id', '=', $user->facility_id],
                            ['drugs.id', '=', $product->product_id]
                        ])
                        ->select('stocks.price', 'drugs.name', 'drugs.id', 'stocks.counting', 'stocks.minimum_counts')
                        ->first();
            if ($drug->counting) {
                POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
                    'product_qty' => $product->product_qty + $drug->minimum_counts,
                    'sub_total' => $product->sub_total + $product->product_price
                ]);
            }else{
                POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
                    'product_qty' => $product->product_qty + 1,
                    'sub_total' => $product->sub_total + $product->product_price
                ]);
            }

        }else{
            POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
                'product_qty' => $product->product_qty + 1,
                'sub_total' => $product->sub_total + $product->product_price
            ]);
        }

    }
    public function decrementQty($id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $product = POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->first();
        if ($product->product_type == 'Drug') {
            $drug = DB::table('drugs')
                        ->leftJoin('stocks', 'stocks.drug_id', '=', 'drugs.id')
                        ->where([
                            ['drugs.facility_id', '=', $user->facility_id],
                            ['drugs.id', '=', $product->product_id]
                        ])
                        ->select('stocks.price', 'drugs.name', 'drugs.id', 'stocks.counting', 'stocks.minimum_counts')
                        ->first();
            if ($drug->counting) {
                POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
                    'product_qty' => $product->product_qty - $drug->minimum_counts,
                    'sub_total' => $product->sub_total - $product->product_price
                ]);
            }else{
                POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
                    'product_qty' => $product->product_qty - 1,
                    'sub_total' => $product->sub_total - $product->product_price
                ]);
            }

        }else{
            POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
                'product_qty' => $product->product_qty - 1,
                'sub_total' => $product->sub_total - $product->product_price
            ]);
        }

    }
    public function incrementUsage($id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $product = POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->first();
        POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
            'usages' => $product->usages + 1
        ]);
    }
    public function decrementUsage($id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $product = POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->first();
        POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
            'usages' => $product->usages - 1
        ]);
    }
    public function incrementTimes($id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $product = POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->first();
        POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
            'times' => $product->times + 1
        ]);
    }
    public function decrementTimes($id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $product = POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->first();
        POS::where(['facility_id' => $user->facility_id, 'id' => $id, 'user_id' => $user->id])->update([
            'times' => $product->times - 1
        ]);
    }

    public function processOrder(Request $request,  $user_id)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
        ]);

        $user = User::where('id', $user_id)->first();

        $facility_id = $user->facility_id;

        // check if pharmaceutical premises or hospital
        $facility = DB::table('facility_signatures')->where('facility_id', $facility_id)->first();
        function stock($user_id)
        {
            $user = User::where('id', $user_id)->first();
             // get carts
            $carts = POS::where(['facility_id'=> $user->facility_id, 'user_id' => $user->id])->get();


            $names = array();
            $quantity = 0;
            function checkStock($product_id, $type, $qty, $facility_id)
            {
                if ($type == 'Drug') {
                    $stock = Stock::where(['drug_id' => $product_id, 'stock_type' => 'Drug', 'facility_id' => $facility_id])->first();
                    if ($qty > $stock->total_quantity) {
                        return response()->json(['error' => 'Stock before processing'], 401);
                    }
                }else{
                    $stock = Stock::where(['item_id' => $product_id, 'stock_type' => 'Item', 'facility_id' => $facility_id])->first();
                    if ($qty > $stock->total_quantity) {
                        return response()->json(['error' => 'Stock before processing'], 401);
                    }
                }
            }
            foreach ($carts as $cart) {
                checkStock($cart->product_id, $cart->product_type,  $cart->product_qty, $cart->facility_id);
                $names[] =  $cart->product_name;
                $quantity += $cart->product_qty;
            }
            $data = [
                'names' => $names,
                'quantity' => $quantity
            ];
            return $data;
        }
        function pharmacySale($request, $customer, $description, $user_id)
        {
            $user = User::where('id', $user_id)->first();
            // get last sale
            $last_sale = PharmacySale::where('facility_id', $user->facility_id)->orderBy('id', 'desc')->first();
            if (empty($last_sale)) {
                $last_invoice = '00000';
            } else {
                $last_invoice = $last_sale->invoice_number;
            }
            $number = substr($last_invoice, 2, 8);
            $invoice_no = sprintf("%010d", (1 + $number));

            $sales = PharmacySale::where(['user_id' => $user->id, 'facility_id' => $user->facility_id, 'status' => false])->get();

            if (count($sales) == 0) {
                PharmacySale::create([
                    'invoice_number' => $invoice_no,
                    'description' => implode(', ',$description['names']),
                    'amount' => $request->amount,
                    'pay_by' => $request->pay_by,
                    'user_id' => $user->id,
                    'added_by' => $user->name,
                    'facility_id' => $user->facility_id,
                    'customer_id' => $customer->id,
                ]);
            } else {
                PharmacySale::where(['user_id' => $user->id, 'facility_id' => $user->facility_id, 'status' => false])->update([
                    'description' => implode(', ',$description),
                    'amount' => $request->amount,
                    'pay_by' => $request->pay_by,
                    'customer_id' => $customer->id
                ]);
            }
        }
        if ($facility->facility_type == 'Hospital') {
            if ($request->payment_type == 'Add to Invoice') {
                $description = stock($user_id);
                PatientInvoice::create([
                    'key' => $request->patient['key'],
                    'user_id' => $request->patient['user_id'],
                    'description' => implode(', ', $description['names']),
                    'quantity' => $description['quantity'],
                    'amount' => $request->amount,
                    'staff_id' => $user->id,
                    'staff_name' => $user->name,
                    'facility_id' => $user->facility_id
                ]);
                // confirm payment
                $key = Str::random(50);
                // get carts
                $carts = POS::where(['facility_id'=> $user->facility_id, 'user_id' => $user->id])->get();
                function storeStockOutflow($product_id, $qty, $facility_id, $user_id, $type, $added_by)
                {
                    if ($type == 'Drug') {
                        StockOutflow::create([
                            'drug_id' => $product_id,
                            'type' => $type,
                            'qty' => $qty,
                            'facility_id' => $facility_id,
                            'user_id' => $user_id,
                            'added_by' => $added_by
                        ]);
                    }else{
                        StockOutflow::create([
                            'item_id' => $product_id,
                            'type' => $type,
                            'qty' => $qty,
                            'facility_id' => $facility_id,
                            'user_id' => $user_id,
                            'added_by' => $added_by
                        ]);
                    }

                }
                function updateStock($product_id, $type, $qty, $facility_id)
                {
                    if ($type == 'Drug') {
                        $stock = Stock::where(['drug_id' => $product_id, 'stock_type' => 'Drug', 'facility_id' => $facility_id])->first();
                        Stock::where(['drug_id' => $product_id, 'stock_type' => 'Drug', 'facility_id' => $facility_id])->update([
                            'total_quantity' => $stock->total_quantity - $qty
                        ]);
                    }else{
                        $stock = Stock::where(['item_id' => $product_id, 'stock_type' => 'Item', 'facility_id' => $facility_id])->first();
                        Stock::where(['item_id' => $product_id, 'stock_type' => 'Item', 'facility_id' => $facility_id])->update([
                            'total_quantity' => $stock->total_quantity - $qty
                        ]);
                    }
                }
                function customerOrder($customer_id, $key, $product_name, $usages, $times, $product_qty, $product_price, $sub_total, $user_id)
                {
                    $user = User::where('id', $user_id)->first();
                    PharmacyCustomerOrder::create([
                        'customer_id' =>$customer_id,
                        'key' => $key,
                        'product_name' => $product_name,
                        'usages' => $usages,
                        'times' => $times,
                        'product_qty' => $product_qty,
                        'product_price' => $product_price,
                        'sub_total' => $sub_total,
                        'staff_id' => $user->id,
                        'staff_name' => $user->name,
                        'facility_id' => $user->facility_id
                    ]);
                }
                $customers = Customer::where(['facility_id' => $user->facility_id, 'email' => $request->patient['email'], 'name' => $request->patient['name']])->get();
                $biodata = DB::table('biodatas')->where('user_id', $request->patient['user_id'])->first();
                if (count($customers) == 0) {
                    $customer = Customer::create([
                        'name' => $request->patient['name'],
                        'email' => $request->patient['email'],
                        'phone' => $biodata->mobile_phone,
                        'facility_id' => $user->facility_id
                    ]);
                }else{
                    $customer = Customer::where(['facility_id' => $user->facility_id, 'email' => $request->patient['email'], 'name' => $request->patient['name']])->first();
                }
                foreach ($carts as $cart) {
                    updateStock($cart->product_id, $cart->product_type,  $cart->product_qty, $cart->facility_id);
                    storeStockOutflow($cart->product_id, $cart->product_qty, $cart->facility_id, $cart->user_id, $cart->product_type, $cart->added_by);
                    if ($cart->product_type == 'Drug') {
                        customerOrder($customer->id, $key, $cart->product_name, $cart->usages, $cart->times, $cart->product_qty, $cart->product_price, $cart->sub_total, $user_id);
                    }

                }

                // empty the pos
                POS::where(['facility_id'=> $user->facility_id, 'user_id' => $user->id])->delete();

            } else {
                # pay now
                // add patient details to customer once
                // get patient details
                $biodata = DB::table('biodatas')->where('user_id', $request->patient['user_id'])->first();
                $customers = Customer::where(['facility_id' => $user->facility_id, 'email' => $request->patient['email'], 'name' => $request->patient['name']])->get();
                if (count($customers) == 0) {
                    $customer = Customer::create([
                        'name' => $request->patient['name'],
                        'email' => $request->patient['email'],
                        'phone' => $biodata->mobile_phone,
                        'facility_id' => $user->facility_id
                    ]);
                }else{
                    $customer = Customer::where(['facility_id' => $user->facility_id, 'email' => $request->patient['email'], 'name' => $request->patient['name']])->first();
                }
                $description = stock($user_id);
                pharmacySale($request, $customer, $description, $user_id);
            }
        } else {
            # pharmacy
            if ($request->customer) {
                $customer = Customer::where(['facility_id' => $user->facility_id, 'id' => $request->customer['id']])->first();
            } else {
                $customer = Customer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'facility_id' => $user->facility_id
                ]);
            }

            $description = stock($user_id);
            pharmacySale($request, $customer, $description, $user_id);

        }

    }
    public function getCustomerSale($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $sale = DB::table('pharmacy_sales')
                        ->leftJoin('customers', 'customers.id', '=', 'pharmacy_sales.customer_id')
                        ->select('pharmacy_sales.*', 'customers.name', 'customers.email', 'customers.phone')
                        ->where(['pharmacy_sales.user_id' => $user->id, 'pharmacy_sales.status' => false, 'pharmacy_sales.facility_id' => $user->facility_id])
                        ->first();

        return response()->json($sale);
    }
    public function confirmPayment($user_id)
    {
        $key = Str::random(50);
        $user = User::where('id', $user_id)->first();
        // get carts
        $carts = POS::where(['facility_id'=> $user->facility_id, 'user_id' => $user->id])->get();
        $sale = DB::table('pharmacy_sales')
                        ->select('pharmacy_sales.*')
                        ->where(['pharmacy_sales.user_id' => $user->id, 'pharmacy_sales.status' => false, 'pharmacy_sales.facility_id' => $user->facility_id])
                        ->first();
        function storeStockOutflow($product_id, $qty, $facility_id, $user_id, $type, $added_by)
        {
            if ($type == 'Drug') {
                StockOutflow::create([
                    'drug_id' => $product_id,
                    'type' => $type,
                    'qty' => $qty,
                    'facility_id' => $facility_id,
                    'user_id' => $user_id,
                    'added_by' => $added_by
                ]);
            }else{
                StockOutflow::create([
                    'item_id' => $product_id,
                    'type' => $type,
                    'qty' => $qty,
                    'facility_id' => $facility_id,
                    'user_id' => $user_id,
                    'added_by' => $added_by
                ]);
            }

        }
        function updateStock($product_id, $type, $qty, $facility_id)
        {
            if ($type == 'Drug') {
                $stock = Stock::where(['drug_id' => $product_id, 'stock_type' => 'Drug', 'facility_id' => $facility_id])->first();
                Stock::where(['drug_id' => $product_id, 'stock_type' => 'Drug', 'facility_id' => $facility_id])->update([
                    'total_quantity' => $stock->total_quantity - $qty
                ]);
            }else{
                $stock = Stock::where(['item_id' => $product_id, 'stock_type' => 'Item', 'facility_id' => $facility_id])->first();
                Stock::where(['item_id' => $product_id, 'stock_type' => 'Item', 'facility_id' => $facility_id])->update([
                    'total_quantity' => $stock->total_quantity - $qty
                ]);
            }
        }
        function customerOrder($customer_id, $key, $product_name, $usages, $times, $product_qty, $product_price, $sub_total, $user)
        {

            PharmacyCustomerOrder::create([
                'customer_id' => $customer_id,
                'key' => $key,
                'product_name' => $product_name,
                'usages' => $usages,
                'times' => $times,
                'product_qty' => $product_qty,
                'product_price' => $product_price,
                'sub_total' => $sub_total,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }
        $customer = Customer::where('id', $sale->customer_id)->first();
        foreach ($carts as $cart) {
            updateStock($cart->product_id, $cart->product_type,  $cart->product_qty, $cart->facility_id);
            storeStockOutflow($cart->product_id, $cart->product_qty, $cart->facility_id, $cart->user_id, $cart->product_type, $cart->added_by);
            if ($cart->product_type == 'Drug') {
                customerOrder($customer->id, $key, $cart->product_name, $cart->usages, $cart->times, $cart->product_qty, $cart->product_price, $cart->sub_total, $user);
            }
        }
        $sale =  PharmacySale::where(['user_id' => $user->id, 'facility_id' => $user->facility_id, 'status' => false])->first();

        $facility = DB::table('facility_signatures')->where('facility_id', $user->facility_id)->first();
        $data = [
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'carts' => $carts,
            'registered_facility_name' => $facility->registered_facility_name,
            'physical_location' => $facility->physical_location,
            'postal_code' => $facility->postal_code,
            'total' => $sale->amount,
            'invoice_number' => $sale->invoice_number,
            'date' => $sale->created_at
        ];
        Mail::to($customer->email)->send(new PharmacyInvoiceMail($data));
        // empty the pos
        POS::where(['facility_id'=> $user->facility_id, 'user_id' => $user->id])->delete();
        PharmacySale::where(['user_id' => $user->id, 'facility_id' => $user->facility_id, 'status' => false])->update([
            'status' => true
        ]);

    }
    public function patientPrescribedDrugsWithinFacility($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $drugs = DB::table('medical_prescribed_drugs')
                    ->leftJoin('patients', 'patients.id', '=', 'medical_prescribed_drugs.patient_id')
                    ->where(['medical_prescribed_drugs.completed' => 0, 'medical_prescribed_drugs.facility_id' => $user->facility_id])
                    ->select('medical_prescribed_drugs.*', 'patients.name', 'patients.email')
                    ->get();
        return response()->json($drugs);
    }
}
