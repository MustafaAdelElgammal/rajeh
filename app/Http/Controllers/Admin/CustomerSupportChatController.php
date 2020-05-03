<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustmorSupport;

class CustomerSupportChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = \Auth::id();
        $chats = CustmorSupport::orderBy('created_at', 'desc')->get();
        $chats = $chats->groupBy('parent_id');
        $msg =[];

        foreach ($chats as $index=>$value){
            $msg[]=$value[0];
        }


        $chat_from = CustmorSupport::where('from_id' ,$id)->get();
        $chat_to = CustmorSupport::where('to_id',\Auth::id())->get();
        return view('admin.customer_support.index', compact( 'msg', 'chats', 'chat_from', 'chat_to'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id','!=',\Auth::id())->pluck('name', 'id');
        $clients = Client::where('id','!=',\Auth::id())->pluck('name', 'id');
        $comments = CustmorSupport::all();
        return view('admin.customer_support.create', compact('comments','users', 'clients' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests = $request->all();
        $requests['parent_id'] = $requests['to_id'];

        $comment = CustmorSupport::create($requests);
        $parent_id = $requests['parent_id'] ;
        $comments = CustmorSupport::where('parent_id', $parent_id)->get();
        return redirect()->route('customer-support.show', $comment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user_id =  \Auth::id();
        $comments = CustmorSupport::where('id', $id)->first();
        $to_id = $comments->to_id;
        $comments = CustmorSupport::where('parent_id', $comments->parent_id)->get();
        return view('admin.customer_support.single_order',compact('comments', 'to_id'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
