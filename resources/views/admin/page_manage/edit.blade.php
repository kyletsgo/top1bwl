@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form id="EditForm" class="form-horizontal" method="post" action="/backend/page_manage/edit">
                {{ csrf_field() }}
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">編輯網頁</h4>
                    </div>
                    <div class="panel-body">
                        <div>
                            <input type="hidden" name="page_id" value="{{ $row->page_id }}" style="display:none">

                            <table class="table" cellspacing="0" style="border-collapse:collapse;">
                                <tbody>
                                <tr>
                                    <td class="header-require col-lg-2"><span style="color:red">*</span>標題</td>
                                    <td>
                                        <div class="col-lg-4 nopadding">
                                            <input type="text" name="title" value="{{ $row->title }}" maxlength="80" id="title" class="form-control">
                                            <label class="error" for="title"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="header-require col-lg-1"><span style="color:red">*</span>內容</td>
                                    <td>
                                        <div class="col-lg-11 nopadding">
                                            <textarea id="content" name="content" class="form-control" rows="100" cols="80">
                                                {{ $row->content }}
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
                                            <input type="submit" value="更新" class="btn btn-primary btn-xs" onclick="submitForm();">
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
            filebrowserUploadUrl : null,
			extraPlugins : 'stylesheetparser',
			contentsCss : [ '/assets/template/dist/css/index.min.css?v=20201201' , 'https://unpkg.com/swiper/swiper-bundle.min.css'],
			stylesSet : [],
            templates: 'my',
            on: {
                instanceReady: function( argument ) {
                    $.ajax({
                        type: "GET",
                        url: "/backend/page_manage/get-template",
                        dataType: "json",
                        data: {},
                    }).done( function(result) {
                        // console.log(result);

                        CKEDITOR.addTemplates( 'my', {
                            imagesPath: CKEDITOR.getUrl('/component/images/'),
                            templates: result.data.ck_template
                        });
                    }).fail(function() {
                        console.log('error');
                    }).always(function() {
                        $.unblockUI();
                    });
                }
            }
		});

        CKFinder.setupCKEditor(editor, {
            readOnly: true
        } );
	});

	function submitForm()
	{
	}
	</script>
@endsection
