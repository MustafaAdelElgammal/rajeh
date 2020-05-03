<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;
use Alert;
use function Sodium\add;


class UserController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->except('image','password');

        if ($request->hasFile('image')) {
            $input['image'] = saveImage($request->image, 'users');
        }
        if($request->has('password')){
            $input['password']  = Hash::make($request->password);
        }
        $user= User::create($input);
        return redirect(route('users.index'));


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
        $user = User::findorfail($id);
        return view('admin.users.edit',compact('user'));

    }

    public function update(UserRequest $request, User $user)
    {
        $input = $request->except('image','password');
        if ($request->hasFile('image')) {
            $image = saveImage($request->image, 'users');
            $input['image'] = $image;
        }

        if($request->has('password') && !empty($request->password)){
            $input['password']  = Hash::make($request->password);
        }

        $user = $user->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect(route('users.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Deleted', 'Your User has been deleted.');
        return redirect()->route('users.index');
    }
    public function archive()
    {
        return view('admin.users.archive', ['users' => User::onlyTrashed()->get()]);
    }

    public function restore($id)
    {
        $users = User::onlyTrashed()->where('id', $id)->restore();
        alert()->success('success');
        return back();
    }
    public function destroyFinal($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        if ($user)
        {
            $user->forceDelete();
            alert()->success('success');
            return back();
        }
        alert()->error('success');
        return back();
    }
}
