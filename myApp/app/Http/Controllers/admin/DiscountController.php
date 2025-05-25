<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountTarget;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discounts = Discount::all();
        return view('admin.discount.create', compact('discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountRequest $request)
    {
        $data = $request->validated();

        $discount = new Discount();
        $discount->discount_code = $data['discount_code'];
        $discount->description = $data['description'] ?? null;
        $discount->discount_amount = $data['discount_amount'];
        $discount->start_date =$data['start_date'];
        $discount->end_date = $data['end_date'];
        $discount->status = !empty($data['status']) ? 1 : 0;
        $discount->save();

        return redirect()->route('show-discount.index')->with('success', 'Thêm mã giảm giá thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $discounts = Discount::with('targets')->findOrFail($id);
        $products = Product::all(); // hoặc select('id', 'name') nếu cần tối ưu
        $categories = Category::all();
        return view('admin.discount.edit', compact('discounts','products','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $discount = Discount::findOrFail($id);

        $discount->update([
            'discount_code' => $request->discount_code,
            'description' => $request->description,
            'discount_amount' => $request->discount_amount
        ]);

        // Xóa hết các targets cũ
        $discount->targets()->delete();

        if ($request->has('targets')) {
            foreach ($request->input('targets') as $target) {
                DiscountTarget::create([
                    'discount_id' => $discount->discount_id,
                    'target_type' => $target['target_type'] ?? null,
                    'target_id' => $target['target_id'] ?? null,
                ]);
            }
        }

        return redirect()->route('show-discount.index')->with('success', 'Cập nhật mã giảm giá thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->targets()->delete();
        $discount->delete();

        return redirect()->route('show-discount.index')->with('success', 'Xóa mã khuyến mãi thành công.');
    }

}
