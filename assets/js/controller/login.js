
var login = {
    isSuccess: false,
    fail: {
        title: "Login gagal",
        msg: "Password atau username salah",
        progress: "danger"
    },
    error: {
        title: "Error",
        msg: "Maaf terjadi kesalahan pada sistem, silahakan mencoba lagi",
        progress: "danger"
    },
    sending: {
        title: "Login sedang di proses",
        msg: "Harap menunggu, login sedang diproses",
        progress: "warning"
    },
    success: {
        title: "Login berhasil",
        msg:"Login berhasil, sedang diarahkan ke halaman anda",
        progress: "success"
    },

    /**
     * fungsi init dipanggil pada $(document).ready();
     * 
     * fungsi ini akan menginisialisasi event-event pada DOM
     * 
     * @return void
     */
    init: function() {
        that = this;
        
        $("button[name='submit']").click(function (e) {
            e.preventDefault();
            formData = that.get_form_data();
            that.check_data(formData);
        });
        

        $("input.textfield").keypress(function (e) {
            if (e.which == 13) {
                e.preventDefault();
                formData = that.get_form_data();
                that.check_data(formData);
            }
        });
    },
    
    get_form_data: function() {
        $("#myModal").modal({
            show: true
        });
        
        var formData = {
            login_username: $("input[name='login_username']").val(),
            login_password: $("input[name='login_password']").val()
        };
        
        return formData;
    },
    
    check_data: function(formData) {
        var url = BASEURL + "ajax/root_login_auth/login/";
        that = this;
        form_helper.show_msg(that.sending);
        $(".modal-footer").html('<a href="#" class="btn" data-dismiss="modal">Tutup</a>');
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    form_helper.show_msg(that.success);
                    $(".modal-footer").html('<a href="#" class="btn btn-primary">Oke, Login</a>');
                    window.location = data.url;                    
                } else {
                    form_helper.show_msg(that.fail);
                    $(".modal-footer").html('<a href="#" class="btn" data-dismiss="modal">Coba Lagi</a>');
                    $("input[name='password']").val("");
                }
            },
            error: function() {
                form_helper.show_msg(that.error);
                $(".modal-footer").html('<a href="#" class="btn" data-dismiss="modal">Coba Lagi</a>');
            }
        });
    }
    
};

/* aktifasi class login*/
$(document).ready(function() {
    login.init();
});
