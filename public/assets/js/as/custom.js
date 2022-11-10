// Datepicker
$('#birthday').datepicker({
    orientation: 'bottom',
    startView: 'month',
    format: 'yyyy-mm-dd'
});

// Select2
$("#education_qualification_id, #education_country_id").select2({"allowClear":true,"placeholder":{"id":"","text":"Please Select Option"}});
$("#skills").select2({"allowClear":true,"placeholder":{"id":"","text":"You can select more than one options"}});