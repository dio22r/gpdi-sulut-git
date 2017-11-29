function library_crud(config) {
    
    this.urlSave = "";
    this.templateName = ".template";
    this.temlateProgress = ".template-progress";
    
    this.msg = {
        fail: {
            title: "Gagal",
            msg: "Tindakan Gagal",
            progress: "danger"
        },
        error: {
            title: "Error",
            msg: "Maaf terjadi kesalahan pada sistem, silahkan mencoba lagi",
            progress: "danger"
        },
        sending: {
            title: "Sedang diproses",
            msg: "Harap menunggu, tindakan sedang diproses",
            progress: "warning"
        },
        success: {
            title: "Berhasil",
            msg:"Sedang diarahkan ke halaman sebelumnya",
            progress: "success"
        }
    };
    
    /**
     * fungsi constructor dipanggil pada $(document).ready();
     * 
     * fungsi ini akan menginisialisasi class property
     * 
     * @return void
     */
    this.init = function(config) {
        var thatform = this;
        $.each(config, function(key, value) {
            thatform[key] = value;
        });
    };
    
    this.init_form = function() {
        var thatform = this;
        
        $("button[name='submit']").click(function (e) {
            e.preventDefault();
            $("#myModal").modal({
                show: true
            });
            var formData = new FormData(this.form);
            //var formData = $(this.form).serialize();
            thatform.submit_data(formData);
        });
    };
    
    this.submit_data = function(formData) {
        var url = this.urlSave;
        thatform = this;
        console.log(formData);
        form_helper.show_msg(this.msg.sending);
        
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "json",
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    form_helper.show_msg(thatform.msg.success);
                    $(".modal-footer").html('<a href="#" class="btn btn-primary">Oke</a>');
                    window.location = data.url;                    
                } else {
                    var objMsg = thatform.msg.fail;
                    if (typeof data.msg != "undefined") {
                        objMsg.msg = data.msg
                    }
                    form_helper.show_msg(objMsg);
                    $(".modal-footer").html('<a href="#" class="btn" data-dismiss="modal">Coba Lagi</a>');
                }
            },
            error: function() {
                form_helper.show_msg(thatform.msg.error);
                $(".modal-footer").html('<a href="#" class="btn" data-dismiss="modal">Coba Lagi</a>');
            }
        });
    };
    
    this.init(config);
};