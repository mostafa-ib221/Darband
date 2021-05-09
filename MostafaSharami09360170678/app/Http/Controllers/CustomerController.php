<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\customer\CustomerLoginRequest;
use App\Models\CoCat;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Msgcat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only(['form', 'save', 'delete']);
    }

    public function form() {
        $data['locate'] = 'Company';
        $data['title'] = 'مشتری';
        $data['cats'] = CoCat::all();
        $data['companies'] = Company::with('Cat')->get();
        $data['customers'] = Customer::with(['User', 'Co'])->get();
        //return $data['customers'];
        return view('content.customer.customer_form', $data);
    }

    public function save(Request $request, Customer $customer) {
        //return $request;
        $user = [];
        if($customer->id == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_admin' => false,

            ]);
            //return $user;
            $customer = new Customer();
        } else {
            // edit user
        }

        $customer->co = $request->co;
        $customer->user = $user->id;
        $customer->mobile = $request->mobile;
        $customer->birthday = $request->birthday;
        $customer->save();
        if(isset($customer->id)) {
            Msgcat::create([
                'user' => $user->id,
                'title' => 'خوش آمدید'
            ]);
        }
        return Back();
    }

    public function delete(Customer $customer) {
        $user = User::find($customer->user);
        //return [$customer, $user];
        if($user->delete()) $customer->delete();
        return Back();
    }

    public function login(CustomerLoginRequest $request) {
        $ret = [
            'status' => false,
            'message' => 'شماره موبایل یا گذرواژه صحیح نیست',
            'data' => isset($request->os) ? ['error'=>'not fond'] : []
        ];
        //return 'A65';
        $customer = Customer::where('mobile', $request->mobile)->with('user')->first();
        if (isset($request->trace)) return ['A68', $customer];
        if($customer !== null) {
            //$ret = $c;
            $credentials = ['email' => $customer->User->email, 'password' => $request->password];
            if (Auth::attempt($credentials)) {
                $ret = [
                    'status' => true,
                    'message' => 'ورود موفقیت آمیز بود',
                    'data' => [
                        'name' => $customer->User->name,
                        'mobile' => $customer->mobile,
                        'email' => $customer->User->email,
                        'token' => $customer->User->createToken('create')->accessToken
                    ]
                ];
            }
        }
        return $ret;//json_encode($ret);
    }
}
