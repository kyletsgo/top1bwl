@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6">
							<div class="panel-title"><i class="fas fa-users-cog"></i>選單管理</div>
						</div>
						<div class="col-md-6" style="text-align: right">
							<a class="btn btn-darkblue btn-xs" href="{{ asset('/backend/menu/create') }}"><i class="fas fa-plus"></i><strong>新增</strong></a>
						</div>
					</div>
				</div>
				<table class="table table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>圖示</th>
							<th>名稱</th>
							<th>排序</th>
							<th>有無效</th>
							<th>建立時間</th>
							<th>最後修改</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($menus as $menu)
							<tr>
								<td>{{ $menu->id }}</td>
								<td>{{ $menu->icon }}</td>
								<td>{{ $menu->name }}</td>
								<td>{{ $menu->order }}</td>
								<td>
									<div class="nopadding nomargin checkbox checkbox-primary">
										<input type="checkbox" @if ($menu->valid === 1) checked @endif disabled>
										<label></label>
									</div>
								</td>
								<td>{{ $menu->created_at }}</td>
								<td>{{ $menu->updated_at }}</td>
								<td style="text-align: right">
									<form method="post" action="{{ asset('/backend/menu/' . $menu->id) }}">
										<a class="btn btn-success btn-xs" href="{{ asset('/backend/menu/' . $menu->id) }}">
											<i class="fas fa-edit"></i><strong>編輯</strong>
										</a>
										<a class="btn btn-primary btn-xs" href="{{ asset('/backend/menu/' . $menu->id . '/function') }}">
											<i class="fas fa-edit"></i><strong>編輯子選單/功能</strong>
										</a>
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('此動作會連帶刪除此選單底下的子功能，確認刪除?')"><i class="fas fa-trash-alt"></i><strong>刪除</strong></button>
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
