function post()
{
	this.baseUrl = '';

	this.initialScript = function()
	{	
		PostObj.dinamicBtnCategory();
	}

	this.dinamicBtnCategory = function()
	{
		$('.status_category').unbind('click');
		$('.status_category').on('click', function(){
			var id = $(this).data('id');
			PostObj.setStatusCategory(id);
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
				}
				else
				{
					$('#btn_status_category_'+id).addClass('btn-warning');
					$('#btn_status_category_'+id).text('OFF');
				}
			}
		);
	}

}

var PostObj = new post();