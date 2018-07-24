function form_kk_anggota(config) {
	this.arrConfig = "";

	this.init = function() {
		$(".tambah-data").click(function () {
			$(".form-kelompok").fadeIn();
		});
	};

	this.init(config);
}	


$(document).ready(function () {
	var thisClass = new form_kk_anggota([]);
});