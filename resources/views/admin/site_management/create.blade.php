@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="{{ asset('/backend/redeem_task/create') }}">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">新增任務</h4>
					</div>
					<div class="panel-body">
						<div>
							<table class="table" cellspacing="0" id="DetailsView1" style="border-collapse:collapse;">
								<tbody>							
									<tr>
										<td class="header-require col-lg-2"><span style="color:red">*</span>名稱</td>
										<td>
											<div class="col-lg-4 nopadding">											
												<input type="text" name="task_name" value="{{ old('task_name')}}" maxlength="80" id="task_name" class="form-control">
												<label class="error" for="task_name"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">說明</td>
										<td>
											<div class="col-lg-4 nopadding">											
												<input type="text" name="task_description" value="{{ old('task_description')}}" maxlength="200" id="task_description" class="form-control">
												<label class="error" for="task_description"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2"><span style="color:red">*</span>任務ID</td>
										<td>
											<div class="col-lg-4 nopadding">
												<input type="text" name="task_id" value="{{ old('task_id')}}" maxlength="3" id="task_id" class="form-control">
												<label class="error" for="task_id"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">屬性</td>
										<td>
											<div class="col-lg-4 nopadding">
												<select name="task_type" id="task_type" class="form-control">
													<option value="1">一般</option>
													<option value="2">生日</option>
												</select>
												<label class="error" for="task_type"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">點數</td>
										<td>
											<div class="col-lg-4 nopadding">
												<select name="task_point" id="task_point" class="form-control">
													<option value="10">10</option>
													<option value="20">20</option>
													<option value="50">50</option>
													<option value="100">100</option>
													<option value="150">150</option>
												</select>
												<label class="error" for="task_point"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">狀態</td>
										<td>
											<div class="col-lg-4 nopadding">
												<select name="task_status" id="task_status" class="form-control">
													<option value="1">開啟</option>
													<option value="2">關閉</option>
												</select>
												<label class="error" for="task_status"></label>
											</div>
										</td>
									</tr>
									<!-- 下控制按鈕 -->
									<tr>
										<td>&nbsp;</td>
										<td>
											<div style="text-align: right">			
												<a class="btn btn-xs btn-default" href="{{ asset('/backend/redeem_task') }}">返回</a>
												<input type="submit" name="btnUpdate_foot" value="新增" id="btnUpdate_foot" class="btn btn-primary btn-xs" onclick="submitForm();">
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
        $(document).ready(function()
        {
            $('#EditForm').validate();

            $.validator.addMethod(
                "regex",
                function (value, element, regexp)
                {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                }
            );

            $('#name').rules("add",
                {
                    required: true,
                    minlength: 1,
                    maxlength: 20,
                    messages: {
                        required: "required",
                        minlength: "name length must between 1-20",
                        maxlength: "name length must between 1-20"
                    }
                });

            $('#task_id').rules("add",
                {
                    required: true,
                    messages: {
                        required: "required",
                    }
                });

        });

        function submitForm()
        {
            if (!!($("#EditForm").valid()) === false)
            {
                return false;
            }
            else
            {
                $(document).ready(function()
                {
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
    </script>
@endsection
