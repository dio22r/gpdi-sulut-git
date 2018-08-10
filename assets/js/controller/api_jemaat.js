
$( document ).ready( function () {
	var val = 0;
	$('#myModal').modal({show: false});

	$(".delete").click(function () {
		val = $(this).attr("data-id");

		$.ajax({
		  method: "GET",
		  url: apiUrlProfileJemaat + "/" + val,
		})
	  	.done(function( msg ) {
	    	$(".data-nama").html(msg.tj_nama);
	    	$(".data-tgl-lahir").html(msg.tj_tgl_lahir);
	    	$(".data-umur").html(msg.age);
	    	$(".data-jk").html(msg.tj_jk);
	    	$(".data-gereja").html(msg.tg_nama);

	    	$(".tj_id").val(msg.tj_id);
	  });
	});

	$("#tjm_tipe").change(function (e) {
	var val = $(this).val();

	switch(val) {
		case "1":
			$(".tjm_tgl_mutasi").html("Tgl. Meninggal");
			$(".tjm_tgl_mutasi").show();
			break;

		case "2":
			$(".tjm_tgl_mutasi").html("Tgl. Pindah");
			$(".tjm_tgl_mutasi").show();
			break;

		case "3":
			$(".tjm_tgl_mutasi").html("Tgl. Pindah");
			$(".tjm_tgl_mutasi").show();
			break;

		case "4":
			$(".tjm_tgl_mutasi").html("Tgl. Pindah");
			$(".tjm_tgl_mutasi").show();
			break;

		case "5":
			$(".tjm_tgl_mutasi").html("Tgl. Mutasi");
			break;

		default:
	}
  });



	$(".datepicker").datepicker({
		orientation: "bottom auto",
		autoclose: true,
	});
	$(".datepicker").datepicker("setDate", "-0d")
  //console.log(apiUrlProfileJemaat);

});
