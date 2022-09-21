<?php

namespace App\Http\Controllers\Backend;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any employee !');
            }
            if ($this->user->can('employee.view') || $this->user->can('employee.create')|| $this->user->can('employee.edit')|| $this->user->can('employee.delete')) {
            $employees = Employee::latest()->get();
            return view('backend.pages.employee.index', compact('employees'));
                
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('employee.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any employee !');
            }
            return view('backend.pages.employee.create');
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
            'office_id' => 'max:30',
            'designation' => 'max:100',
            'phone1' => 'required|max:20|unique:employees',
            'phone2' => 'max:20',
            'email' => 'required|max:100|email|unique:employees',
            'address' => 'required'
        ]);

        // Create data
        $employee = new employee();
        $employee->name = $request->name;
        $employee->nid = $request->nid;
        $employee->office_id = $request->office_id;
        $employee->designation = $request->designation;
        $employee->phone1 = $request->phone1;
        $employee->phone2 = $request->phone2;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->save();

          session()->flash('success', 'employee has been created !!');
        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('employee.view')) {
            abort(403, 'Sorry !! You are unauthorized to view any subscirber !');
            }
    
            $employee = employee::find($id);
            return view('backend.pages.employee.view', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('employee.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any subscirber !');
            }
    
            $employee = Employee::find($id);
            return view('backend.pages.employee.edit', compact('employee'));
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
            'office_id' => 'max:30',
            'designation' => 'max:100',
            'phone1' => 'required|max:20|unique:employees,phone1,' . $id,
            'phone2' => 'max:20',
            'email' => 'required|max:100|email|unique:employees,email,' . $id,
            'address' => 'required'
        ]);

        // update data
        $employee = employee::find($id);
        $employee->name = $request->name;
        $employee->nid = $request->nid;
        $employee->office_id = $request->office_id;
        $employee->designation = $request->designation;
        $employee->phone1 = $request->phone1;
        $employee->phone2 = $request->phone2;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->save();

        session()->flash('info', 'employee has been updated !!');
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('employee.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any employee !');
            }
    
            $data = employee::find($id);
            if (!is_null($data)) {
                $data->delete();
            }
    
            session()->flash('delete', 'employee has been deleted !!');
            return back();
    }
}
