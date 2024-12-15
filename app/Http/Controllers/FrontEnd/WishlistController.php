<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Repositories\Interfaces\WishlistRepositoryInterface;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function __construct(protected WishlistRepositoryInterface $wishlist)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front-end.wishlist.index',
            [
                'wishlists' => $this->wishlist->get(),
                'title' => 'Wish List'
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::query()->findOrFail($request->post('product_id'));
        $wishlist = $this->wishlist->add($product);

        if (!$wishlist) {
            toastr()->error(__('Wish List Not Added'));
        }

        toastr()->success(__('Wish List Added Successfully'));
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->wishlist->delete($id);
        toastr()->success(__('Wish List Deleted Successfully'));
        return redirect()->back();
    }
}
