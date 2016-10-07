function template()
{
	this.baseUrl = '';
	this.type_layer = '';
	
	this.initialScript = function()
	{
		$('[data-toggle="tooltip"]').tooltip()
	}
	
}

var TemplateObj = new template()