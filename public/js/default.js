$(function () {
	$("a.confirm").click(function(e) {
	    e.preventDefault();
	    var location = $(this).attr('href');
	    bootbox.confirm(messages['Sei sicuro?'],function(confirmed) {
	        if(confirmed) {
	        window.location.replace(location);
	        }
	    });
	});     


	$(".formconfirmdelete").click(function(e) {
	  e.preventDefault();
		let el = $(this);
		let elform =  el.parent();
	  bootbox.confirm('Sei sicuro?',function(confirmed) {
	  if(confirmed) {
	    elform.submit();
	  }
	  });
	});  
	
	
	$('.deleteitemformbutton').on('click', function(event){
		let elem = $(this).parent();
		console.log(elem);
		bootbox.confirm('Sei sicuro?',function(confirmed) {
			if(confirmed) {
				elem.submit();
				return true;
	    }
	  });
		return false;
		event.preventDefault();
	})

});

$('.custom-file-input').on('change', function () {
	let fileName = $(this).val().split('\\').pop();
	$(this).next('.custom-file-label').addClass("selected").html(fileName);
})