function content()
{
	this.baseUrl = '';
	this.type_layer = '';
	
	this.initialScript = function()
	{	
		if(ContentObj.type_layer == '0')
		{
			ContentObj.dinamicButtonCategory();
		}

		if(ContentObj.type_layer == '1' )
		{
			//ContentObj.dinamicButtonCatalog();
			//$( 'textarea#catalogform-catalog_desc' ).ckeditor();
        	//$('#catalogform-catalog_category_id').chosen({ allow_single_deselect: true });
		}

		if(ContentObj.type_layer == '2' )
		{
			//ContentObj.dinamicButtonCatalog();
		}

		if(ContentObj.type_layer == '9')
		{
			ContentObj.dinamicButtonContent()
		}

		if(ContentObj.type_layer == '10')
		{
			$( 'textarea#contentform-content_desc' ).ckeditor();
        	$('#contentform-content_category_id').chosen({ allow_single_deselect: true });
		}

	}
	
	this.dinamicButtonCategory = function()
	{
		$('.status-content-category').unbind('click');
		$('.status-content-category').on('click', function(){
			var id = this.id;
			var ids = id.replace('status-content-category-','');
			ContentObj.setCategoryStatus(ids)
			//alert(ids);
		});
	}

	this.dinamicButtonContent = function()
	{
		$('.status-content').unbind('click');
		$('.status-content').on('click', function(){
			var id = this.id;
			var ids = id.replace('status-content-', '');
			ContentObj.setContentStatus(ids);
		});
	}

	//Set Status
	this.setCategoryStatus = function(ids)
	{
		var arrForm = [
			['ids_data',ids],
		];
		IndexObj.yiiAjaxForm(
			'content/site/status-cat', 
			arrForm, 
			'',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						$('#icon-status-category-'+ids).attr('class', arrData['icon']);
						$('#status-content-category-'+ids).attr('class', arrData['btn']);
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


	//Set Status
	this.setContentStatus = function(ids)
	{
		var arrForm = [
			['ids_data',ids],
		];
		IndexObj.yiiAjaxForm(
			'content/site/status-content', 
			arrForm, 
			'',  //btn id
			function(data){
				if(typeof data == 'string')
				{
					var arrData = IndexObj.jsonToArray(data);
					if(arrData['status'] == 'success') 
					{
						$('#icon-status-content-'+ids).attr('class', arrData['icon']);
						$('#status-content-'+ids).attr('class', arrData['btn']);
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

var ContentObj = new content();