function controlloTabHTML5()
{
	$('input:invalid').each(function () {
		controlloTabHTML5HideTabs();
		var $closest = $(this).closest('.tab-pane');
		var id = $closest.attr('id');
		$('#'+id+'-tab').addClass('active');
		$('#'+id).addClass('show');
		$('#'+id).addClass('active');
		var idf = '#'+$(this).attr('id');
		$(idf).addClass('input-no-validate');
		return false;
	});

	$('select:invalid').each(function () {
		controlloTabHTML5HideTabs()
		var $closest = $(this).closest('.tab-pane');
		var id = $closest.attr('id');
		console.log('select id: '+id);
		var idf = '#'+$(this).attr('id');
		console.log('select idf: '+idf);
		controlloTabHTML5ShowTabs(id,idf);
		return false;
	});

	$('textarea:invalid').each(function () {
		controlloTabHTML5HideTabs()
		var $closest = $(this).closest('.tab-pane');
		var id = $closest.attr('id');
		console.log('select id: '+id);
		var idf = '#'+$(this).attr('id');
		console.log('select idf: '+idf);
		controlloTabHTML5ShowTabs(id,idf);
		return false;
	});

}

function controlloTabHTML5HideTabs() 
{
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass('show');
    $('.tab-pane').removeClass('active');
}

function controlloTabHTML5ShowTabs(id,idf) 
{
    $('#'+id+'-tab').addClass('active');
    $('#'+id).addClass('show');
    $('#'+id).addClass('active');  
    $(idf).addClass('input-no-validate');
}

function showJavascriptAlert(mess)
{
	if (mess != '') {
		if (typeof bootbox != "undefined") {
			bootbox.alert(mess);
		} else {
			alert(mess);
		}  
	}
}

function showJavascriptConfirm(mess)
{
    if (typeof bootbox != "undefined") {
        bootbox.confirm(mess);
    } else {
        var answer = window.confirm(mess);
		if (answer) {
			console.log('ok');
			return true;
		} else {
			console.log('no');
			return false;
			//some code
		}
    }  
}


function prependMessageBar(element,error,message)
{
	$('#systemMessageID').remove();
	/*
	console.log('prependmessage-error '+error);
	console.log('prependmessage-message '+message);
	console.log('prependmessage-element '+element);
	*/

	let classe = 'alert-success';
	if (error == 1) classe = ' alert-danger';
	if (error > 1) classe = ' alert-warning';
	$(element).prepend('<div id="systemMessageID" class="alert '+classe+'">'+message+'</div>');
}

// ajax active
function setDbRowActive() 
{
	$('.setactive').each(function (element) {

		$(this).click(function (event) {
			event.preventDefault();
            
			var elem = $(this);			
			let id = elem.attr('data-id');
			let table = elem.attr('data-table');
			let label = elem.attr('data-label');
			let labelsex = elem.attr('data-labelsex');

			console.log('id: '+id);

      $.ajax({
				url: siteUrl + "ajax/generals/setActive.php",
				method: "POST",
				async: false,
				cache: false,
				global: false,
				data: {
					'id': id,
					'table': table,
					'label': label,
					'labelsex': labelsex
				}
			}).done(function (response) {
				data = $.parseJSON(response);

				elem.find("i").removeClass("fa fa-lock"); 
				elem.find("i").removeClass("fa fa-unlock");

				elem.find("i").removeClass("text-success");
				elem.find("i").removeClass("text-danger");
				prependMessageBar('#container-fluidID',data.error,data.message);
		    elem.find("i").addClass(data.icon);
				if (data.title != '') elem.prop('title', data.title);
			})
			.fail(function() {
				showJavascriptAlert("Ajax failed to fetch data");
			})

    });
	});
}