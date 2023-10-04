<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Invoice;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    /*
     |--------------------------------------------------------------------------
     | User Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles all user related functionality.
    */
     

    public function userCreate(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',

        ]);
        
       
        $user = new User();
        $user->password = bcrypt($request->password);
        $user->fill($request->all());

        if ($user->save()) {

            return $this->toJson([
                'user' => $user
            ], 'user create successfully', 1);
        }

        return $this->toJson(null, trans('api.edit_profile.error'), 0);
    }
    
    public function getUsers(Request $request)
    { 
       
        $user = User::get();

        return $this->toJson(['users' => $user],'',1);
	}


    public function userInvoiceCreate(Request $request)
    {
        $this->validate($request, [
            'userId' => 'required',
            'amount' => 'required',
        ]);
        
       
        $invoice = new Invoice();
        $invoice->fill($request->all());

        if ($invoice->save()) {

            return $this->toJson([
                'invoice' => $invoice
            ], 'invoice create successfully', 1);
        }
    }
    
    public function getUserInvoiceCreate(Request $request)
    { 
       
        $user = Invoice::where('userId',$request->userId)->get();

        return $this->toJson(['users' => $user],'',1);
	}




   
}
