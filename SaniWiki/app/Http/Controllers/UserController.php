<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::all();
        return view('users', ['users' => $users]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->accessGroup = $request->get('accessGroup');
        $user->save();
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')->where('id', $id)->get()->first();
        return view('changePassword', ['user' => $user]);
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
    public function update($id, Request $request)
    {
        $editUser = User::find($request->userEdit_id);
        $editUser->name = $request->userEdit_name;
        $editUser->email = $request->userEdit_email;
        $editUser->password = bcrypt($request->userEdit_password);
        $editUser->accessGroup = $request->userEdit_group;
        $editUser->save();
        return back()->with('status', 'Utente Modificato!');
    }

    public function changePassword($id, Request $request)
    {
        $editUser = User::where('id', $id)->first();
        $editUser->password = bcrypt($request->p1);
        $editUser->save();
        return back()->with('status', 'Password Modificata!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->delete();
        return back()->with('status', 'Utente Eliminato!');
    }
}