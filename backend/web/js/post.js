function post()
{
	this.baseUrl = '';
	this.ckeditor = false;

	this.initialScript = function()
	{	
		PostObj.dinamicBtnCategory();
		if(PostObj.ckeditor !== false)
		{
			IndexObj.setCKeditor(PostObj.ckeditor);
			PostObj.addMedia(1);
		}	
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

	this.addMedia = function(id)
	{
		$('#myModalFile').on('show.bs.modal', function (e) {
		  	var arrForm = [
				['id',id],
			];

			console.log(arrForm);
			// IndexObj.yiiAjaxForm(
			// 	'menu/site/set-status', 
			// 	arrForm, 
			// 	'',  //btn id
			// 	function(data){
			// 		$('#btn_status_'+id).removeClass('btn-warning');
			// 		$('#btn_status_'+id).removeClass('btn-primary');

			// 		if(data == '1')
			// 		{
			// 			$('#btn_status_'+id).addClass('btn-primary');
			// 			$('#btn_status_'+id).text('ON');
			// 		}
			// 		else
			// 		{
			// 			$('#btn_status_'+id).addClass('btn-warning');
			// 			$('#btn_status_'+id).text('OFF');
			// 		}
			// 	}
			// );
		});
	}

}

var PostObj = new post();