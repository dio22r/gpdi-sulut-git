function simple_form(config) {
	this.arrConfig = "";

	this.init = function() {
		
		$('.select2').select2({
		  selectOnClose: true
		});
	};

	this.init(config);
}	

$(document).ready(function () {
	var splfrClass = new simple_form([]);
});