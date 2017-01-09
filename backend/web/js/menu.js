function menu()
{
	this.baseUrl = '';

	this.initialScript = function()
	{
		//setTimeout(function(){ alert("Hello"); }, 3000);
		MenuObj.buttonDinamic();
	}

	this.buttonDinamic = function()
	{
		$('.btn_status').unbind('click');
		$('.btn_status').on('click', function(e){
			var id = $(this).data('id');
			MenuObj.setStatus(id);
		});
	}

	//Set Password
	this.setStatus = function(id)
	{
		var arrForm = [
			['id',id],
		];
		IndexObj.yiiAjaxForm(
			'menu/site/set-status', 
			arrForm, 
			'',  //btn id
			function(data){
				$('#btn_status_'+id).removeClass('btn-warning');
				$('#btn_status_'+id).removeClass('btn-primary');

				if(data == '1')
				{
					$('#btn_status_'+id).addClass('btn-primary');
					$('#btn_status_'+id).text('ON');
				}
				else
				{
					$('#btn_status_'+id).addClass('btn-warning');
					$('#btn_status_'+id).text('OFF');
				}
			}
		);
	}
}

var MenuObj = new menu();