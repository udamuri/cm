function menunestable()
{
	this.content = '';
	this.initialScript = function()
	{
		MenunestableObj.nestable();
	}

	this.nestable = function()
	{
		var ids = MenunestableObj.content;
		var updateOutput = function(e)
	    {
	        var list   = e.length ? e : $(e.target),
	            output = list.data('output');
	        if (window.JSON) {
	            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
	        } else {
	            output.val('JSON browser support required for this.');
	        }
	    };

	    // activate Nestable for list 1
	    $('#'+ids).nestable({
	        group: 1
	    })
	    .on('change', updateOutput);


	    // output initial serialised data
	    updateOutput($('#'+ids).data('output', $('#'+ids+'-output')));
	}
}

var MenunestableObj = new menunestable();