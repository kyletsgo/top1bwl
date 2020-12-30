@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6">
							<div class="panel-title"><i class="fas fa-users-cog"></i>功能管理 - 選單:{{ $menu->name }}</div>
						</div>
						<div class="col-md-6" style="text-align: right">
							<a class="btn btn-default btn-xs" href="{{ asset('/backend/menu/') }}"><i class="fas fa-reply"></i><strong>返回</strong></a>
							<a class="btn btn-darkblue btn-xs" href="{{ asset('/backend/menu/' . $menu->id . '/function/create') }}"><i class="fas fa-plus"></i><strong>新增</strong></a>
						</div>
					</div>
				</div>
				<table class="table table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>名稱</th>
							<th>連結</th>
							<th>排序</th>
							<th>有無效</th>
							<th>建立時間</th>
							<th>最後修改</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($functions as $function)
							<tr>
								<td>{{ $function->id }}</td>
								<td>{{ $function->name }}</td>
								<td>{{ $function->link }}</td>
								<td>{{ $function->order }}</td>
								<td>
									<div class="nopadding nomargin checkbox checkbox-primary">
										<input type="checkbox" @if ($function->valid === 1) checked @endif disabled>
										<label></label>
									</div>
								</td>
								<td>{{ $function->created_at }}</td>
								<td>{{ $function->updated_at }}</td>
								<td style="text-align: right">
									<form method="post" action="{{ asset('/backend/menu/' . $menu->id . '/function/' . $function->id) }}">
										<a class="btn btn-success btn-xs" href="{{ asset('/backend/menu/' . $menu->id . '/function/' . $function->id) }}">
											<i class="fas fa-edit"></i><strong>編輯</strong>
										</a>
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('此動作無法回復，確認刪除?')"><i class="fas fa-trash-alt"></i><strong>刪除</strong></button>
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
