<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserContacts;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = UserContacts::where('user_id', $request->user_id)->get();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /* $res = UserContacts::create([
            'name' => $request['name'],
            'contact_no' => $request['contact_no'],
            'address' => 'address',
            'user_id' => $request['user_id'],
        ]); */

        $contact = new UserContacts;
        $contact->name = $request->name;
        $contact->contact_no = $request->contact_no;
        $contact->address = $request->address;
        $contact->user_id = $request->user_id;

        $res = $contact->save();

        if($res){
            $result = [
                'error' => 0,
                'message' => 'Your successfull created new contact.',
                'data' => $res
            ];
        }else{
            $result = [
                'error' => 1,
                'message' => "Sorry, your not able to create new contact now. Try again later"
            ];
        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        $contact = UserContacts::find($request->id);
        $contact->name = $request->name;
        $contact->contact_no = $request->contact_no;
        $contact->address = $request->address;
        $contact->user_id = $request->user_id;

        $res = $contact->save();

        if($res){
            $result = [
                'error' => 0,
                'message' => 'Your successfull updated contact.',
                'data' => $res
            ];
        }else{
            $result = [
                'error' => 1,
                'message' => "Sorry, your not able to update the contact for now. Try again later"
            ];
        }

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contact = UserContacts::find($request->id);
        $res = $contact->delete();

        if($res){
            $result = [
                'error' => 0,
                'message' => 'Your successfull deleted contact.',
                'data' => $res
            ];
        }else{
            $result = [
                'error' => 1,
                'message' => "Sorry, your not able to deleted the contact for now. Try again later"
            ];
        }

        return response()->json($result);
    }

    public function getcontactbyid(Request $request){
        $contactDetails = UserContacts::find($request->id);
        $res = $contactDetails;

        if($res){
            $result = [
                'error' => 0,
                'message' => 'success',
                'data' => $res
            ];
        }else{
            $result = [
                'error' => 1,
                'message' => "danger"
            ];
        }

        return response()->json($result);
    }
}
