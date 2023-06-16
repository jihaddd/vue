<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Employee;
use App\Models\Book;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Errorhandl as Errorhandl;

class Invntory extends Errorhandl
{
    //register company
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError( $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'company register successfully.');
    }
    // end

    // login company
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            return $this->sendResponse($success, 'company login successfully.');
        } 
        else{ 
            return $this->sendError('Login information is incorrect.');
        } 
    }
    // end

    // register employee
    public function register_employee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError( $validator->errors());       
        }
        $company_id = Auth::user()->id;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['company_id']= $company_id;
        $user = Employee::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'employee register successfully.');
    }
    // end

    // login employee
    public function login_employee(Request $request)
    {   
        if(Auth::guard('webemployees')->attempt(['email' => $request->email, 'password' => $request->password]))
       { 
            $user = Auth::guard('webemployees')->user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            return $this->sendResponse($success, 'employee login successfully.');
        } 
        else{ 
            return $this->sendError('Login information is incorrect');
        } 
    }
    // end

    // delete employee
    public function delete_employee($id)
    {
        Employee::where('id', $id)->delete();
   
        return $this->sendResponse([], 'Employee deleted successfully.');
    }
    // end

    // Add book using company
    public function store(Request $request)
    {
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'name' => 'required',
            'descrption' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.');       
        }
        
        $company_id = Auth::user()->id;
        $input['user_id']= $company_id;
   
        $Book = Book::create($input);
        
        return response()->json($Book);
       
    } 
    // end

    // update book 
     
    public function update_book(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'descrption' => 'required',
        ]);
        $Book=Book::where('id',$id)
        ->update($request->all());
   
        return [
            "msg" => "Book updated successfully"
        ];
    }
    // end

    // show book 
    public function index()
    {
        
        $id = Auth::user()->id;
        $Book=DB::table('books')->where('id',$id)->get();
    
        return response()->json($Book);
    }
    // end

    // serche book 
    public function show($id)
    {
        $Book = Book::find($id);
  
        if (is_null($Book)) {
            return $this->sendError('Book not found.');
        }
   
        return response()->json($Book);
    }
    // end

}
