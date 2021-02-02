@extends('admin.master')

@section('content')
	@if (\Session::has('success'))
		<div class="alert alert-success">
			<ul>
				<li>{!! \Session::get('success') !!}</li>
			</ul>
		</div>
	@endif
<div class="row">
	<div class="col-lg-12">
		<form id="EditForm" class="form-horizontal" method="post" action="/backend/user/edit/{{ $row->id }}">
			{{ csrf_field() }}
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">修改密碼</h4>
				</div>
				<div class="panel-body">
					<div>
						<table class="table" style="border-collapse:collapse;">
							<tbody>
								<tr>
									<td class="header-require col-lg-2">名稱</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input type="text" id="nickname" name="nickname" value="{{ $row->nickname }}" maxlength="100" class="form-control">
											<label class="error" for="nickname"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="header-require col-lg-2">帳號</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input type="text" id="username" name="username" value="{{ $row->username }}" maxlength="100" class="form-control" disabled>
											<label class="error" for="username"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="header-require col-lg-2">密碼</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input type="password" id="password" name="password" value="" maxlength="60" class="form-control" placeholder="如不修改請留白">
											<label class="error" for="password"></label>
										</div>
									</td>
								</tr>
								<!-- 下控制按鈕 -->
								<tr>
									<td>&nbsp;</td>
									<td>
										<div style="text-align: right">
											<input type="submit" value="修改" class="btn btn-primary btn-xs" onclick="submitForm();">
											<a class="btn btn-xs btn-default" href="/backend/user">返回</a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- panel-body -->
			</div>
		</form>
	</div>
</div>
@endsection

@section('extjs')
<script>
	$(function()
	{
		jqueryValidation();
	});

	function jqueryValidation() {
		$('#EditForm').validate();

		$.validator.addMethod(
				"regex",
				function (value, element, regexp)
				{
					var re = new RegExp(regexp);
					return this.optional(element) || re.test(value);
				}
		);

		$('#nickname').rules("add", {
			maxlength: 100,
			messages: {
				maxlength: "最長 100 個字"
			}
		});

		$('#password').rules("add", {
			maxlength: 60,
			messages: {
				maxlength: "最長 60 個字"
			}
		});
	}

	function submitForm() {
		if ($("#EditForm").valid() === false) {
			return false;
		}

		$.blockUI({ css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .5,
				color: '#fff'
			}});
	}
</script>
@endsection