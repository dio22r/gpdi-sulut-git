$(document).ready(function () {
	$(".datepicker").datepicker({
		orientation: "bottom auto",
		autoclose: true
	});



	if ($(".tgem_status_nikah").val() == "M") {
		$(".col-partner").show();
		console.log($(".tgem_status_nikah").val());
		
	} else {
		$(".col-partner").hide();
	}
	
	$(".tgem_status_nikah").change(function (e) {
		var inputvalue = $(this).val();

		if (inputvalue == "M") {
			$(".col-partner").show();
		} else {
			$(".col-partner").hide();
		}

	});
});
