<!DOCTYPE html>
<html lang="en">
	<head>
		@include('admin.uc.head')
	</head>
	<body class="signin">
		<section>
			<div class="signinpanel">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<form id="mainForm" method="post" action="login">
                            {!! csrf_field() !!}
							<h4 class="nomargin"><?php echo env('APP_NAME')?></h4>

							<input id="username" name="username" placeholder="帳號" class="form-control uname" maxlength="100" type="text" />
							<label class="error" for="username"></label>

							<input id="password" name="password" placeholder="密碼" class="form-control pword" maxlength="100" type="password" />
							<label class="error" for="password"></label>

							<input value="登入" class="btn btn-block btn-success" type="submit" onclick="submitForm();" />
						</form>
					</div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</section>

		@include('admin.uc.foot')

		<script>
			$(function () {
				$('#mainForm').validate();
				$.validator.addMethod(
					"regex",
					function (value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					}
				);
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
					maxlength: 100,
					messages: {
						required: "此欄位必填",
						maxlength: "最長 100 個字"
					}
				});
			});

			function submitForm() {
				if (!!($("#mainForm").valid()) === false) {
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
				$("#mainForm").validate().cancelSubmit = true;
			}
		</script>
	</body>
</html>
