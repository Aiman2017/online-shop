<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct(protected CartRepositoryInterface $cart)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front-end.cart.index',
            [
                'carts' => $this->cart->get(),
                'total' => $this->cart->total()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => ['nullable', 'integer', 'min:1']
        ]);
        $product = Product::query()->findOrFail($request->post('product_id'));
        $cart = $this->cart->add($product, $request->post('quantity') ?? 1);
        if (!$cart) {
            toastr()->error('Data Error');
            return redirect()->back();
        }

        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $this->cart->delete($id);
        return redirect()->back();
    }

    protected function clear()
    {
        $this->cart->empty();

        return redirect()->back();
    }
}
