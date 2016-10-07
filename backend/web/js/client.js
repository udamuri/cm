function client()
{
	this.baseUrl = '';
	this.type_layer = '';
	
	this.initialScript = function()
	{	
		if(ClientObj.type_layer == '0')
		{
			ClientObj.dinamicButton();
		}

		if(ClientObj.type_layer == '1')
		{
			$( 'textarea#clientform-client_desc' ).ckeditor();
		}

	}
	
	this.dinamicButton = function()
	{
		$('.status-client').unbind('click');
		$('.status-client').on('click', function(){
			var id = this.id;
			var ids = id.replace('status-client-','');
			ClientObj.setClientStatus(ids);
		});

		$('.crop-client').unbind('click');
		$('.crop-client').on('click', function(){
			var id = this.id;
			var ids = id.replace('crop-client-', '');
			ClientObj.loadClientImage(ids);

			$('#myModalCrop').modal({
				backdrop: 'static',
				keyboard: false
			});

		});

	}

	//Set Status
	this.setClientStatus = function(ids)
	{
		var arrForm = [
			['ids_data',ids],
		];
		IndexObj.yiiAjaxForm(
			'client/site/status-client', 
			arrForm, 
			'',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						$('#icon-status-client-'+ids).attr('class', arrData['icon']);
						$('#status-client-'+ids).attr('class', arrData['btn']);
						IndexObj.alertBox('Success', 'success', 1000,'');
					}
					else if(arrData['status'] == 'error')
					{
						IndexObj.alertBox('Ups .. Please Try Again', 'error', 1000,'');
					}
				}
				
				return false;
			}
		);
	}

	this.loadClientImage = function(ids)
	{
		var arrForm = [
			['data-load',ids],
		];
		IndexObj.yiiAjaxForm(
			'client/site/get-client-image', 
			arrForm, 
			'',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						ClientObj.cropitLoad(ids , arrData['imageurl']);
					}
					else if(arrData['status'] == 'error')
					{
						IndexObj.alertBox('Ups .. Please Try Again', 'error', 1000,'');
					}
				}
				
				return false;
			}
		);
	}

	this.cropitLoad = function(ids, imageurl)
	{
		var parseDate = Date.parse(Date());
		var html = '<div class="image-editor">'+
						'<input id="cropit-image-input-b" type="file" class="cropit-image-input hide">'+
						'<div class="cropit-image-preview-container">'+
							'<div class="cropit-image-preview"></div>'+
						'</div>'+
						'<div class="image-size-label">'+
							'Resize image'+
						'</div>'+
						'<div style="z-index:9999;"><input type="range" class="cropit-image-zoom-input" ></div>'+
					'</div>';
					
		$('#cropit-content').empty();
		$('#cropit-content').html(html);

		$('.image-editor').unbind('cropit');
		$('.image-editor').cropit({
			exportZoom: 1.25,
			imageBackground: true,
			imageBackgroundBorderWidth: 2,
			imageState: {
				src: imageurl+'?'+parseDate
			}
        });
		
		$('#d-id-upload-crop-profile-picture').unbind('click')
		$('#d-id-upload-crop-profile-picture').click(function(){
			$('#cropit-image-input-b').click();
		});
		
		$('#d-id-save-crop-profile-picture').unbind('click');
		$('#d-id-save-crop-profile-picture').click(function(){
			var imageData = $('.image-editor').cropit('export');
			ClientObj.saveCropPicture(ids, imageData);
		});
	}
	
	this.saveCropPicture = function(ids, file)
	{
		var arrForm = [
			['data-load',ids],
			['file_image',file],
		];
		IndexObj.yiiAjaxForm(
			'client/site/save-crop-client', 
			arrForm, 
			'd-id-save-crop-profile-picture', 
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						IndexObj.alertBox('Success', 'success', 1000,'');
						$('#d-id-close-crop-profile-picture').click();
						$('#client-image-'+ids).attr('src',arrData['pic']);
					}
					else if(arrData['status'] == 'error')
					{
						IndexObj.alertBox('Ups .. Silahkan Ulangi', 'error', 1000,'');
					}	
				}
				
				return false;
			});
	}

}

var ClientObj = new client();