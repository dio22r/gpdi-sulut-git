// jquery is required


var form_helper = {
    /**
     * dropdown_option berfungsi untuk mengubah json ke html
     * 
     * @param json arrData contoh {1:"malang",4:"batu"}
     *  
     * @returns string html option
     */

    dropdown_option: function (arrData) {
        var arrHtml = [];
        $.each(arrData, function(value, display) {
            arrHtml.push("<option value='" + value + "'>"+ display +"</option>")
        });
        
        return arrHtml.join("\n");
    },
    
    show_msg: function(data) {
        $(".modal-body .progress").removeClass("progress-danger");
        $(".modal-body .progress").removeClass("progress-warning");
        $(".modal-body .progress").removeClass("progress-success");
        $(".modal-body .alert").removeClass("alert-danger");
        $(".modal-body .alert").removeClass("alert-warning");
        $(".modal-body .alert").removeClass("alert-success");
        
        $(".modal-body .alert").addClass("alert-" + data.progress);
        $(".modal-body .progress").addClass("progress-" + data.progress);
        
        $(".modal-header h3").html(data.title);
        $(".modal-body .alert").html(data.msg);
    },
    
    prepare_display: function(html, arrData) {
        
        $.each(arrData, function(key, data) {
            html = html.replace("<!--"+key+"-->", data);
        });
        
        return html;
    },
    
    populate_bytagname: function(form, arrData) {
        $.each(arrData, function(key, data) {
            html = form.find('[name="'+key+'"]').val(data);
        });
    }
};
