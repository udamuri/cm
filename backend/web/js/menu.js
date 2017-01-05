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
			console.log(id);
		});
	}
}

var MenuObj = new menu();