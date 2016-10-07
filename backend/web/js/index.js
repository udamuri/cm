function index()
{
	this.baseUrl = '';
	this.csrfToken = '';
	this.reToLogin = 'login';
	this.ybase = '';
	this.ybase_arr = [];

	this.initialScript = function()
	{
	
	}
	
	this.jsonToArray = function(arrData)
	{
		try {
			return $.parseJSON(arrData);
		} catch (e) {
			return false;
		}
	}
	
	this.yiiErrorValidation = function(error)
	{
		
	}
	
	//----------------------------------***********************************-----------------------------
	//$('#pembelianform-pembelian_suplier').keyup(function() {
		//var text = $(this).val();
		//IndexObj.delay(function(){
			//alert(text);
		//}, 1000 );
	//});
	//----------------------------------***********************************-----------------------------
	this.delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();
	
	
	/* this.alertBox = function(message, width, height, valid, redirect)
	{
		var pDate = Date.parse(new Date());
		var icon = '';
		if(valid == 'success'){ icon ='fa fa-check'; }
		if(valid == 'error'){ icon ='fa fa-times';  }
		if(valid == 'warning'){ icon ='fa fa-exclamation-triangle';  }
		
		
		var box = '<div id="alert'+pDate+valid+'" class="alert-box alert-box-right alert-box-'+valid+'" style="width:'+width+'px;height:'+height+'px;" >'+
						'<div class="col-lg-1 col-md-1 col-sm-1 col-no-b"><i class="'+icon+'"></i></div>'+
						'<div class="col-lg-11 col-md-11 col-sm-11 col-no-b">&nbsp;'+message+'</div>'+
			      '<div>';
		

		$('body').append(box);
		$('#alert'+pDate+valid).fadeIn(1000);
			
		$('#alert'+pDate+valid).fadeOut(5000, function(){
			$('#alert'+pDate+valid).remove();
			if( redirect !== undefined && redirect !== '')
			{
				window.location = IndexObj.baseUrl+redirect;
			}
		});
		
	} */
	
	this.alertBox = function(message, valid, time, redirect)
	{
		var pDate = Date.parse(new Date());
		var v_class = '';
		if(valid == 'default'){ v_class ='default-alert'; }
		if(valid == 'success'){ v_class ='success-alert';  }
		if(valid == 'info'){ v_class ='info-alert';  }
		if(valid == 'warning'){ v_class ='warning-alert';  }
		if(valid == 'danger'){ v_class ='danger-alert';  }
		
		
		var box = '<div id="alert-'+pDate+valid+'" class="'+v_class+' alert-global-content">'+
						'<div class="close-alert-button"><i class="fa fa-times"></i></div>'+
						'<div class="clearfix"></div>'+
						'<div>'+message+'</div>'+
					'</div>';
		
		var v_time = 1000;
		var v_time_o = 1000 * 5;
		if(time !== undefined && time !== '' && time > 99)
		{
			v_time = parseInt(time) ;
			v_time_o = parseInt(time) * 5 ;
		}

		$('#content-all-alert').prepend(box);
		$('#alert-'+pDate+valid).fadeIn(v_time);
			
		$('#alert-'+pDate+valid).fadeOut(v_time_o, function(){
			$('#alert-'+pDate+valid).remove();
			if( redirect != undefined && redirect != '')
			{
				//window.location = IndexObj.baseUrl+redirect;
			}
		});
		
	}
	
	this.yiiAjaxForm = function(url, dataForm, btnID ,callbackFunction)
	{
				
		$('#'+btnID).button('loading');
		var form_data = new FormData();
		form_data.append('isAjaxRequest', 1);
		form_data.append('_csrf', IndexObj.csrfToken);
		if($.isArray(dataForm))
		{
			$.each(dataForm, function( index, value ) {
				form_data.append(value[0], value[1]);
			});
		}

		$.ajax({
			type: 'POST',
			url: IndexObj.baseUrl + url,
			processData : false,
			contentType : false,
			data: form_data,
			success:function(data)
			{
				callbackFunction(data);
				$('#'+btnID).button('reset');
			},
			error: function(data) 
			{ 
				callbackFunction(data);
				$('#'+btnID).button('reset');
			}
		});
	}
	
	this.yiiClearErrorForm = function()
	{
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
	}
	
	this.yiiAddSuccessForm = function()
	{
		$('.form-group').addClass('has-success');
		$('.help-block').empty();
		
		setTimeout(function(){
			$('.form-group').removeClass('has-success')
		}, 5000);
	}
	
	
	this.wlocation = function(url)
	{
		window.location = url;
	}
	
	this.disableButton = function(id, type)
	{
		if(type === 'disabled')
		{
			$(id).attr("disabled", true);
		}
		else
		{
			$(id).removeAttr("disabled");
		}
	}
	
	//IndexObj.selectOption(id, value);
	this.selectOption = function(id, value)
	{
		$(id).each(function() {
			if($(this).val() == value ) {
				$(this).prop("selected", true);
			}
		});
	}
	
}

var IndexObj = new index();