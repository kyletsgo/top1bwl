@extends('admin.master')
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="pwdForm" class="form-horizontal" method="post" action="">
				{!! csrf_field() !!}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">Change Password</h4>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-lg-2 control-label">New Password:</label>
							<div class="col-lg-4">
								<input id="qpwd1" name="qpwd1" class="form-control" maxlength="20" type="password" />
								<label class="error" for="qpwd1"></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Retype Password:</label>
							<div class="col-lg-4">
								<input id="qpwd2" name="qpwd2" class="form-control" maxlength="20" type="password" />
								<label class="error" for="qpwd2"></label>
							</div>
						</div>
					</div>
					<!-- panel-body -->
					<div class="panel-footer" style="text-align:right">
						<input id="btnOK" name="btnOK" value="Submit" class="btn btn-primary btn-xs" type="submit" onclick="submitForm();" />
					</div>
					<!-- panel-footer -->
				</div>
				<!-- panel-default -->
			</form>
		</div>
	</div>
@endsection

@section('extjs')
	<script>
	//逐個偵錯
	$(function () {
		//初始化需要偵錯的表格
		$('#pwdForm').validate();
		//正規表達驗證初始化
		$.validator.addMethod(
			"regex",
			function (value, element, regexp) {
				var re = new RegExp(regexp);
				return this.optional(element) || re.test(value);
			}
		);
		//各欄位
		$('#qpwd1').rules("add", {
			required: true,
			minlength: 1,
			maxlength: 20,
			messages: {
				required: "Password length must between 1-20",
				minlength: "Password length must between 1-20",
				maxlength: "Password length must between 1-20"
			}
		});
		$('#qpwd2').rules("add", {
			required: true,
			minlength: 1,
			maxlength: 20,
			equalTo: '#qpwd1',
			messages: {
				required: "Retype length must between 1-20",
				minlength: "Retype length must between 1-20",
				maxlength: "Retype length must between 1-20",
				equalTo: "Password mismatch"
			}
		});
	});
	//提交與取消按鈕
	function submitForm() {
		if (!!($("#pwdForm").valid()) === false) {
			return false;
		} else {
			$(document).ready(function() {
				$.blockUI({ css: {
					border: 'none',
					padding: '15px',
					backgroundColor: '#000',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					opacity: .5,
					color: '#fff'
				}});
			});
		}
	}
	function cancelValidate() {
		$("#pwdForm").validate().cancelSubmit = true;
	}
	</script>
@endsection
