function post()
{
	this.baseUrl = '';
	this.ckeditor = false;
	this.slide = false;

	this.initialScript = function()
	{	
		PostObj.dinamicBtnCategory();

		if(PostObj.ckeditor !== false)
		{
			IndexObj.setCKeditor(PostObj.ckeditor);
		}

		$('#myModalFile').on('show.bs.modal', function (e) {
			PostObj.addMedia(1, 1, '');
		});
	}

	this.dinamicBtnCategory = function()
	{
		$('.status_category').unbind('click');
		$('.status_category').on('click', function(){
			var id = $(this).data('id');
			PostObj.setStatusCategory(id);
		});

		$('.status_post').unbind('click');
		$('.status_post').on('click', function(){
			var id = $(this).data('id');
			PostObj.setStatus(id);
		});
	}

	this.clickPage = function()
	{
		$('.pagination_click').unbind('click');
		$('.pagination_click').on('click', function(){
			var page = $(this).data('page');
			var nPage = 1;
			if(typeof page == 'number')
			{
				nPage = parseInt(page) + 1 ;
			}

			PostObj.addMedia(1, nPage, '');
		});

		$('.btn-add-img-ckeditor').unbind('click');
		$('.btn-add-img-ckeditor').on('click', function(){
			var url = $(this).data('imgurl');
			if(PostObj.ckeditor !== false)
			{
				CKEDITOR.instances[PostObj.ckeditor].insertHtml('<img class="img-responsive" src="'+url+'" >');
			}

			if(PostObj.slide !== false)
			{
				$('#'+PostObj.slide).val(url);
			}

			$('.close').click();
		});

		$('.btn-add-img-ckeditor-resize').unbind('click');
		$('.btn-add-img-ckeditor-resize').on('click', function(){
			var url = $(this).data('imgurl');
			if(PostObj.ckeditor !== false)
			{
				CKEDITOR.instances[PostObj.ckeditor].insertHtml('<img class="img-responsive" src="'+url+'" >');
			}

			if(PostObj.slide !== false)
			{
				$('#'+PostObj.slide).val(url);
			}
			$('.close').click();
		});

		


	}

	//Set Status
	this.setStatusCategory = function(id)
	{
		var arrForm = [
			['id',id],
		];
		IndexObj.yiiAjaxForm(
			'post/site/set-status-category', 
			arrForm, 
			'',  //btn id
			function(data){
				$('#btn_status_category_'+id).removeClass('btn-warning');
				$('#btn_status_category_'+id).removeClass('btn-primary');

				if(data == '1')
				{
					$('#btn_status_category_'+id).addClass('btn-primary');
					$('#btn_status_category_'+id).text('ON');
					IndexObj.alertBox('Status ON', 'success', 1000,'');
				}
				else
				{
					$('#btn_status_category_'+id).addClass('btn-warning');
					$('#btn_status_category_'+id).text('OFF');
					IndexObj.alertBox('Status OFF', 'success', 1000,'');
				}
			}
		);
	}

	//Set Status
	this.setStatus = function(id)
	{
		var arrForm = [
			['id',id],
		];
		IndexObj.yiiAjaxForm(
			'post/site/set-status', 
			arrForm, 
			'',  //btn id
			function(data){
				$('#btn_status_post_'+id).removeClass('btn-warning');
				$('#btn_status_post_'+id).removeClass('btn-primary');

				if(data == '1')
				{
					$('#btn_status_post_'+id).addClass('btn-primary');
					$('#btn_status_post_'+id).text('ON');
					IndexObj.alertBox('Status ON', 'success', 1000,'');
				}
				else
				{
					$('#btn_status_post_'+id).addClass('btn-warning');
					$('#btn_status_post_'+id).text('OFF');
					IndexObj.alertBox('Status OFF', 'success', 1000,'');
				}
			}
		);
	}

	this.addMedia = function(id, page, search)
	{
	  	var arrForm = [
			['id',id],
			['search',search],
		];
		$('#file-content').empty();
		$('#file-content').html('loading...');
		IndexObj.yiiAjaxForm(
			'file/site/get-ajax-file?page='+page, 
			arrForm, 
			'',  //btn id
			function(data){
				var arrData = IndexObj.jsonToArray(data);
				if(typeof arrData == 'object')
				{
					var html = '';
					var models = arrData['models'];
					if(typeof models == 'object')
					{
						for(var i=0;i<models.length;i++)
						{
							html += '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 margin-bottom20">'+
										'<div class="img-file">'+
											'<img data-id="'+models[i]['file_id']+'" src="'+models[i]['img_url']+'" alt="'+models[i]['file_name']+'" >'+
										'</div>'+
										'<div class="clearfix"></div>'+
										'<div>'+
											'<button data-imgurl="'+models[i]['img_url']+'" class="btn btn-primary btn-sm  btn-add-img-ckeditor">Add Large</button> '+
											'<button data-imgurl="'+models[i]['img_url_resize']+'" class="btn btn-primary btn-sm  btn-add-img-ckeditor-resize">Add Resize</button> '+
										'</div>'+
									'</div>' ;
							//console.log(models[i]);
						}
						$('#file-content').empty();
						$('#file-content').html(html);
					}

					if(arrData['getPage'] !== '')
					{
						$('#file-pagination').empty();
						$('#file-pagination').html(arrData['getPage']);
						var attrA = $('#file-pagination ul li').find('a');
						attrA.attr('href','javascript:void(0);');
						attrA.addClass('pagination_click');
					}

					PostObj.clickPage();
				}
			}
		);
	}

}

var PostObj = new post();