<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FunMenu;
use App\FunMenuDetail;
use Redirect;
use Session;
use Validator;

class FunmenusController extends Controller
{
    public function index()
    {
        $tables = FunMenu::All();

        return view('admin.funmenus', [
            'tables' => $tables,
        ]);
    }

    public function create()
    {
        return view('admin.funmenusedit', [
            'datas' => "",
        ]);
    }

    public function edit($id)
    {
        $datas = FunMenu::find($id);
        return view('admin.funmenusedit', [
            'datas' => $datas,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'MenuName' => 'required|max:255',
            'Corder' => 'required'

        ]);
        if ($validator->fails()) {
            return Redirect::back()
            ->withErrors($validator);
        }
        else
        {
            if ($request->mode == "insert")
            {
                $funmenu = new FunMenu;
                $funmenu->icon = $request->icon;
                $funmenu->MenuName = $request->MenuName;
                $funmenu->Valid = ($request->Valid == "on") ? 1 : 0;
                $funmenu->Corder = $request->Corder;
                $funmenu->Oid = $request->user()->id;
                $funmenu->save();
            }
            else
            {
                $funmenu = FunMenu::find($request->id);
                $funmenu->icon = $request->icon;
                $funmenu->MenuName = $request->MenuName;
                $funmenu->Valid = ($request->Valid == "on") ? 1 : 0;
                $funmenu->Corder = $request->Corder;
                $funmenu->Oid = $request->user()->id;
                $funmenu->save();
            }
        }

        return Redirect::back();
    }

    public function delete($id)
    {
        if ($id == 1)
        {
            Session::flash('msg', 'This can not be delete!!');
        }
        else
        {
            $funmenudetails = FunMenuDetail::where('FunMenuId', '=', $id);

            if ($funmenudetails->count() > 0)
            {
                Session::flash('msg', 'Must delete functions first!!');
            }
            else
            {
                $funmenu = FunMenu::find($id);
                $funmenu->delete();


                $funmenudetails->delete();
            }
        }

        return Redirect::back();
    }
}
