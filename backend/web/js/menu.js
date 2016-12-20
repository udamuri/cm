function menu()
{
	this.baseUrl = '';

	this.initialScript = function()
	{
		//MenuObj.MenuDragDrop();
	}

	this.MenuDragDrop = function()
	{
		 var updateOutput = function(e)
		    {
		        var list   = e.length ? e : $(e.target),
		            output = list.data('output');
		        if (window.JSON) {
		            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
		        } else {
		            output.val('JSON browser support required for this demo.');
		        }
		    };

		    // activate Nestable for list 1
		    $('#nestable').nestable({
		        group: 1
		    })
		    .on('change', function(){
		    	updateOutput;
		    	updateOutput($('#nestable').data('output', $('#nestable-output')));
		    	//MenuObj.UpdateMenuDinamic($('#nestable-output').val());
		    	//MenuObj.clickUnbind();
		    });
		   
	
		   updateOutput($('#nestable').data('output', $('#nestable-output')));
		   
		   $('#nestable-menu').unbind('click');
		   $('#nestable-menu').on('click', function(e)
		    {
		        var target = $(e.target),
		            action = target.data('action');
		        if (action === 'expand-all') {
		            $('.dd').nestable('expandAll');
		        }
		        if (action === 'collapse-all') {
		            $('.dd').nestable('collapseAll');
		        }
		    });
	}
}

var MenuObj = new menu();