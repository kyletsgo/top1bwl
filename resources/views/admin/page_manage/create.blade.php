@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form id="EditForm" class="form-horizontal" method="post" action="/backend/page_manage/create">
                {{ csrf_field() }}
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">建立網頁</h4>
                    </div>
                    <div class="panel-body">
                        <div>
                            <table class="table" cellspacing="0" style="border-collapse:collapse;">
                                <tbody>
                                <tr>
                                    <td class="header-require col-lg-2"><span style="color:red">*</span>標題</td>
                                    <td>
                                        <div class="col-lg-4 nopadding">
                                            <input type="text" name="title" maxlength="80" id="title" class="form-control">
                                            <label class="error" for="title"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="header-require col-lg-1"><span style="color:red">*</span>內容</td>
                                    <td>
                                        <div class="col-lg-11 nopadding">
                                            <textarea id="content" name="content" class="form-control" rows="100" cols="80">
                                                {{ $content }}
                                            </textarea>
                                            <label class="error" for="content"></label>
                                        </div>
                                    </td>
                                </tr>
                                <!-- 下控制按鈕 -->
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <div style="text-align: right">
                                            <a class="btn btn-xs btn-default" href="/backend/page_manage">返回</a>
                                            <input type="submit" value="建立" class="btn btn-primary btn-xs" onclick="submitForm();">
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
    <script src="/ckeditor/ckeditor.js"></script>
    <script src="/ckfinder/ckfinder.js"></script>

	<script>
	$(document).ready(function() 
	{
        var editor = CKEDITOR.replace( 'content', {
			width : '100%',
			height : 800,
			extraPlugins : 'stylesheetparser',
			contentsCss : [ '/assets/template/dist/css/index.min.css?v=20201201' , 'https://unpkg.com/swiper/swiper-bundle.min.css'],
			stylesSet : [],
		});

        CKFinder.setupCKEditor(editor);

        // jQuery Validation - start
        $('#EditForm').validate();

        $.validator.addMethod(
            "regex",
            function (value, element, regexp)
            {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            }
        );

        $('#title').rules("add",
            {
                required: true,
                messages: {
                    required: "請輸入標題"
                }
            });
        // jQuery Validation - end
	});

	function submitForm()
	{
        if ($("#EditForm").valid() === false) {
            return false;
        } else {
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
	}
	</script>
@endsection
