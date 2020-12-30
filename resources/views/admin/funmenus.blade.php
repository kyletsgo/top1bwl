@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-dark">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-title">Manage Functions</div>
                        </div>
                        <div class="col-md-6" style="text-align: right">
                            <a class="btn btn-darkblue btn-xs" href="{{ asset('backend/Funmenus/create') }}"><strong>Add</strong></a>
                        </div>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Icon</td>
                            <td>Menu Name</td>
                            <td>Valid</td>
                            <td>Orders</td>
                            <td>Create Time</td>
                            <td>Modify Time</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tables as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td><i class='{{ $data->icon }}'></i></td>
                                <td>{{ $data->MenuName }}</td>
                                <td>
                                    <input type="checkbox" disabled {{ ($data->Valid == 1) ? "checked" : "" }}>
                                </td>
                                <td>{{ $data->Corder }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->updated_at }}</td>
                                <td style="text-align: right">
                                    <form method="post" action="{{ asset('/backend/Funmenus/delete/'.$data->id) }}">
                                        <a class="btn btn-xs btn-primary" href="{{ asset('/backend/Funmenus/'.$data->id) }}">Details</a>
                                        <a class="btn btn-xs btn-success" href="{{ asset('/backend/Funmenus/edit/'.$data->id) }}">Edit</a>
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
