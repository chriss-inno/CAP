<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Audit;
use App\UserRights;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    //Show profile
    public function showProfile()
    {
        return view('users.profile');
    }
    //Show logout
    public function showLogout()
    {
        if (Auth::check())
        {
            $user= \App\User::find(Auth::user()->id);
            $user->last_logout=date("Y-m-d h:i:s");
            $user->save();
        }

        Auth::logout();
        return view('users.login');
    }


    //Process how to to login
    public function showLogin()
    {
        if (Auth::check())
        {
            // The user is logged in...
            return view('users.dashboard');
        }
        else
        {
            return view('users.login');
        }

    }
    //Show home page with dashboard
    public function showHome()
    {
       return view('users.dashboard');
    }

    //Process login
    public function processLogin(UserLoginRequest $request)
    {
        $username=$request->username;
        $password=$request->password;

        if (Auth::attempt(['username' => $username, 'password' => $password]))
        {
            if(Auth::user()->block ==1)
            {
                Auth::logout();
                return redirect()->back()->with('message', 'Login Failed you don\'t have Access to login please  Contact Administrator');
            }
            else
            {
                $user= \App\User::find(Auth::user()->id);
                $user->last_login=date("Y-m-d h:i:s");
                $user->save();

                return redirect()->intended('home');
            }

        }
        else
        {
            return redirect()->back()->with('message', 'Login Failed,Invalid username or password');
        }
    }

	public function index()
	{
		//
        $users= \App\User::all();

        return view('users.manage',compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('users.create');

	}
    public function manage()
    {
        //
        return view('users.manage');

    }

    //User Access
    public function access()
    {
        //

    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{
		//

        if($request->password_repeat !=$request->password)
         {
                return redirect()->back();
         }
        $user=new \App\User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);

        $user->save();

        //Process Access rights
        if($request->credit_module !="")
        {

            $create=0;
            $delete=0;
            $view=0;
            $update=0;
            $authorizer=0;
            if($request->credit_create !="")
            {
                $create=1;
            }
            if($request->credit_view !="")
            {
                $view=1;
            }
            if($request->credit_update !="")
            {
                $update=1;
            }
            if($request->credit_dele !="")
            {
                $delete=1;
            }
            if($request->credit_authorizer !="")
            {
                $authorizer=1;
            }

            $usa=new UserRights;
            $usa->user_id=$user->id;
            $usa->cr=$create;
            $usa->edit=$update;
            $usa->dl=$delete;
            $usa->vw=$view;
            $usa->authorize=$authorizer;
            $usa->modulecode=$request->credit_module;

            $usa->save();

        }
        if($request->settings_module !="")
        {
            $create=0;
            $delete=0;
            $view=0;
            $update=0;
            $authorizer=0;
            if($request->settings_create !="")
            {
                $create=1;
            }
            if($request->settings_view !="")
            {
                $view=1;
            }
            if($request->settings_update !="")
            {
                $update=1;
            }
            if($request->settings_dele !="")
            {
                $delete=1;
            }
            if($request->settings_authorizer !="")
            {
                $authorizer=1;
            }

            $usa=new UserRights;
            $usa->user_id=$user->id;
            $usa->cr=$create;
            $usa->edit=$update;
            $usa->dl=$delete;
            $usa->vw=$view;
            $usa->authorize=$authorizer;
            $usa->modulecode=$request->settings_module;

            $usa->save();

        }
        if($request->reports_module !="")
        {
            $create=0;
            $delete=0;
            $view=0;
            $update=0;
            $authorizer=0;
            if($request->reports_create !="")
            {
                $create=1;
            }
            if($request->reports_view !="")
            {
                $view=1;
            }
            if($request->reports_update !="")
            {
                $update=1;
            }
            if($request->reports_dele !="")
            {
                $delete=1;
            }
            if($request->reports_authorizer !="")
            {
                $authorizer=1;
            }

            $usa=new UserRights;
            $usa->user_id=$user->id;
            $usa->cr=$create;
            $usa->edit=$update;
            $usa->dl=$delete;
            $usa->vw=$view;
            $usa->authorize=$authorizer;
            $usa->modulecode=$request->reports_module;

            $usa->save();

        }
        //Process Audits

        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="User Management";
        $audit->action="Creating new  user with Username [".$user->username."] Email [".$user->email."] User Id [".$user->id."]" ;
        $audit->save();
        return redirect('users');
	}

    public function changepass(ProfileRequest $request)
    {

        return redirect('profile');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit ($id)
	{
		//
        $user= \App\User::find($id);
      return view('users.edit',compact('user'));
	}
    public function update(UserEditRequest $request)
    {
        //
        if($request->password !="")
        {
            if($request->password_repeat !=$request->password)
            {
              return redirect()->back()->with('message','Password match');
            }
        }

        $user= \App\User::find($request->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;

        if($request->password !="")
        {
            $user->password = bcrypt($request->password);
        }



        $user->save();

        $rights=\App\UserRights::where('user_id','=',$user->id)->delete();

        //Process Access rights
        if($request->credit_module !="")
        {

            $create=0;
            $delete=0;
            $view=0;
            $update=0;
            $authorizer=0;
            if($request->credit_create !="")
            {
                $create=1;
            }
            if($request->credit_view !="")
            {
                $view=1;
            }
            if($request->credit_update !="")
            {
                $update=1;
            }
            if($request->credit_dele !="")
            {
                $delete=1;
            }
            if($request->credit_authorizer !="")
            {
                $authorizer=1;
            }

            $usa=new UserRights;
            $usa->user_id=$user->id;
            $usa->cr=$create;
            $usa->edit=$update;
            $usa->dl=$delete;
            $usa->vw=$view;
            $usa->authorize=$authorizer;
            $usa->modulecode=$request->credit_module;

            $usa->save();

        }
        if($request->settings_module !="")
        {
            $create=0;
            $delete=0;
            $view=0;
            $update=0;
            $authorizer=0;
            if($request->settings_create !="")
            {
                $create=1;
            }
            if($request->settings_view !="")
            {
                $view=1;
            }
            if($request->settings_update !="")
            {
                $update=1;
            }
            if($request->settings_dele !="")
            {
                $delete=1;
            }
            if($request->settings_authorizer !="")
            {
                $authorizer=1;
            }

            //Process Audits
            $usa=new UserRights;
            $usa->user_id=$user->id;
            $usa->cr=$create;
            $usa->edit=$update;
            $usa->dl=$delete;
            $usa->vw=$view;
            $usa->authorize=$authorizer;
            $usa->modulecode=$request->settings_module;

            $usa->save();

        }
        if($request->reports_module !="")
        {
            $create=0;
            $delete=0;
            $view=0;
            $update=0;
            $authorizer=0;
            if($request->reports_create !="")
            {
                $create=1;
            }
            if($request->reports_view !="")
            {
                $view=1;
            }
            if($request->reports_update !="")
            {
                $update=1;
            }
            if($request->reports_dele !="")
            {
                $delete=1;
            }
            if($request->reports_authorizer !="")
            {
                $authorizer=1;
            }

            $usa=new UserRights;
            $usa->user_id=$user->id;
            $usa->cr=$create;
            $usa->edit=$update;
            $usa->dl=$delete;
            $usa->vw=$view;
            $usa->authorize=$authorizer;
            $usa->modulecode=$request->reports_module;

            $usa->save();

        }

        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="User Management";
        $audit->action="Updated  user with Username [".$user->username."] Email [".$user->email."] User Id [".$user->id."]" ;
        $audit->save();
        return redirect('users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $user= \App\User::find($id);;
        $rights=\App\UserRights::where('user_id','=',$user->id)->delete();

        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="User Management";
        $audit->action="Deleted   user with Username [".$user->username."] Email [".$user->email."] User Id [".$user->id."]" ;
        $audit->save();

        $user->delete();

        return redirect('users');
	}
   //Method check user right
    public static function checkViewAccess($user_id,$module,$right)
    {
        $usr=UserRights::where('user_id','=',$user_id)->where('modulecode','=',$module)->where('vw','=',$right)->get();
        if(count($usr)>0) {
            return true;} else {return false;}
    }
    public static function checkReportAccess($user_id,$module,$right)
    {
        $usr=UserRights::where('user_id','=',$user_id)->where('modulecode','=',$module)->where('vw','=',$right)->get();
        if(count($usr)>0) {
            return true;} else {return false;}
    }
    //create Access
    public static function checkCreateAccess($user_id,$module,$right)
    {
        $usr=UserRights::where('user_id','=',$user_id)->where('modulecode','=',$module)->where('cr','=',$right)->get();
        if(count($usr)>0) {
            return true;} else {return false;}
    }
    //Delete Access
    public static function checkDeleteAccess($user_id,$module,$right)
    {
        $usr=UserRights::where('user_id','=',$user_id)->where('modulecode','=',$module)->where('dl','=',$right)->get();
        if(count($usr)>0) {
            return true;} else {return false;}
    }
    //Authorize Access
    public static function checkAuthorizeAccess($user_id,$module,$right)
    {
        $usr=UserRights::where('user_id','=',$user_id)->where('modulecode','=',$module)->where('authorize','=',$right)->get();
        if(count($usr)>0) {
            return true;} else {return false;}
    }
    //Update Access
    public static function checkUpdateAccess($user_id,$module,$right)
    {
        $usr=UserRights::where('user_id','=',$user_id)->where('modulecode','=',$module)->where('edit','=',$right)->get();
        if(count($usr)>0) {
            return true;} else {return false;}
    }

}
