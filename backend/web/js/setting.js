function setting()
{
	this.baseUrl = '';
	this.ckeditor = false;

	this.initialScript = function()
	{	
		$("textarea").each(function(){
	        var id = this.id;
	        IndexObj.setCKeditor(id);
	    });
	}

}

var SettingObj = new setting();