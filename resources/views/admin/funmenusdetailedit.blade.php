@extends('admin.master')

@section('content')
    {{! $mode = ($datas == "") ? "insert" : "modify" }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ ($mode == "insert") ? "Create " : "Modify " }}Function</h4>
                </div>
                <form method="post" action="{{ asset('/backend/Funmenus/'.$id.'/store') }}">
                    <div class="panel-body">
                        {{ csrf_field() }}
                        @if ($mode == "insert")
                            <input type="hidden" name="mode" value="insert">
                        @else
                            <input type="hidden" name="mode" value="modify">
                            <input type="hidden" name="id" value="{{ $datas->id }}">
                            <input type="hidden" name="detailid" value="{{ $datas2->id }}">
                        @endif
                        <div class="form-group">
                            <label class="col-md-2 control-label">Function Name:</label>
                            <div class="col-md-3">
                                @if ($mode == "insert")
                                    <input id="FunName" name="FunName" class="form-control" maxlength="20" type="text" />
                                @else
                                    <input id="FunName" name="FunName" class="form-control" maxlength="20" type="text" value="{{ $datas->FunName }}" />
                                @endif
                                <label class="error" for="FunName"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Function Link<br />(Route or Controller Name):</label>
                            <div class="col-md-3">
                                @if ($mode == "insert")
                                    <input id="FunLink" name="FunLink" class="form-control" maxlength="20" type="text" />
                                @else
                                    <input id="FunLink" name="FunLink" class="form-control" maxlength="20" type="text" value="{{ $datas->FunLink }}" />
                                @endif
                                <label class="error" for="FunLink"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Function Description:</label>
                            <div class="col-md-3">
                                @if ($mode == "insert")
                                    <input id="FunDesc" name="FunDesc" class="form-control" maxlength="20" type="text" />
                                @else
                                    <input id="FunDesc" name="FunDesc" class="form-control" maxlength="20" type="text" value="{{ $datas->FunDesc }}" />
                                @endif
                                <label class="error" for="FunLink"></label>
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
                                    <input id="Corder" name="Corder" class="form-control" type="number" value="{{ $datas2->Corder }}" />
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- panel-body -->
                    <div class="panel-footer" style="text-align:right">
                        <a class="btn btn-xs btn-default" href="{{ asset('/backend/Funmenus/'.$id) }}">Back</a>
                        <input id="btnOK" name="btnOK" value="Submit" class="btn btn-primary btn-xs" type="submit" />
                    </div>
                </form>
                <!-- panel-footer -->
            </div>
        </div>
    </div>
@endsection
