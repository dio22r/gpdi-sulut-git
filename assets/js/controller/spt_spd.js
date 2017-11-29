function spt_spd(config) {
	this.urlData = "";

	this.init = function(config) {
		that = this;
		this.urlData = config.urlData;
		console.log(this.urlData);
		$(".petugas").change(function (e) {
			id = $(this).val();

			console.log("id" + id);
			curentEl = $(this);
			that.load_data(id, curentEl);
		});

		// deklarasi datepicker
		$( "#tspt_tanggal" ).datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});

		$( "#tspt_tgl_berangkat" ).datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});


		$( "#tspt_tgl_kembali" ).datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});


		$( "#tspt_tgl_spd" ).datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
	};

	this.load_data = function(id, curentEl) {
		that = this;
		
		console.log(this.urlData);
		curentEl.siblings(".petugas-detail").fadeOut();

		$.ajax({
            type: "POST",
            url: this.urlData,
            data: {'id':id},
            dataType: "json",
            cache: false,
            success: function(data) {
                console.log(data);
                that.populate_data(data, curentEl);
            },
            error: function() {
                console.log("error");
            }
        });
		
	};

	this.populate_data = function(data, curentEl) {
		var thiselement = curentEl.siblings(".petugas-detail");
		thiselement.fadeIn();
		console.log(data);
		thiselement.find(".data-nip").html("<b>NIP. :</b> " + data.arr_data.ta_nip);
		thiselement.find(".data-pangkat").html("<b>Pangkat :</b> " + data.arr_data.ta_pangkat);
		thiselement.find(".data-jabatan").html("<b>Jabatan :</b> " + data.arr_data.ta_jabatan);

	};

	this.init(config);
}

$(document).ready(function() {
    var sptclass = new spt_spd(config);
});