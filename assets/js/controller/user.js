function user(config) {
	this.arrConfig = "";

	this.init = function() {
		
		$('.select2').select2({
		  selectOnClose: true
		});

		$(".tu_tipe_user").change(function() {
			var val = $(this).val();
			

			$(".mw-dropdown").hide();
			$(".gem-dropdown").hide();

			if (val == 3) {
				$(".mw-dropdown").show();
			} else if (val == 5) {
				$(".gem-dropdown").show();
			}
		});

		var val = $(".tu_tipe_user").val();
		
		$(".mw-dropdown").hide();
		$(".gem-dropdown").hide();

		if (val == 3) {
			$(".mw-dropdown").show();
		} else if (val == 5) {
			$(".gem-dropdown").show();
		}
	};

	this.init(config);
}	


$(document).ready(function () {
	var userClass = new user([]);
});