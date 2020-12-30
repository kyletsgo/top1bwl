<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FunMenu;
use App\FunMenuDetail;
use App\Functions;
use Redirect;
use Session;

class FunmenusDetailController extends Controller
{
    public function index($menuid)
    {
        $parentname = FunMenu::select('MenuName')->where('id', '=', $menuid)->get();
        $funmenus = FunMenuDetail::select('FunId')->where('FunMenuId', '=', $menuid)->get();
        $tables = Functions::whereIn('id', $funmenus)->get();

        return view('admin.funmenusdetail', [
            'parentname' => $parentname,
            'tables' => $tables,
            'id' => $menuid,
        ]);
    }

    public function create($menuid)
    {
        return view('admin.funmenusdetailedit', [
            'datas' => "",
            'datas2' => "",
            'id' => $menuid,
        ]);
    }

    public function edit($menuid, $id)
    {
        $datas = Functions::find($id);
        $datas2 = FunMenuDetail::select('id','Corder')->where('FunMenuId', '=', $menuid)->where('FunId', '=', $id)->get();

        return view('admin.funmenusdetailedit', [
            'datas' => $datas,
            'datas2' => $datas2[0],
            'id' => $menuid,
        ]);
    }

    public function store(Request $request, $menuid)
    {
        if ($request->mode == "insert")
        {
            $function = new Functions;
            $function->FunName = $request->FunName;
            $function->FunLink = $request->FunLink;
            $function->FunDesc = $request->FunDesc;
            $function->Valid = ($request->Valid == "on") ? 1 : 0;
            $function->Oid = $request->user()->id;
            $function->save();

            $functiondetail = new FunMenuDetail;
            $functiondetail->FunMenuId = $menuid;
            $functiondetail->FunId = $function->id;
            $functiondetail->Valid = ($request->Valid == "on") ? 1 : 0;
            $functiondetail->Corder = $request->Corder;
            $functiondetail->Oid = $request->user()->id;
            $functiondetail->save();
        }
        else
        {
            $function = Functions::find($request->id);
            $function->FunName = $request->FunName;
            $function->FunLink = $request->FunLink;
            $function->FunDesc = $request->FunDesc;
            $function->Valid = ($request->Valid == "on") ? 1 : 0;
            $function->Oid = $request->user()->id;
            $function->save();

            $functiondetail = FunMenuDetail::find($request->detailid);
            $functiondetail->Valid = ($request->Valid == "on") ? 1 : 0;
            $functiondetail->Corder = $request->Corder;
            $functiondetail->Oid = $request->user()->id;
            $functiondetail->save();
        }

        return Redirect::back();
    }

    public function delete($menuid, $id)
    {
        if ($menuid == 1)
        {
            Session::flash('msg', 'This can not be delete!!');
        }
        else
        {
            $function = Functions::find($id);
            $function->delete();

            $funmenudetail = FunMenuDetail::where('FunId', '=', $id);
            $funmenudetail->delete();
        }

        return Redirect::back();
    }
}
