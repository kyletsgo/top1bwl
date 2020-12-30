@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="/backend/user/create">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">新增會員</h4>
					</div>
					<div class="panel-body">
						<div>
							<table class="table" style="border-collapse:collapse;">
								<tbody>
									<tr>
										<td class="header-require col-lg-2">名稱</td>
										<td>
											<div class="col-lg-3 nopadding">
												<input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" maxlength="100" class="form-control">
												<label class="error" for="nickname"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">帳號</td>
										<td>
											<div class="col-lg-3 nopadding">
												<input type="text" id="username" name="username" value="{{ old('username') }}" maxlength="100" class="form-control">
												<label class="error" for="username"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">密碼</td>
										<td>
											<div class="col-lg-3 nopadding">
												<input type="password" id="password" name="password" value="" maxlength="60" class="form-control">
												<label class="error" for="password"></label>
											</div>
										</td>
									</tr>
									<!-- 下控制按鈕 -->
									<tr>
										<td>&nbsp;</td>
										<td>
											<div style="text-align: right">
												<input type="submit" value="新增" class="btn btn-primary btn-xs" onclick="submitForm();">
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

			$('#username').rules("add", {
				required: true,
				maxlength: 100,
				messages: {
					required: "此欄位必填",
					maxlength: "最長 100 個字"
				}
			});

			$('#password').rules("add", {
				required: true,
				maxlength: 60,
				messages: {
					required: "此欄位必填",
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
