<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactController extends Controller
{
    public function index()
    {
    }

    public function confirm(ClientRequest $request)
    {
        $items=$request->all();
        return view('confirm',compact('items'));
    }
    public function send(Request $request)
    {
        $action = $request->input('action');
        $inputs = $request->except('action');
        if($action !== 'submit'){
            return redirect('/')
                ->withInput($inputs);
        }else{
            $data=[
                'fullname' => $inputs['family_name'].$inputs['first_name'],
                'gender' => (int)($inputs['gender']),
                'email' => $inputs['email'],
                'postcode' => $inputs['postcode'],
                'address' => $inputs['address'],
                'building_name' => $inputs['building_name'],
                'opinion' => $inputs['opinion'],
            ];
            Contact::create($data);
            return view('thanks');
        }
    }
    public function show(){
        $options = Contact::Paginate(10);
        return view('search', compact('options'));
    }
    public function search(Request $request)
    {
        $query= Contact::query();
        $searchName = $request->input('name');
        $searchGender = $request->input('gender');
        $searchStartDate = $request->input('fromDate');
        $searchEndDate = $request->input('toDate');
        $searchEmail = $request->input('email');

        if($searchGender != 0){
            $query->where('gender',$searchGender);
        }
        if(isset($searchName)){
            $query->where('fullname', 'like','%'.$searchName.'%');
        }
        if(isset($searchStartDate) && empty($searchEndDate)){
            $query->where('created_at', '>=', $searchStartDate);
        }
        if(empty($searchStartDate) && isset($searchEndDate)){
            $query->where('created_at', '<=', $searchEndDate);
        }
        if(isset($searchStartDate, $searchEndDate)){
            $query->whereBetween('created_at', [$searchStartDate, $searchEndDate]);
        }
        if(isset($searchEmail)){
            $query->where('email', 'like','%'.$searchEmail.'%');
        }

        $options = $query->paginate(10)->appends($request->except('_token'));
        $searchData=$request->except('page');

        return view('search', compact('options','searchData'));
    }
    public function remove(Request $request)
    {
        Contact::find($request->id)->delete();
        $options = Contact::Paginate(10);
        return view('search', compact('options'));
    }
}
