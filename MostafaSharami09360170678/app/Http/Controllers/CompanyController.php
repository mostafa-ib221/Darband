<?php

namespace App\Http\Controllers;

use App\Models\CoCat;
use App\Models\Company;
use App\Models\Msgcat;
use Illuminate\Http\Request;

class CompanyController extends Controller {
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
        $data['title'] = 'شرکت';
        $data['cats'] = CoCat::all();
        $data['companies'] = Company::with('Cat')->get();
        //return $data;
        return view('content.customer.company_form', $data);
    }

    public function save(Request $request, Company $company) {
        //return $request;
        if($company->id == null) {$company = new Company();}

        $company->cat = $request->cat;
        $company->title = $request->title;
        $company->des = ($request->des == null) ? '' : $request->des;
        $company->save();
        if(isset($company->id)) {
            Msgcat::create([
                'user' => '20000-' . $company->id,
                'title' => 'شرکت ' . $company->title,
                'unread_admin' => 0,
                'unread_customer' => 0,
            ]);
        }
        return Back();
    }

    public function delete($company) {
        $company = Company::where('id', $company)->with('Customer')->first();
        //return $company;
        //return count($CoCat->Co);
        //return empty($CoCat) ? 'empty' : 'full';;
        //return $CoCat->Co == [] ? 'empty' : 'full';
        if(!empty($company))
            if(count($company->Customer) == 0)
                $company->delete();
        return Back();
    }
}
