function file()
{
	this.baseUrl = '';
	this.type_layer = '';
	
	this.initialScript = function()
	{	
		FileObj.btnUpload();
		FileObj.clickFile();
	}

	this.btnUpload = function()
	{
		$('#upload-image-frontend').unbind('click');
		$('#upload-image-frontend').on('click', function(){
			$('#uploadform-imagefiles').unbind('click');
			$('#uploadform-imagefiles').unbind('change');
			$('#uploadform-imagefiles').click();
			$('#uploadform-imagefiles').on('change', function(){
				$('#upload-image').unbind('click');
				$('#upload-image').click();
			});
		});
	}

	this.clickFile = function()
	{
		$('.file_delete').unbind('click');
		$('.file_delete').on('click', function(){
			var id = $(this).data('id');

			var arrForm = [
				['id',id],
			];
			$('#file-content').empty();
			$('#file-content').html('loading...');
			IndexObj.yiiAjaxForm(
				'file-delete', 
				arrForm, 
				'',  //btn id
				function(data){
					window.location = IndexObj.baseUrl+'file-manager';	
				}
			);

		});
	}
	

}

var FileObj = new file();