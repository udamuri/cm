function file()
{
	this.baseUrl = '';
	this.type_layer = '';
	
	this.initialScript = function()
	{	
		FileObj.btnUpload();
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
	

}

var FileObj = new file();