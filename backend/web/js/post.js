function post()
{
	this.baseUrl = '';

	this.initialScript = function()
	{	
		PostObj.dinamicBtnCategory();
		PostObj.setCKeditor('postform-post_content');
	}

	this.dinamicBtnCategory = function()
	{
		$('.status_category').unbind('click');
		$('.status_category').on('click', function(){
			var id = $(this).data('id');
			PostObj.setStatusCategory(id);
		});

		$('.status_post').unbind('click');
		$('.status_post').on('click', function(){
			var id = $(this).data('id');
			PostObj.setStatus(id);
		});
	}	

	//Set Status
	this.setStatusCategory = function(id)
	{
		var arrForm = [
			['id',id],
		];
		IndexObj.yiiAjaxForm(
			'post/site/set-status-category', 
			arrForm, 
			'',  //btn id
			function(data){
				$('#btn_status_category_'+id).removeClass('btn-warning');
				$('#btn_status_category_'+id).removeClass('btn-primary');

				if(data == '1')
				{
					$('#btn_status_category_'+id).addClass('btn-primary');
					$('#btn_status_category_'+id).text('ON');
					IndexObj.alertBox('Status ON', 'success', 1000,'');
				}
				else
				{
					$('#btn_status_category_'+id).addClass('btn-warning');
					$('#btn_status_category_'+id).text('OFF');
					IndexObj.alertBox('Status OFF', 'success', 1000,'');
				}
			}
		);
	}

	//Set Status
	this.setStatus = function(id)
	{
		var arrForm = [
			['id',id],
		];
		IndexObj.yiiAjaxForm(
			'post/site/set-status', 
			arrForm, 
			'',  //btn id
			function(data){
				$('#btn_status_post_'+id).removeClass('btn-warning');
				$('#btn_status_post_'+id).removeClass('btn-primary');

				if(data == '1')
				{
					$('#btn_status_post_'+id).addClass('btn-primary');
					$('#btn_status_post_'+id).text('ON');
					IndexObj.alertBox('Status ON', 'success', 1000,'');
				}
				else
				{
					$('#btn_status_post_'+id).addClass('btn-warning');
					$('#btn_status_post_'+id).text('OFF');
					IndexObj.alertBox('Status OFF', 'success', 1000,'');
				}
			}
		);
	}

	this.setCKeditor = function(id)
	{
		if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
		{
			CKEDITOR.tools.enableHtml5Elements( document );
		}

		// The trick to keep the editor in the sample quite small
		// unless user specified own height.
		CKEDITOR.config.height = 150;
		CKEDITOR.config.width = 'auto';

		var wysiwygareaAvailable = PostObj.isWysiwygareaAvailable(),
		isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

		var editorElement = CKEDITOR.document.getById( id );

		// :(((
		// if ( isBBCodeBuiltIn ) {
		// 	editorElement.setHtml(
		// 		'Hello world!\n\n' +
		// 		'I\'m an instance of [url=http://ckeditor.com]CKEditor[/url].'
		// 	);
		// }

		// Depending on the wysiwygare plugin availability initialize classic or inline editor.
		if ( wysiwygareaAvailable ) {
			CKEDITOR.replace( id );
		} else {
			editorElement.setAttribute( 'contenteditable', 'true' );
			CKEDITOR.inline( id );

			// TODO we can consider displaying some info box that
			// without wysiwygarea the classic editor may not work.
		}

	}

	this.isWysiwygareaAvailable = function() {
		// If in development mode, then the wysiwygarea must be available.
		// Split REV into two strings so builder does not replace it :D.
		if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
			return true;
		}

		return !!CKEDITOR.plugins.get( 'wysiwygarea' );
	}

}

var PostObj = new post();