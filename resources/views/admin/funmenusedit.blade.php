@extends('admin.master')

@section('content')
    {{! $mode = ($datas == "") ? "insert" : "modify" }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ ($mode == "insert") ? "Create " : "Modify " }}Functions Menu</h4>
                </div>
                <form method="post" action="{{ asset('/backend/Funmenus/store') }}">
                <div class="panel-body">
                        {{ csrf_field() }}
                        @if ($mode == "insert")
                            <input type="hidden" name="mode" value="insert">
                        @else
                            <input type="hidden" name="mode" value="modify">
                            <input type="hidden" name="id" value="{{ $datas->id }}">
                        @endif
                        <div class="form-group">
                            <label class="col-md-2 control-label">Menu Icon Class Name:</label>
                            <div class="col-md-3">
                                @if ($mode == "insert")
                                    <input id="icon" name="icon" class="form-control" maxlength="20" type="text" />
                                @else
                                    <input id="icon" name="icon" class="form-control" maxlength="20" type="text" value="{{ $datas->icon }}" />
                                @endif
                                <label class="error" for="icon"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Menu Name:</label>
                            <div class="col-md-3">
                                @if ($mode == "insert")
                                    <input id="MenuName" name="MenuName" class="form-control" maxlength="20" type="text" />
                                @else
                                    <input id="MenuName" name="MenuName" class="form-control" maxlength="20" type="text" value="{{ $datas->MenuName }}" />
                                @endif
                                <label class="error" for="MenuName"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Valid:</label>
                            <div class="col-md-3">
                                @if ($mode == "insert")
                                    <input type="checkbox" name="Valid">
                                @else
                                    <input type="checkbox" name="Valid" {{ ($datas->Valid == 1) ? "checked" : "" }}>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Orders:</label>
                            <div class="col-md-1">
                                @if ($mode == "insert")
                                    <input id="Corder" name="Corder" class="form-control" type="number" />
                                @else
                                    <input id="Corder" name="Corder" class="form-control" type="number" value="{{ $datas->Corder }}" />
                                @endif
                            </div>
                        </div>

                </div>
                <!-- panel-body -->
                <div class="panel-footer" style="text-align:right">
                    <a class="btn btn-xs btn-default" href="{{ asset('/backend/Funmenus') }}">Back</a>
                    <input id="btnOK" name="btnOK" value="Submit" class="btn btn-primary btn-xs" type="submit" />
                </div>
                </form>
                <!-- panel-footer -->
            </div>
        </div>
    </div>
@endsection
