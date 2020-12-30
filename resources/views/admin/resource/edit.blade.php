@extends('admin.master')

@section('content')
	<script src="/ckfinder/ckfinder.js"></script>

	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">資源管理</h4>
					</div>
					<div class="panel-body">
						<div>
							<table class="table" cellspacing="0" id="DetailsView1" style="border-collapse:collapse;">
								<tbody>
									<!-- 欄位：Category -->
									<tr>
										<td class="header-require col-lg-1">Category</td>
										<td>
											<div class="col-lg-4 nopadding">											
												<input type="text"  name="category" id="category" class="form-control" value="" maxlength="30" readonly>
												<label class="error" for="category"></label>
											</div>
										</td>
									</tr>
									<!-- 欄位：Content -->
									<tr>
										<td class="header-require col-lg-1">Content</td>
										<td>
											<div id="ckfinder1" class="col-lg-10 nopadding">
											</div>
										</td>
									</tr>
									<!-- 控制按鈕 -->
									<tr>
										<td>&nbsp;</td>
										<td>
											<div style="text-align: right">			
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
		CKFinder.widget( 'ckfinder1' );
	});

	function submitForm()
	{
	}
	</script>
@endsection
