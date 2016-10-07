function profile()
{
	this.baseUrl = '';
	this.profilePicture = '';
	
	this.initialScript = function()
	{	
		ProfileObj.dinamicButton();
		
	}
	
	this.dinamicButton = function()
	{
		$('#new-password-save').on('click', function(){
			ProfileObj.setPassword();
		});

		$('#update-user').on('click', function(){
			ProfileObj.setUser();
		});

		$('#xbtn_pictute_upload').on('click', function(){
			$('#myModalCrop').modal({
				backdrop: 'static',
				keyboard: false
			});
			
			ProfileObj.cropitLoad();
		});
	}
	
	
	//Set Password
	this.setPassword = function()
	{
		var arrForm = [
			['PasswordForm[password]',$('#password').val()],
			['PasswordForm[new_password]',$('#new_password').val()],
			['PasswordForm[password_repeat]',$('#password_repeat').val()],
		];
		IndexObj.yiiAjaxForm(
			'profile/site/change-password', 
			arrForm, 
			'new-password-save',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						IndexObj.alertBox('Success', 'success', 1000,'');
						ProfileObj.clearPasswordForm();
						IndexObj.yiiClearErrorForm();
						IndexObj.yiiAddSuccessForm();
					}
					else if(arrData['status'] == 'error')
					{
						IndexObj.alertBox('Ups .. Silahkan Ulangi', 'error', 1000,'');
					}
					else if(arrData['status'] == 'form-error')
					{
						IndexObj.alertBox('Ups .. Silahkan Ulangi', 'warning', 1000,'');
						IndexObj.yiiClearErrorForm();
						if((typeof arrData['error-form']) == 'object')
						{
							$.each(arrData['error-form'], function( index, value ) {
								if(arrData['error-form'][index])
								{
									var box = index.split('-');
									$('#box-'+box[1]).addClass('has-error');
									$('#text-'+box[1]).text(value);
								}
							});
						}
					}	
				}
				
				return false;
			}
		);
	}

	this.clearPasswordForm = function()
	{
		$('#password').val('');
		$('#new_password').val('');
		$('#password_repeat').val('');
	}

	
	this.setUser = function()
	{
		var arrForm = [
			['UserForm[username]',$('#user-name').val()],
			['UserForm[email]',$('#user-email').val()],
		];
		IndexObj.yiiAjaxForm(
			'profile/site/update-user', 
			arrForm, 
			'update-user',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						IndexObj.alertBox('Success', 'success', 1000,'');
						ProfileObj.clearPasswordForm();
						IndexObj.yiiClearErrorForm();
						IndexObj.yiiAddSuccessForm();
					}
					else if(arrData['status'] == 'error')
					{
						IndexObj.alertBox('Ups .. Silahkan Ulangi', 'error', 1000,'');
					}
					else if(arrData['status'] == 'form-error')
					{
						IndexObj.alertBox('Ups .. Silahkan Ulangi', 'warning', 1000,'');
						IndexObj.yiiClearErrorForm();
						if((typeof arrData['error-form']) == 'object')
						{
							$.each(arrData['error-form'], function( index, value ) {
								if(arrData['error-form'][index])
								{
									var box = index.split('-');
									$('#box-'+box[1]).addClass('has-error');
									$('#text-'+box[1]).text(value);
								}
							});
						}
					}	
				}
				
				return false;
			}
		);
	}
	

	this.cropitLoad = function()
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
				src: ProfileObj.baseUrl+''+ProfileObj.profilePicture+'?'+parseDate
			}
        });
		
		$('#d-id-upload-crop-profile-picture').unbind('click')
		$('#d-id-upload-crop-profile-picture').click(function(){
			$('#cropit-image-input-b').click();
		});
		
		$('#d-id-save-crop-profile-picture').unbind('click');
		$('#d-id-save-crop-profile-picture').click(function(){
			var imageData = $('.image-editor').cropit('export');
			ProfileObj.saveCropPicture(imageData);
		});
	}
	
	this.saveCropPicture = function(file)
	{
		var arrForm = [
			['file_image',file],
		];
		IndexObj.yiiAjaxForm(
			'profile/site/save-crop-profil', 
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
						$('#profile1').attr('src',arrData['pic']);
						$('#profile-member-1').attr('src',arrData['pic']);
						$('#profile-member-2').attr('src',arrData['pic']);
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

var ProfileObj = new profile();