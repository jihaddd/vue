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

    //  Book ---------------------------------------------

    // all book 
    public function index()
    {
        $books = Book::all();
         
        return response()->json($books);    
    }
    // end

    // add book 
    
    public function store(Request $request)
    {
        $book = new Book([
            'name' => $request->input('name'),
            'detail' => $request->input('detail')
        ]);
        $book->save();
        return response()->json('Book created!');
    }

    // end

    // serch book
    public function show($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }
    // end

    // update book
    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());
        return response()->json('Book updated!');
    }
    // end

    // delete book 
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return response()->json('Book deleted!');
    }
    // end


    // api google book
    public function google_book()
    {
        $client = new \GuzzleHttp\Client();
        $url= "https://www.googleapis.com/books/v1/volumes?q=search-terms";
        $response = $client->request("GET", $url);
        $res_json = json_decode( $response->getBody()->getContents(), true );
        $data=$res_json['items'];
        // dd($data);
        // die;
        return view ('app',compact('data'));
    }
    // end
   

}
