@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-dark">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-title">Manage Functions</div>
                            <p><span class="fa fa-angle-right"></span>&nbsp;&nbsp;&nbsp;{{ $parentname[0]["MenuName"] }}</p>
                        </div>
                        <div class="col-md-6" style="text-align: right">
                            <a class="btn btn-default btn-xs" href="{{ asset('/backend/Funmenus/') }}"><strong>Back</strong></a>
                            &nbsp;
                            <a class="btn btn-darkblue btn-xs" href="{{ asset('/backend/Funmenus/'.$id.'/create') }}"><strong>Add</strong></a>
                        </div>
                    </div>
                </div>
                <table class="table table-hover table-primary">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Function Name</td>
                            <td>Function Link</td>
                            <td>Function Description</td>
                            <td>Valid</td>
                            <td>Create Time</td>
                            <td>Modify Time</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tables as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->FunName }}</td>
                                <td>{{ $data->FunLink }}</td>
                                <td>{{ $data->FunDesc }}</td>
                                <td>
                                    <input type="checkbox" disabled {{ ($data->Valid == 1) ? "checked" : "" }}>
                                </td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->updated_at }}</td>
                                <td style="text-align: right">
                                    <form method="post" action="{{ asset('/backend/Funmenus/'.$id.'/delete/'.$data->id) }}">
                                        <a class="btn btn-xs btn-success" href="{{ asset('/backend/Funmenus/'.$id.'/edit/'.$data->id) }}">Edit</a>
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs"><strong>Delete</strong></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
