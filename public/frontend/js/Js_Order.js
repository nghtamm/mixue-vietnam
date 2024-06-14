var jsOrder = new Js_Order(baseUrl, "donhang");
jQuery(document).ready(function ($) {
    jsOrder.loadIndex();
});

function Js_Order(baseUrl, module, controller) {
    $("#main_register").attr("class", "active");
    this.module = module;
    this.baseUrl = baseUrl;
    this.controller = controller;
    this.urlPath = baseUrl + "/" + module + "/" + controller; //Biên public lưu tên module
}

//Load sự kiện màn hình index
Js_Order.prototype.loadIndex = function (oForm, page, perPage) {
    var myClass = this;
    var oForm = "form#frmRegister_index";
    // $(".chzn-select").chosen({ height: "100%", width: "100%" });
    myClass.loadList(oForm, page, perPage);
    // tim kiem
    $("#find-search").click(function () {
        var page = $(oForm).find("#_currentPage").val();
        var perPage = $(oForm).find("#cdan_nuber_record_page").val();
        myClass.loadList(oForm, page, perPage);
    });

    $(oForm)
        .find("#R_PERSON")
        .change(function () {
            myClass.loadList(oForm, page, perPage);
        });

    $(oForm)
        .find("#R_STATUS")
        .change(function () {
            myClass.loadList(oForm, page, perPage);
        });

    $("#txt_search").on("keypress", function (e) {
        /* ENTER PRESSED*/
        if (e.keyCode == 13) {
            var page = $(oForm).find("#_currentPage").val();
            var perPage = $(oForm).find("#cdan_nuber_record_page").val();
            myClass.loadList(oForm, page, perPage);
            return false;
        }
    });
};

//Load dữ liệu màn hình danh sách
Js_Order.prototype.loadList = function (oForm, currentPage = 1, perPage = 15) {
    var myClass = this;
    // var url = this.urlPath + "/loadList";
    var data = $(oForm).serialize();
    // var ownerParent = $(oForm).find("#R_PERSON").val();
    // var unit = $(oForm).find("#c_unitIndex").val();
    data += "&currentPage=" + currentPage;
    data += "&perPage=" + perPage;
    data += "&search=" + $(oForm).find("#txt_search").val();
    // data += "&ownerParent=" + ownerParent;
    // data += "&unit=" + unit;
    $.ajax({
        url: "donhang/loadList",
        type: "GET",
        data: data,
        success: function (arrResult) {
            $("#table-container").html(arrResult.html);
            // console.log(arrResult.pagination);
            // console.log(arrResult);
            // phan trang
            $("#pagination").html(arrResult.pagination);
            $(oForm)
                .find(".main_paginate .pagination a")
                .click(function () {
                    var page = $(this).attr("page");
                    var perPage = $("#cdan_nuber_record_page").val();
                    myClass.loadList(oForm, page, perPage);
                });
            $(oForm)
                .find("#cdan_nuber_record_page")
                .change(function () {
                    var page = $(oForm).find("#_currentPage").val();
                    var perPages = $(oForm)
                        .find("#cdan_nuber_record_page")
                        .val();
                    myClass.loadList(oForm, page, perPages);
                });
        },
    });
};

/**
 * Thông tin đơn hàng
 * @param id ID đơn hàng
 */
Js_Order.prototype.inforRecord = function (id) {
    $.ajax({
        url: "donhang/inforRecord",
        type: "GET",
        data: { id: id },
        success: function (result) {
            // console.log("test");
            $("#viewModal").html(result);
            $("#viewModal").modal("show");
            $("#tabRecordList").click(function () {
                Js_ViewRegister.records(id);
            });
        },
    });
};
