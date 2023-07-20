var location_nations_id;
var location_province_id;
var location_cities_id;
var provincia_alt;
var city_alt;

$(document).ready(function () {

	location_nations_id = selected_location_nations_id;
	location_province_id = selected_location_province_id;
	location_cities_id = selected_location_cities_id;

	createSelectCities();

	$('#location_province_id').on('change', function (event) {
		location_province_id = $('#location_province_id').val();
		createSelectCities();
	});

});


function createSelectCities() {
	let token = $("input[name=_token]").val();

	$.ajax({
		url: '/ajaxrequests/getcitiesjsonfromdb',
		async: false,
		cache: false,
		type: 'PUT',
		data: {
			location_province_id: location_province_id,
			_token: token,
		},
		dataType: 'json'
	})
		.done(function (data) {
			let selectOptions = '';
			let selected = '';
			$.each(data, function (index, value) {
				selected = '';
				if (value.id === location_cities_id) selected = ' selected="selected"';
				selectOptions = selectOptions + '<option' + selected + ' value="' + value.id + '">' + value.nome + '</option>';
			});
			$('#location_cities_id').find('option').remove().end().append(selectOptions);
			$('#location_cities_id').val(location_cities_id);
			//$('#location_comuni_idID').selectpicker('refresh');      
		})
		.fail(function () {
			showJavascriptAlert("Errore ajax lettura comuni");
		})

}

$('#location_cities_id').on('change', function () {
	let location_cities_id = $('#location_cities_id').val();
	let token = $("input[name=_token]").val();
	//console.log(location_cities_id);
	$.ajax({
		url: '/ajaxrequests/getcityjsonfromdb',
		async: false,
		cache: false,
		type: 'PUT',
		data: {
			location_cities_id: location_cities_id,
			_token: token,
		},
		dataType: 'json'
	})
	.done(function (data) {
			//$('#zip_codeID').val(data.cap);
			//$('#location_comuni_idID').selectpicker('refresh');
			//manageComuni();
	})
	.fail(function () {
			alert("Ajax failed to fetch data article for comuni cap");
	})

});