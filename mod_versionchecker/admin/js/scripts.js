(function($)
{
	$(document).ready(function(){
		if (window.jQuery) {
			console.log("loaded"); 
		} else {
			console.log("not loaded");
		}
		// --
		var addBtns = $('.button-add');
		
		addBtns.each(function(btn,idx){
			// Add a new item when clicked
			$(idx).click(function(){
				var template = $('#item-template'),
				container =  $(this).parent(),
				newItem = template.clone(),
				newName = 'jform[params]['+container.attr('id')+']',
				itemCount = container.children('.item').length; 
				newItem.children('.url').attr('name', newName+'['+itemCount+'][url]').attr('value','');
				newItem.insertBefore($('#but_l'));

				event.preventDefault();
			});
		});
	});
})(jQuery);