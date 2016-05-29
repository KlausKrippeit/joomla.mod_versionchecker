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

				updateRemoveBtns();
				event.preventDefault();
			});
		});
		// Update the id for the websites to save
		var updateID = function(container) {
			var i = 0;
			container.children('.item').each(function(u, cont){
				$(cont).find('.url').each(function(w, el){
					var name = $(el).prop('name');
					if(name !== null){
						var regex = new RegExp("\[[0-9]+\]"),
						newName = name.replace(regex,'['+i+']');
						$(el).prop('name', newName);
					}
				});
				i++;
			});
		}
		
		var updateRemoveBtns = function(){
			var removeBtns = $('.delete');
			removeBtns.each(function(btn,idx){
				$(idx).click(function(){
					var input = $(idx).parent(),
					container = input.parent();
					input.remove();
					updateID( container );
				});
			});
		};
		updateRemoveBtns();
	});
})(jQuery);