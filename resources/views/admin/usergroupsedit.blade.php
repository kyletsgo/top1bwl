@extends('admin.master')

@section('content')
	<?php
	if ($operdata == "") {
		//Insert Mode
		$_name  = "";
		$_valid = "1";
	} else {
		//Edit Mode
		foreach ($operdata as $data_item1) {
			$_serno	  = $data_item1->id;
			$_name	  = $data_item1->Name;
			$_valid	  = $data_item1->Valid;
			$_cdate	  = $data_item1->created_at;
			$_mdate	  = $data_item1->updated_at;
			$_oid	  = $data_item1->Oid;
		}
	}
	?>
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="{{ asset('/backend/Usergroups/store') }}">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">{{ (($operdata == "") ? "Create " : "Modify ") }}Group</h4>
					</div>
					<div class="panel-body">
						<div>
							<!-- 表格本體 -->
							<table class="table" cellspacing="0" id="DetailsView1" style="border-collapse:collapse;">
								<tbody>
									<!-- 欄位：no -->
									@if ($operdata == "")
										<!-- Insert Mode -->
										<input type="hidden" name="mode" value="insert" />
									@else
										<!-- Edit Mode -->
										<tr>
											<td class="col-lg-2">no</td>
											<td>
												<input name="id" type="hidden" value="{{ $_serno }}" id="serno" />
												{{ $_serno }}
											</td>
										</tr>
									@endif
									<!-- 欄位：Group Name -->
									<!-- ALL Mode -->
									<tr>
										<td class="header-require col-lg-2">Group Name</td>
										<td>
											<div class="col-lg-3 nopadding">
												<input name="Name" type="text" value="{{ $_name }}" maxlength="20" id="name" class="form-control">
												<label class="error" for="name"></label>
											</div>
										</td>
									</tr>
									<!-- 欄位：Valid -->
									<!-- ALL Mode -->
									<tr>
										<td class="col-lg-2">Valid</td>
										<td>
											<input id="valid" type="checkbox" name="Valid" {{ ($_valid=='1')?"checked='checked'":"" }} />
										</td>
									</tr>
									<!-- 欄位：Create Time -->
									@if ($operdata == "")
										<!-- Insert Mode -->
									@else
										<!-- Edit Mode -->
										<tr>
											<td class="col-lg-2">Create Time</td>
											<td>{{ $_cdate }}</td>
										</tr>
									@endif
									<!-- 欄位：Modify Time -->
									@if ($operdata == "")
										<!-- Insert Mode -->
									@else
										<!-- Edit Mode -->
										<tr>
											<td class="col-lg-2">Modify Time</td>
											<td>{{ $_mdate }}</td>
										</tr>
									@endif
									<!-- 欄位：Role -->
									@if ($operdata == "")
										<!-- Insert Mode -->
									@else
										<!-- Edit Mode -->
										<tr>
											<td class="col-lg-2">Role</td>
											<td><span id="oid">{{ $_oid }}</span></td>
										</tr>
									@endif
									<!-- 欄位：Functions -->
									<!-- ALL Mode -->
									<tr>
										<td class="col-lg-2">Functions</td>
										<td>
											<!-- 左側Source區 -->
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group has-warning" style="margin: 0">
														<label class="control-label" for="funlist">Unassign</label>
														<select size="4" name="fFunAll" multiple="multiple" id="fFunAll" class="form-control">
															@foreach($unseleted_funlist as $data)
																<option value='{{ $data->id }}'>{{ $data->FunName }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<!-- 右側Destination區 -->
												<div class="col-lg-12">
													<div class="form-group has-success" style="margin: 0">
														<label class="control-label" for="funlist">Assigned</label>
														<select size="4" name="FunList" multiple="multiple" id="funlist" class="form-control">
															@foreach($seleted_funlist as $data)
																<option value='{{ $data->id }}'>{{ $data->FunName }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
											<!-- 右側的隱藏控制表單項 -->
											<input type="hidden" id="hidfunlist" name ="hidfunlist"></input>
										</td>
									</tr>
									<!-- 欄位：Role -->
									<!-- ALL Mode -->
									<tr>
										<td class="col-lg-2">Users</td>
										<td>
											<!-- 左側Source區 -->
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group has-warning" style="margin: 0">
														<label class="control-label" for="fUsrAll">Unassign</label>
														<select size="4" name="fUsrAll" multiple="multiple" id="fUsrAll" class="form-control">
															@foreach($unseleted_usrlist as $data)
																<option value='{{ $data->id }}'>{{ $data->name }}({{ $data->email }})</option>
															@endforeach
														</select>
													</div>
												</div>
												<!-- 中間的轉換按鈕 -->
											</div>
											<div class="row">
												<!-- 右側Destination區 -->
												<div class="col-lg-12">
													<div class="form-group has-success" style="margin: 0">
														<label class="control-label" for="usrlist">Assigned</label>
														<select size="4" name="UsrList" multiple="multiple" id="usrlist" class="form-control">
															@foreach($seleted_usrlist as $data)
																<option value='{{ $data->id }}'>{{ $data->name }}({{ $data->email }})</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
											<!-- 右側的隱藏控制表單項 -->
											<input type="hidden" id="hidusrlist" name ="hidusrlist"></input>
										</td>
									</tr>
									<!-- 下控制按鈕 -->
									<tr>
										<td>&nbsp;</td>
										<td>
											<div style="text-align: right">
												@if ($operdata == "")
													<!-- Insert Mode -->
													<input type="button" name="btnUpdate_foot" value="Create" id="btnUpdate_foot" class="btn btn-primary btn-xs" onclick="submitForm();">
												@else
													<!-- Edit Mode -->
													<input type="button" name="btnUpdate_foot" value="Modify" id="btnUpdate_foot" class="btn btn-primary btn-xs" onclick="submitForm();">
												@endif
												<input type="button" name="btnBackTo2_foot" value="Back" id="btnBackTo2_foot" class="btn btn-default btn-xs">
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
	$(document).ready(function() {
		//Functions：單個項目指派
		$("#fFunAll option").live("dblclick", function() {
			$("#fFunAll option:selected").each(function() {
				$("#funlist").append('<option value="'+$(this).val()+'" >'+ $( this ).text()+'</option>');
			});
			$("#fFunAll option:selected").remove();
		});
		//Functions：單個項目移除
		$("#funlist option").live("dblclick", function() {
			$("#funlist option:selected").each(function() {
				$("#fFunAll").append('<option value="'+$(this).val()+'" >'+ $( this ).text()+'</option>');
			});
			$("#funlist option:selected").remove();
		});

		//Role：單個項目指派
		$("#fUsrAll option").live("dblclick", function() {
			$("#fUsrAll option:selected").each(function() {
				$("#usrlist").append('<option value="'+$(this).val()+'" >'+ $( this ).text()+'</option>');
			});
			$("#fUsrAll option:selected").remove();
		});
		//Role：單個項目移除
		$("#usrlist option").live("dblclick", function() {
			$("#usrlist option:selected").each(function() {
				$("#fUsrAll").append('<option value="'+$(this).val()+'" >'+ $( this ).text()+'</option>');
			});
			$("#usrlist option:selected").remove();
		});

		//Back
		$("#btnBackTo2").click(function() {
			location.href='/backend/Usergroups';
		});
		$("#btnBackTo2_foot").click(function() {
			location.href='/backend/Usergroups';
		});
		//初始化需要偵錯的表格
		$('#EditForm').validate();
		//正規表達驗證初始化
		$.validator.addMethod(
			"regex",
			function (value, element, regexp) {
				var re = new RegExp(regexp);
				return this.optional(element) || re.test(value);
			}
		);
		//各欄位
		$('#name').rules("add", {
			required: true,
			minlength: 1,
			maxlength: 20,
			messages: {
				required: "Group Name length must between 1-20",
				minlength: "Group Name length must between 1-20",
				maxlength: "Group Name length must between 1-20"
			}
		});
	});
	//提交與取消按鈕
	function submitForm() {
		if (!!($("#EditForm").valid()) === false) {
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
		$(document).ready(function() {
			//Functions的加工
			var funlist='';
			$("#funlist option").each(function(){
				funlist += $(this).val() + "," ;
			});
			$("#hidfunlist").val(funlist);
			//Role的加工
			var usrlist='';
			$("#usrlist option").each(function(){
				usrlist += $(this).val() + "," ;
			});
			$("#hidusrlist").val(usrlist);
			$("#EditForm").submit();
		});

	}
	function cancelValidate() {
		$("#EditForm").validate().cancelSubmit = true;
	}
	</script>
@endsection
