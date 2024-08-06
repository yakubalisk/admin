<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('dashboard');
    }

    public function employeeList(Request $request)
    {
        if ($request->isMethod('post')) {
            
        }elseif ($request->ajax()) {
            try{
                $perPage = $request->input('length', 10);
                $start = $request->input('start', 0);
                $search = $request->input('search')['value'] ?? '';

                $query = Employees::query();

                if ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('first_name', 'like', "%$search%")
                            ->orWhere('last_name', 'like', "%$search%")
                            ->orWhere('position', 'like', "%$search%");
                            // ->orWhere('email', 'like', "%$search%");
                    });
                }

                $totalData = $query->count();
                $employees = $query->orderBy('id', 'desc')
                    ->offset($start)
                    ->limit($perPage)
                    ->get();

                return response()->json([
                    "draw" => intval($request->input('draw')),
                    "recordsTotal" => $totalData,
                    "recordsFiltered" => $totalData,
                    "data" => $employees,
                ]);

            }catch (Exception $e){
                return $response = array(
                    'status' => $e->getStatus(), 
                    'message' => $e->getMessage(), 
                    'file' => $e->getFile(), 
                );
            }
        }else{
            return view('employee_list');
        }
    }

    public function addEmployee(Request $request)
    {
        $password = 'password';
        if ($request->isMethod('post')) {
            $user = User::create([
                'name' => $request->first_name . ' ' .$request->last_name,
                'email' => $request->email,
                'password' => $password,
                'user_type' => 'employee',
                'status'=> '1',
            ]);

            $employees = Employees::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'position' => $request->position,
                'status' => '1',
            ]);
            // return $request;
            // return 'insert created successfully';
            return redirect()->back();
            
        }else {
            return 'else';

        }
        
    }
}
