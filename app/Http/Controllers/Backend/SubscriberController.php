<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any subscriber !');
            }
            if ($this->user->can('subscriber.view') || $this->user->can('subscriber.create')|| $this->user->can('subscriber.edit')|| $this->user->can('subscriber.delete')) {
            $subscribers = Subscriber::latest()->get();
            return view('backend.pages.subscriber.index', compact('subscribers'));
                
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('subscriber.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any subscriber !');
            }
            return view('backend.pages.subscriber.create');
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
            'name' => 'required|max:120',
            'nid' => 'max:30',
            'phone1' => 'required|max:20|unique:subscribers',
            'phone2' => 'max:20',
            'email' => 'required|max:100|email|unique:subscribers',
            'address' => 'required'
        ]);

        // Create data
        $subscriber = new Subscriber();
        $subscriber->name = $request->name;
        $subscriber->nid = $request->nid;
        $subscriber->phone1 = $request->phone1;
        $subscriber->phone2 = $request->phone2;
        $subscriber->email = $request->email;
        $subscriber->address = $request->address;
        $subscriber->save();

          session()->flash('success', 'Subscriber has been created !!');
        return redirect()->route('subscriber.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('subscriber.view')) {
            abort(403, 'Sorry !! You are unauthorized to view any subscirber !');
            }
    
            $subscriber = Subscriber::find($id);
            return view('backend.pages.subscriber.view', compact('subscriber'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('subscriber.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any subscirber !');
            }
    
            $subscriber = Subscriber::find($id);
            return view('backend.pages.subscriber.edit', compact('subscriber'));
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
            'name' => 'required|max:120',
            'nid' => 'max:30',
            'phone1' => 'required|max:20|unique:subscribers,phone1,' . $id,
            'phone2' => 'max:20',
            'email' => 'required|max:100|email|unique:subscribers,email,' . $id,
            'address' => 'required'
        ]);

        // update data
        $subscriber = Subscriber::find($id);
        $subscriber->name = $request->name;
        $subscriber->nid = $request->nid;
        $subscriber->phone1 = $request->phone1;
        $subscriber->phone2 = $request->phone2;
        $subscriber->email = $request->email;
        $subscriber->address = $request->address;
        $subscriber->save();

        session()->flash('info', 'Subscriber has been updated !!');
        return redirect()->route('subscriber.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('subscriber.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any subscriber !');
            }
    
            $data = Subscriber::find($id);
            if (!is_null($data)) {
                $data->delete();
            }
    
            session()->flash('delete', 'Subscriber has been deleted !!');
            return back();
    }
}
