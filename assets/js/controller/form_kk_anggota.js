function form_kk_anggota(config) {
	this.arrConfig = "";

	this.init = function() {
		
		$('.select2').select2({
		  ajax: {
		    url: 'http://localhost/workspace/gpdi-sulut-git-master/index.php/jem_data_jemaat/ajax_data_jemaat/',
		    dataType: 'json'
		    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
		  }
		});

	};

	this.init(config);
}	


$(document).ready(function () {
	var thisClass = new form_kk_anggota([]);
});