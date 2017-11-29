var arsip_surat = {
	init: function() {
		// declare event for diteruskan kepada
		$("select[name='as_diteruskan']").change(function (e) {
			var val = $(this).val();
			if (val == "Lain-lain ...") {
				$(this).siblings(".hidden-warper").show();
			} else {
				$(this).siblings(".hidden-warper").hide();
			}
		});

		var as_diteruskan = $("select[name='as_diteruskan']").val();
		if (as_diteruskan == "Lain-lain ...") {
			$("select[name='as_diteruskan']").siblings(".hidden-warper").show();
		}


		// declare event for dengan hormat harap
		$("select[name='as_ket']").change(function (e) {
			var val = $(this).val();
			if (val == "Lain-lain ...") {
				$(this).siblings(".hidden-warper").show();
			} else {
				$(this).siblings(".hidden-warper").hide();
			}
		});

		var as_ket = $("select[name='as_ket']").val();
		if (as_ket == "Lain-lain ...") {
			$("select[name='as_ket']").siblings(".hidden-warper").show();
		}

		// deklarasi datepicker
		$( "#tgl-surat" ).datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});

		$( "#tgl-terima" ).datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
	},

	form_validation: function() {
		
	}
}