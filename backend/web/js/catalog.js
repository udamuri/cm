function catalog()
{
	this.baseUrl = '';
	this.type_layer = '';
	
	this.initialScript = function()
	{	
		if(CatalogObj.type_layer == '0')
		{
			CatalogObj.dinamicButtonCategory();
		}

		if(CatalogObj.type_layer == '1' )
		{
			CatalogObj.dinamicButtonCatalog();
			$( 'textarea#catalogform-catalog_desc' ).ckeditor();
        	$('#catalogform-catalog_category_id').chosen({ allow_single_deselect: true });
		}

		if(CatalogObj.type_layer == '2' )
		{
			CatalogObj.dinamicButtonCatalog();
		}

	}
	
	this.dinamicButtonCategory = function()
	{
		$('.status-catalog-category').unbind('click');
		$('.status-catalog-category').on('click', function(){
			var id = this.id;
			var ids = id.replace('status-catalog-category-','');
			CatalogObj.setCategoryStatus(ids)
		});
	}

	this.dinamicButtonCatalog = function()
	{
		$('.crop-catalog').unbind('click');
		$('.crop-catalog').on('click', function(){
			var id = this.id;
			var ids = id.replace('crop-catalog-', '');
			CatalogObj.loadCatalogImage(ids);

			$('#myModalCrop').modal({
				backdrop: 'static',
				keyboard: false
			});

		});

		$('.status-catalog').unbind('click');
		$('.status-catalog').on('click', function(){
			var id = this.id;
			var ids = id.replace('status-catalog-', '');
			CatalogObj.setCatalogStatus(ids);
		});
	}

	//Set Status
	this.setCategoryStatus = function(ids)
	{
		var arrForm = [
			['ids_data',ids],
		];
		IndexObj.yiiAjaxForm(
			'catalog/site/status-category', 
			arrForm, 
			'new-password-save',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						$('#icon-status-category-'+ids).attr('class', arrData['icon']);
						$('#status-catalog-category-'+ids).attr('class', arrData['btn']);
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

	this.loadCatalogImage = function(ids)
	{
		var arrForm = [
			['data-load',ids],
		];
		IndexObj.yiiAjaxForm(
			'catalog/site/get-catalog-image', 
			arrForm, 
			'new-password-save',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						CatalogObj.cropitLoad(ids , arrData['imageurl']);
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
			CatalogObj.saveCropPicture(ids, imageData);
		});
	}
	
	this.saveCropPicture = function(ids, file)
	{
		var arrForm = [
			['data-load',ids],
			['file_image',file],
		];
		IndexObj.yiiAjaxForm(
			'catalog/site/save-crop-catalog', 
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
						$('#catalog-image-'+ids).attr('src',arrData['pic']);
					}
					else if(arrData['status'] == 'error')
					{
						IndexObj.alertBox('Ups .. Silahkan Ulangi', 'error', 1000,'');
					}	
				}
				
				return false;
			});
	}

	//Set Status
	this.setCatalogStatus = function(ids)
	{
		var arrForm = [
			['ids_data',ids],
		];
		IndexObj.yiiAjaxForm(
			'catalog/site/status-catalog', 
			arrForm, 
			'',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						$('#icon-status-catalog-'+ids).attr('class', arrData['icon']);
						$('#status-catalog-'+ids).attr('class', arrData['btn']);
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
	
	
}

var CatalogObj = new catalog();