<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\StoreUpdateUser;
use App\User;
use App\Group;
use App\UserGroup;
use Auth;

class UserController extends Controller
{

    public function index($menuid)
    {
        $allusers = User::all();
        return View('admin.users.index', compact('allusers', 'menuid'));
    }


    public function create($menuid)
    {
        $allgroups = Group::all();
        $allusers = User::all();
        return View('admin.users.add', compact('allgroups', 'menuid', 'allusers'));
    }

    public function store(StoreUser $request)
    {
        $data = $request->all();
        $newUser = new User();

        $newUser->name = $data['name'];
        $newUser->managerid = $data['manager'];
        $newUser->email = $data['email'];
        $newUser->password = bcrypt($data['password']);
        if (!empty($data['logo'])) {
            $newUser['logo'] = $this->uploadquestimage($data['logo']);
        }
        $newUser->save();
        $validator = "no";
        foreach ($data['type'] as $groupid) {
            if ($groupid == 1) {
                $validator = "yes";
            }
            $newpermi = new UserGroup();
            $newpermi->group_id = $groupid;
            $newpermi->user_id = $newUser->id;
            $newpermi->save();
        }

        if ($validator == "yes") {
            $newUser->type = 1;
            $newUser->save();
        }

        return redirect()->route('user.index', $data['menuid']);
    }

    public function edit(User $user, $menuid)
    {
        $allgroups = Group::all();
        $allusers = User::all();


        $groupsids[] = 0;
        foreach ($user->groups as $usergr) {
            $groupsids[] = $usergr->group_id;
        }

        return View('admin.users.edit', compact('user', 'allgroups', 'groupsids', 'menuid', 'allusers'));

    }

    public function update(StoreUpdateUser $request, User $user)
    {
        $data = $request->all();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->managerid = $data['manager'];

        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        if (!empty($data['logo'])) {
            $user['logo'] = $this->uploadquestimage($data['logo']);
        }
        $user->save();
        UserGroup::where('user_id', '=', $user->id)->delete();
        $validator = "no";
        foreach ($data['type'] as $groupid) {
            if ($groupid == 1) {
                $validator = "yes";
            }
            $newpermi = new UserGroup();
            $newpermi->group_id = $groupid;
            $newpermi->user_id = $user->id;
            $newpermi->save();
        }

        if ($validator == "yes") {
            $user->type = 1;
            $user->save();
        }
        else {
            $user->type = 0;
            $user->save();
        }
        return redirect()->route('user.index', $data['menuid']);
    }

    public function updateprofile(StoreUpdateUser $request, User $user)
    {
        $data = $request->all();

        $user->name = $data['name'];
        $user->type = $data['type'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        foreach ($data['type'] as $groupid) {
            $newpermi = new UserGroup();
            $newpermi->group_id = $groupid;
            $newpermi->user_id = $user->id;
            $newpermi->save();
        }
        return redirect()->route('user.show');
    }

    public function updateprofilelogo(Request $request, User $user)
    {
        $data = $request->all();
        if (!empty($data['logo'])) {
            $user['logo'] = $this->uploadquestimage($data['logo']);
        }
        $user->save();
        return redirect()->route('user.show');
    }

    public function uploadquestimage($file)
    {
        $extention = $file->getClientOriginalExtension();
        $md5 = MD5($file->getClientOriginalName());
        $filename = date('D-M-Y') . "_" . $md5 . "." . $extention;
        $path = public_path('uploads/');

        $file->move($path, $filename);

        return 'uploads/' . $filename;
    }

    public function destory(User $user, $menuid)
    {
        UserGroup::where('user_id', '=', $user->id)->delete();
        $user->delete();
        return redirect()->route('user.index', $menuid);

    }

    public function show()
    {

        return View('admin.profile');

    }

    public function logout()
    {
        Auth::logout();
        return Redirect('home');
    }
}
