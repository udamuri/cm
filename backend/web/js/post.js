function post()
{
	this.baseUrl = '';
	this.profilePicture = '';
	
	this.initialScript = function()
	{	
		ProfileObj.dinamicButton();
		
	}	
}

var PostObj = new profile();