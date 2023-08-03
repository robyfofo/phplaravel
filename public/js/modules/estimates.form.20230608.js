var price_unity = 0.00;
var quantity = 1;
var price_total = 0.00;
var tax = 0;
var price_tax = 0.00;
var total = 0.00;

$(document).ready(function () {
  price_unity = $('#art_price_unityID').val();
  if (price_unity == '') price_unity = 0;
  price_unity = parseFloat(price_unity);
  quantity = $('#art_quantityID').val();
  if (quantity == '') quantity = 0; 
  quantity = parseInt(quantity);
  calcolateTotals();
});

$('#art_price_unityID').on('keyup', function (event) {
  price_unity = $('#art_price_unityID').val();
  if (price_unity == '') price_unity = 0;
  price_unity = parseFloat(price_unity);
  calcolateTotals();
}); // end function

$('#art_quantityID').on('keyup', function (event) {
  quantity = $('#art_quantityID').val();
  if (quantity == '') quantity = 0; 
  quantity = parseInt(quantity);
  calcolateTotals();
}); // end function

function calcolateTotals() {
  price_total = price_unity * quantity;
  tax = $('#art_taxID').html();
  tax = parseInt(tax);
  price_tax = (price_total * tax) / 100;	
  total = price_total + price_tax;
  refreshValues();
}

function refreshValues(price_unity, quantity) {
  $('#art_price_totalID').html(price_total.toFixed(2));
  $('#art_price_taxID').html(price_tax.toFixed(2));
  $('#art_totalID').html(total.toFixed(2));
}

function refreshEstimateValues(art_total,operation) {
  console.log('art_total ' + art_total);

  let estimate_total = $('#estimate_totalID').val();
  console.log('estimate_total ' + estimate_total);
  console.log('art_total ' + art_total);

  estimate_total = parseFloat(estimate_total - art_total);
  console.log('res estimate_total ' + estimate_total);


  $('#estimate_totalID').val(estimate_total.toFixed(2));
  $('#estimate_strtotalID').html($.number(estimate_total, 2, ','));

  refreshEstimateTotals(estimate_total);
}

function refreshEstimateTotals(estimate_total) {
  console.log('estimate_total ' + estimate_total);

  $('#estimate_totalID').val(estimate_total.toFixed(2));
  $('#estimate_strtotalID').html($.number(estimate_total, 2, ','));

  let estimate_tax = parseFloat($('#estimate_taxID').val());
  console.log('estimate_tax ' + estimate_tax);

  let estimate_price_tax = parseFloat((estimate_total * estimate_tax) / 100);
  console.log('estimate_price_tax ' + estimate_price_tax);

  $('#estimate_strprice_taxID').html($.number(estimate_price_tax, 2, ','));

  let estimate_totaltaxed = estimate_total + estimate_price_tax;
  $('#estimate_strtotaltaxedID').html($.number(estimate_totaltaxed, 2, ','));
}