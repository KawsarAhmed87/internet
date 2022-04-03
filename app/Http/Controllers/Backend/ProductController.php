<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public $user;

     public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    } 

    public function index()
    {
        if (is_null($this->user)) {
        abort(403, 'Sorry !! You are unauthorized to view any product !');
        }
        if ($this->user->can('product.view') || $this->user->can('product.create')|| $this->user->can('product.edit')|| $this->user->can('product.delete')) {
            $products = Product::all();
        return view('backend.pages.product.index', compact('products'));
            
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('product.create')) {
        abort(403, 'Sorry !! You are unauthorized to create any product !');
        }
        return view('backend.pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:products',
        ]);

        // Create New data
        $data = new Product();
        $data->name = $request->name;
        $data->save();

        session()->flash('success', 'Product has been created !!');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('product.edit')) {
        abort(403, 'Sorry !! You are unauthorized to edit any product !');
        }

        $product = Product::find($id);
        return view('backend.pages.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       

        // Validation Data
        $request->validate([
            'name' => 'required|max:50|unique:products,name,' . $id,
        ]);

         // update data
        $data = Product::find($id);
        $data->name = $request->name;
        $data->save();

        session()->flash('info', 'Product has been updated !!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('product.delete')) {
        abort(403, 'Sorry !! You are unauthorized to delete any product !');
        }

        $data = Product::find($id);
        if (!is_null($data)) {
            $data->delete();
        }

        session()->flash('delete', 'Product has been deleted !!');
        return back();
    }
}
