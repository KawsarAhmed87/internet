<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Connection;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any connection !');
            }
            if ($this->user->can('connection.view') || $this->user->can('connection.create')|| $this->user->can('connection.edit')|| $this->user->can('connection.delete')) {
            $connections = Connection::latest()->get();
            return view('backend.pages.connection.index', compact('connections'));
                
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('connection.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any connection !');
            }
            $products = Product::all();
            $subscribers = Subscriber::all();
            return view('backend.pages.connection.create', compact('products', 'subscribers'));
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
            'connection_id' => 'required|max:8|unique:connections',
            'amount' => 'required|max:8',
            'connection_id' => 'required|max:20',
            'subscriber_id' => 'required|max:20'
        ]);

        // Create New data
        $data = new Connection();
        $data->connection_id = $request->connection_id;
        $data->amount = $request->amount;
        $data->connection_id = $request->connection_id;
        $data->subscriber_id = $request->subscriber_id;
        $data->bill_address = $request->bill_address;
        $data->save();

        session()->flash('success', 'Connection has been created !!');
        return redirect()->route('connection.index');
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
        if (is_null($this->user) || !$this->user->can('connection.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any connection !');
            }
    
            $connection = Connection::find($id);
            $products = Product::all();
            $subscribers = Subscriber::all();
            return view('backend.pages.connection.edit', compact('connection', 'products', 'subscribers'));
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
            'connection_id' => 'required|max:8|unique:connections,connection_id'.$id,
            'amount' => 'required|max:8',
            'connection_id' => 'required|max:20',
            'subscriber_id' => 'required|max:20'
        ]);

         // update data
        $data = Connection::find($id);
        $data->connection_id = $request->connection_id;
        $data->amount = $request->amount;
        $data->connection_id = $request->connection_id;
        $data->subscriber_id = $request->subscriber_id;
        $data->bill_address = $request->bill_address;
        $data->save();

        session()->flash('info', 'Connection has been updated !!');
        return redirect()->route('connection.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('connection.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any connection !');
            }
    
            $data = Connection::find($id);
            if (!is_null($data)) {
                $data->delete();
            }
    
            session()->flash('delete', 'Connection has been deleted !!');
            return back();
    }
}
