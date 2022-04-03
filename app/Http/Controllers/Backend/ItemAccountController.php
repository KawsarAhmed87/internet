<?php

namespace App\Http\Controllers\Backend;

use App\Models\ItemAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItemAccountController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any items !');
            }
            if ($this->user->can('accounting.view') || $this->user->can('accounting.create')|| $this->user->can('accounting.edit')|| $this->user->can('accounting.delete')) {
                $items = ItemAccount::where('parent_id', '!=', 0)->get();
            return view('backend.pages.item_account.index', compact('items'));
                
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('accounting.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any item !');
            }
            $accounts = ItemAccount::where('parent_id', 0)->get();
            return view('backend.pages.item_account.create', compact('accounts'));
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
        'name' => 'required|max:100|unique:item_accounts',
        'parent_id' => 'required|max:20',
    ]);

    // Create New data
    $data = new ItemAccount();
    $data->name = $request->name;
    $data->parent_id = $request->parent_id;
    $data->save();

    session()->flash('success', 'Item has been created !!');
    return redirect()->route('item-account.index');
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
        if (is_null($this->user) || !$this->user->can('accounting.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any item !');
            }
            
            $accounts = ItemAccount::where('parent_id', 0)->get();
            $item = ItemAccount::find($id);
            return view('backend.pages.item_account.edit', compact('accounts','item'));
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
        'name' => 'required|max:100|unique:item_accounts,name,' . $id,
        'parent_id' => 'required|max:20',
    ]);

     // update data
    $data = ItemAccount::find($id);
    $data->name = $request->name;
    $data->parent_id = $request->parent_id;
    $data->save();

    session()->flash('info', 'Item has been updated !!');
    return redirect()->route('item-account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('accounting.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any item !');
            }
    
            $data = ItemAccount::find($id);
            if (!is_null($data)) {
                $data->delete();
            }
    
            session()->flash('delete', 'Item has been deleted !!');
            return back();
    }
}
