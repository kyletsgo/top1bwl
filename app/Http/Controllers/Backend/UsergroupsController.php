<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\FunMenu;
use App\FunUserGroups;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;

class UsergroupsController extends Controller
{
    public function index()
    {
        $tables = FunUserGroups::all();

        return view('admin.usergroups', [
            'tables' => $tables,
        ]);
    }

    public function delete(Request $request, FunUserGroups $id)
    {
        if($id->id == 1)
        {
            return Redirect::back()->withErrors("Admin group can not be delete!");
        }
        else
        {
            $id->delete();
        }
        return Redirect::back();
    }

    public function create(Request $request)
    {
        $user_name = $request->user()->name;
        $user_id = $request->user()->id;

        $funmenu = new FunMenu;
        $result = $funmenu->leftmenu($user_id);

        $usergroup = new FunUserGroups;
        $seleted_usrlist = $usergroup->selectedUsrList(9999);
        $unseleted_usrlist = $usergroup->unseletedUsrList(9999);
        $seleted_funlist = $usergroup->seletedFunList(9999);
        $unseleted_funlist = $usergroup->unseletedFunList(9999);

        return view('admin.usergroupsedit', [
            'leftmenu' => $result,
            'username' => $user_name,
            'seleted_usrlist' => $seleted_usrlist,
            'unseleted_usrlist' => $unseleted_usrlist,
            'seleted_funlist' => $seleted_funlist,
            'unseleted_funlist' => $unseleted_funlist,
            'operdata' => "",

        ]);
    }

    public function edit(Request $request, $id)
    {
        $user_name = $request->user()->name;
        $user_id = $request->user()->id;
        $fun_id = $id;

        $funmenu = new FunMenu;
        $result = $funmenu->leftmenu($user_id);

        $usergroup = new FunUserGroups;
        $seleted_usrlist = $usergroup->selectedUsrList($fun_id);
        $unseleted_usrlist = $usergroup->unseletedUsrList($fun_id);
        $seleted_funlist = $usergroup->seletedFunList($fun_id);
        $unseleted_funlist = $usergroup->unseletedFunList($fun_id);
        $operdata = $usergroup->operData($fun_id);

        return view('admin.usergroupsedit', [
            'leftmenu' => $result,
            'username' => $user_name,
            'seleted_usrlist' => $seleted_usrlist,
            'unseleted_usrlist' => $unseleted_usrlist,
            'seleted_funlist' => $seleted_funlist,
            'unseleted_funlist' => $unseleted_funlist,
            'operdata' => $operdata,

        ]);
    }

    public function store(Request $request)
    {
        if ($request->mode == "insert")
        {
            $usergroup = new FunUserGroups;
            $usergroup->Name = $request->Name;
            $usergroup->FunList = $request->hidfunlist;
            $usergroup->UsrList = $request->hidusrlist;
            $usergroup->Valid = ($request->Valid == "on") ? 1 : 0;
            $usergroup->Oid = $request->user()->id;
            $usergroup->save();

            return redirect('/backend/Usergroups');
        }
        else
        {
            $usergroup = FunUserGroups::find($request->id);
            $usergroup->Name = $request->Name;
            $usergroup->FunList = $request->hidfunlist;
            $usergroup->UsrList = $request->hidusrlist;
            $usergroup->Valid = ($request->Valid == "on") ? 1 : 0;
            $usergroup->Oid = $request->user()->id;
            $usergroup->save();

            return redirect('/backend/Usergroups');
        }
    }
}
