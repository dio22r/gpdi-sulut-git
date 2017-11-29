function library_table(config) {
    this.tableurl = "";
    this.urlView = "";
    this.urisegmen = "";
    
    this.msg_empty = " -- Belum Ada Data -- ";
    this.searchfield = [];
    this.defaultfield = "";
    this._totalpage = 1;
    this.totalDisplayPage = 5;
    this.curPage = 0;
    this.tablehead = {};
    this.tabledata = {};
    
    this.selParent = "";
    this.elParent = {};
    
    this.ordertype = "ASC";
    this.orderfield = "";
    
    this.templateName = ".template";
    this.temlateProgress = ".template-progress";
    
    this.postval = {
        "searchfield": "",
        "searchdata": "",
        "ordertype": "",
        "orderfield": "",
        "page": 1,
        "perpage": 10
    };
    
    this.postval_session = null;
    this.postval_lastsend = null;
    
    this.init = function(config) {
        
        var that = this;
        $.each(config, function(index, val) {
            that[index] = val;
        });
        
        this.postval.searchfield = this.defaultfield;
        if (this.perpage != 0 && typeof this.perpage != "undefined"
            && this.perpage != ""
        ) {
            this.postval.perpage = this.perpage;
        }
        
        this._init_event();
    };
    
    this._init_event = function() {
        // init the table
        this._table_create();
        this._view_detail();
        
        var that = this;
        
        $("[name='g-tbl-searchdata']").keypress(function(e) {
            if (e.which == 13) {
                postval = that.load_data();
                postval.page = 1;
                that.send_data(postval);
            }
        });
        
        $("[name='g-tbl-search']").click(function() {
            postval = that.load_data();
            postval.page = 1;
            that.send_data(postval);
        });

        $("[name='g-tbl-clear']").click(function() {
            $("[name='g-tbl-searchdata']").val("");
            postval = that.load_data();
            postval.page = 1;
            that.send_data(postval);
        });
        
        
        $("[name='g-tbl-goto']").click(function() {
            postval = that.load_data();
            that.send_data(postval);
        });
        
        $(".g-tbl-next").live("click", function(e) {
            e.preventDefault();
            
            postval = that.load_data();
            postval.page += 1;
            
            if (postval.page > that._totalpage) {
                postval.page = that._totalpage;
            } else if (postval.page < 1) {
                postval.page = 1;
            }
            
            that.send_data(postval);
        });

        $(".g-tbl-prev").live("click", function(e) {
            e.preventDefault();
            
            postval = that.load_data();
            postval.page -= 1;

            if (postval.page > that._totalpage) {
                postval.page = that._totalpage;
            } else if (postval.page < 1) {
                postval.page = 1;
            }
            that.send_data(postval);
        });

        $(".g-tbl-act-page").live("click", function(e) {
            e.preventDefault();
            
            postval = that.load_data();
            postval.page = parseInt($(this).attr("data-show"));
            
            that.send_data(postval);
        });
        
        $("th.g-tbl-sort").click(function() {
            postval = that.load_data();
            postval.orderfield = $(this).attr("data-fieldname");
            tempOrderType = $(this).attr("data-fieldsort");
            if (tempOrderType == "ASC") {
                postval.ordertype = "DESC";
            } else {
                postval.ordertype = "ASC";
            }

            $(this).attr("data-fieldsort", postval.ordertype);
            that.send_data(postval);
        });
        
        that.show_sort_indicator(that.orderfield, that.ordertype);
        postval = this.load_data();
        that.send_data(this.postval);
    }
    
    this.show_sort_indicator = function(fieldname, ordertype) {
        $("th.g-tbl-sort[data-fieldname='"+fieldname+"'] > i").removeClass("hide");
        $("th.g-tbl-sort[data-fieldname='"+fieldname+"'] > i").removeAttr("style");
        
        if (ordertype == "ASC") {
            $("th.g-tbl-sort[data-fieldname='"+fieldname+"'] > i").removeClass("icon-chevron-up");
            $("th.g-tbl-sort[data-fieldname='"+fieldname+"'] > i").addClass("icon-chevron-down");
        } else {
            $("th.g-tbl-sort[data-fieldname='"+fieldname+"'] > i").removeClass("icon-chevron-down");
            $("th.g-tbl-sort[data-fieldname='"+fieldname+"'] > i").addClass("icon-chevron-up");
        }
    }
    
    this.hide_sort_indicator = function() {
        $("th.g-tbl-sort > i").addClass("hide");
    }
    
    this.send_data = function(postval) {
        var that = this;
        //console.log(postval);
        
        
        if (that.postval_lastsend != null) {
            if (that.helper_compere_obj(postval, that.postval_lastsend)) {
                return 0;
            }
        }
        
        $.ajax({
            url: that.tableurl,
            data: postval,
            type: "post",
            dataType: "JSON",
            success: function(json) {
                that.do_next(json);
                that.curPage = postval.page;
                
                that.hide_sort_indicator();
                that.show_sort_indicator(postval.orderfield, postval.ordertype);
                that.postval_lastsend = postval;
                
                that.ordertype = postval.ordertype;
                that.orderfield = postval.orderfield;
                
            },
            error: function() {
                that.fail_function();
            }
        });
    };

    this.helper_compere_obj = function(obj1, obj2) {
        var status = true;
        
        $.each(obj1, function(index, val) {
            if (val != obj2[index]) {
                status = false;
                return 0;
            }
        });
        return status;
    }
    
    this.load_data = function() {
        var postval = {};
        
        if (this.postval_session) {
            postval = this.postval_session;
            console.log(postval);
            this.postval_session = null;
            this.postval = postval;
            return postval;
        }
        
        postval.ordertype = this.ordertype;
        postval.orderfield = this.orderfield;
        postval.searchdata = $("[name='g-tbl-searchdata']").val();
        postval.perpage = this.postval.perpage;
        
        postval.page = 1;
        val = $("[name='g-tbl-page']").val();
        if (parseInt(val) == val) {
            postval.page = parseInt(val);
        }
        
        this.postval = postval;
        return postval;
    };
    
    this.do_next = function(json) {
        
        this._populate_form();
        
        // but data into rows
        this._append_data(json.data);
        this._totalpage = Math.ceil(json.total/this.postval.perpage);
        
        if (this._totalpage < 1) {
            this._totalpage = 1;
        }
        
        var pagination = this._create_pagination(this.postval.page, this.totalDisplayPage);
        $(".pagination").html(pagination);
        $(".g-tbl-total-page").html("/ " + this._totalpage);
        
        if ($("body").scrollTop() > 100) {
            $("body").animate( {"scrollTop":"0px"}, 1000);
        }
    };
    
    
    this._populate_form = function() {
        postval = this.postval;
        //console.log(postval);
        $("[name='g-tbl-searchdata']").val(postval.searchdata);
        $("[name='g-tbl-page']").val(postval.page);
        $("[name='g-tbl-perpage']").val(postval.perpage);        
    };
    
    /**
     * adding data into rows
     */
    this._append_data = function(json) {
        var that = this;
        
        var arrHtml = [];
        var html;
        
        if (json.length > 0) {
            $.each(json, function (index, value) {
                arrHtml.push(that._html_map_rows(value.id, value.cell));
            });
            html = arrHtml.join("\n");
        } else {
            html = '<tr><td colspan="'+that.tablehead.length+'">'+
                '<div class="alert center">'+ that.msg_empty +'</div>'+
                '</td></tr>';
        }
        $(this.selParent+" tbody").html(html);
        
        $(".tooltip-right").tooltip({
            placement: "right"
        });

        $(".tooltip-left").tooltip({
            placement: "left"
        });
        
        $(".tooltip-top").tooltip({
            placement: "top"
        });
        
        $(".tooltip-bottom").tooltip({
            placement: "bottom"
        });
    };
    
    
    
    this._get_uri = function() {
        
    };
    
    this.fail_function = function() {
        html = '<tr><td colspan="' +this.tablehead.length+ '">' +
            '<div class="alert alert-error center">' +
                ' -- <strong>Maaf</strong> terjadi kesalahan pada sistem. --' + 
            '</div>' +
            '</td></tr>';
        $(this.selParent+" tbody").html(html);
    };
    
    
    
    /*
     * popup detail 
     */
    this._view_detail = function() {
        var that = this;
        if (that.urlView) {
            $(".view-detail").live("click", function() {
                $("#myModal .modal-body").html($(that.temlateProgress).html());
                $("#myModal").modal({show: true});
                
                var id = $(this).attr("data-id");
                $.ajax({
                    url: that.urlView+"/"+id,
                    success: function(json) {
                        var html = $(that.templateName).html();
                        html = form_helper.prepare_display(html, json);
                        $("#myModal .modal-body").html(html);
                        $("#myModal .modal-footer a.btn").attr("href", json.hrefedit);
                        
                    },
                    error: function() {
                        $("#myModal .modal-body").find(".progress").addClass("progress-danger");
                    }
                });
            });
        } else {
            console.log("urlView is empty library_table line 239");
        }
    };
    

    /*
     * create table 
     */
    this._table_create = function() {
        var arrTh = this.tablehead;
        var theadHtml = this._html_map_theads(arrTh);
        
        $(".pagination").html(this._create_pagination(1, this.totalDisplayPage));
        
        $(this.selParent+" thead").html(theadHtml);
    };
    
    /*
     * create pagination
     */
    
    this._create_pagination = function(curpage, totaldisplay) {
        
        var start = curpage - Math.floor(totaldisplay/2);
        
        if (start < 1) {
            start = 1;
        }
        
        var end = start + totaldisplay - 1;
        if (end > this._totalpage) {
            end = this._totalpage;
            start = end - totaldisplay + 1;
            if (start < 1) {
                start = 1;
            }
        }
        
        var arrTempHtml = [];
        for (var i = start; i <= end; i++) {
            var tempclass = "";
            if (i == curpage) {
                tempclass = "active";
            }
            
            //console.log(i + tempclass + " " + curpage);
            
            var temp =
                '<li class="' + tempclass + '">' +
                    '<a class="g-tbl-act-page" href="#page'+i+'" data-show="'+i+'">' + i + '</a>' +
                '</li>';
            arrTempHtml.push(temp);
        }
        

        
        var html = 
        '<ul>' +
            '<li><a href="#" class="g-tbl-prev">Prev</a></li>' +
                arrTempHtml.join("\n") +
            '<li><a href="#" class="g-tbl-next">Next</a></li>' +
        '</ul>';
        
        return html;
    };
    
    
    this._html_map_theads = function(arrTh) {
        var arrHtml = [];
        var html = "";
        
        that = this;
        $.each(arrTh, function(index, val) {
            attr = that._html_helper_attr(val);
            html = '<th '+ attr.join(" ") +' >' +
                        '<i class="icon-chevron-up hide"></i> ' +
                        val.content +
                    '</th>';
            arrHtml.push(html);
        });
        
        html = '<tr>' + arrHtml.join("\n") + "</tr>";
        return html;
    };
    
    this._html_map_rows = function(id, row) {
        var arrHtml = [];
        var html = "";
        
        that = this;
        
        var attr = [];
        $.each(row, function(index, val) {
            var arrAttr = that.tablehead[index];
            attr = that._html_helper_attr(arrAttr);
            html = '<td '+ attr.join(" ") +'>' + val + '</td>';
            arrHtml.push(html);
        });
        
        html = '<tr data-row="'+id+'" class="i3-rows">' + arrHtml.join("\n") + "</tr>";
        return html;
    };
    
    this._html_helper_attr = function(arrAttr) {
        var arrReturn = [];
        
        $.each(arrAttr, function(key, data) {
            if (key != "content") {
                arrReturn.push(key+'="'+data+'"');   
            }
        });
        
        return arrReturn;
    };
    
    this._dropdown_option = function (arrData) {
        var arrHtml = [];
        $.each(arrData, function(value, display) {
            arrHtml.push("<option value='" + value + "'>"+ display +"</option>")
        });
        
        return arrHtml.join("\n");
    };
    
    this.init(config);
    
};
