// window.addEventListener('keydown', function(e) {
//     if (e.key === 'F12' || e.key === 'f12') {
//         e.preventDefault(); 
//     }
// });
// window.addEventListener('keydown', function(e) {
//     if (e.ctrlKey && e.key.toLowerCase() === 'u') {
//         e.preventDefault();
//     }
// });
// document.addEventListener("contextmenu", function(e) {
//     e.preventDefault();
// });

function hideModule(moduleId) {
    var module = document.getElementById(moduleId);
    module.style.display = 'none';
}

function showModule(moduleId) {
    var module = document.getElementById(moduleId);
    module.style.display = 'block';
}

function changetheme(id) {
    $.ajax({
        url: "../ajaxs/client/themex.php",
        method: "POST",
        dataType: "json",
        data: { id: id },
        success: (res) => {
            $("#btnMuster").prop("disabled", !1), $("#btnMuster").html('<i class="far fa-user-crown"></i>'), res.status ? Swal.fire("Thông báo", res.msg, "success") : Swal.fire("Thông báo", res.msg, "error");
            setTimeout(function () {
                location.reload();
            }, 1000); // 1000 milliseconds = 1 giây
        },
    });
}
function kuma() {
    var ul = $("#profile-ul");
    fetch("../api/v1/kuma")
        .then((response) => response.json())
        .then((res) => {
            if (!res.success) {
                Swal.fire("Thông báo", res.message, "error");
                return;
            }
            if (res.data.length === 0) {
                $("#nhiem-vu-ngay-button").hide();
                $("#diem-danh-button").hide();
                $("#datahisuer").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                $("#tableHistory").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                $("#tablePhone").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                $("#tableThongKe").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                $("#toptuan").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                
                $("#tabtoryuser").hide();
            } else {
                settinghome = res.data.setting;
                $("#tabtoryuser").hide();
                $("#nhiem-vu-ngay-button").hide();
                $("#diem-danh-button").hide();
                $("#datahisuer").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                $("#tableHistory").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                $("#list-game").html("");
                $("#toptuan").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                $("#tablePhone").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                $("#tableThongKe").html("");
                if (res.data.datahisuer.length > 0) {
                    $("#tabtoryuser").show();
                    loaddatahisuer(null, { success: true, data: res.data.datahisuer });
                }
                if (res.data.datahistory.length > 0) {
                    loadtableHistory(null, { success: true, data: res.data.datahistory });
                }
                if (res.data.arr_reshisgd.length > 0) {
                    loaddatahisgd(null, { success: true, data: res.data.arr_reshisgd });
                }
                if (res.data.datagame.length > 0) {
                    $("#list-game").html("");
                    res.data.datagame.forEach((datagame, index) =>
                        $("#list-game").append(
                            `<div style="padding: 5px"><button class="btn ${index === 0 ? "btn-primary" : "btn-outline-primary"} games" data-name="${datagame.name}" data-description="${datagame.description}" data-type="${datagame.gameType}"><b>${datagame.name}</b></button></div>`
                        ),
                      //  alert(${datagame.gameType})
                    );
                }
                if (res.data.dataphone.length > 0) {
                    loadtablePhone(null, { success: true, data: res.data.dataphone });
                }
                if (res.data.datatop.length > 0) {
                    $("#toptuan").html("");
                    res.data.datatop.forEach((datatop) =>
                        $("#toptuan").append(
                            `<tr><td class="text-white text-center">${datatop.id}</td><td class="text-white text-center">${datatop.phone}</td><td class="text-white text-center">${Intl.NumberFormat("en-US").format(datatop.money)}</td><td class="text-white text-center">${datatop.thuong} VNĐ</td></tr>`
                        )
                    );
                }

                if (res.data.dataeven.length > 0) {
                    for (const item of res.data.dataeven) {
                        if (item.key === 'nhiem-vu-ngay' && item.thuong && item.trangthai === 'run') {
                            $("#nhiem-vu-ngay-button").show();
                            const thuongData = item.thuong;
                            $("#nhiemvungay").html("");
                            for (let i = 1; i <= 5; i++) {
                                const mocKey = `moc${i}`;
                                const thuongKey = `thuong${i}`;
                                const mocValue = thuongData[mocKey];
                                const thuongValue = thuongData[thuongKey];
                                const formattedMoc = Intl.NumberFormat("en-US").format(parseFloat(mocValue));
                                const formattedThuong = Intl.NumberFormat("en-US").format(parseFloat(thuongValue));
                                $("#nhiemvungay").append(`
                                    <tr>
                                        <td>${formattedMoc}</td>
                                        <td><span class="text-success">+ ${formattedThuong} VNĐ</span></td>
                                    </tr>
                                `);
                            }
                        }
                        if (item.key === 'diem-danh' && item.trangthai === 'run') {
                            $("#diem-danh-button").show();
                        }
                    }
                }



            }
        })
        .catch((err) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${err}`, "error"));
}

function getReward(gameType) {
      //  var element = $('.btn.games.btn-primary');
        //$("#gameName").html(element.attr("data-name"));
        //  var  decodedHtml = $('<textarea/>').html(element.attr("data-description")).text();
        //   alert(element.attr("data-name"));
     //   $("#gameNoti").html(decodedHtml);
    gameType ||
        ((gameType = $(".games.btn-primary").data("type")),
            (gameName = $(".games.btn-primary").data("name")),
            (description = $(".games.btn-primary").data("description")),
             decodedHtml = $('<textarea/>').html(description).text(),
            
            $("#gameNoti").html(decodedHtml),
            $("#gameName").html(`${gameName} <span style="color: red;"></span>`)),
        $.post({
            url: "../api/v1/getReward",
            data: {
                gameType: gameType
            },
            dataType: "json"
        }).done((response) => {
            if (!response.success) return Swal.fire("Thông báo", response.message, "error");
            response.data.length
                ? $("#tableReward").html("") && $("#tableReward2").html("")
                : $("#tableReward").html('<tr><td colspan="12"><div class="text-center"><img src=""><p class="font-weight-bold">Vui lòng <span class="badge badge-success"><a class="nav-link" <a href="/client/dangki">Đăng Kí!</a>   </span> để xem...</p></div></td></tr>') && $("#tableReward2").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>'),
                response.data.map((data) => {
                     $("#tableReward").append(
                        `<tr><td class="text-white text-center">${data.displayName}</td><td class="text-white text-center">${data.code}</td><td class="text-white text-center">${data.content} <span class="badge badge-info copy-text" data-clipboard-text="${data.content}"><i class="fa fa-copy"></i></span> </td><td><span class="badge badge-info">${data.numberTLS.join('</span> - <span class="badge badge-info">')}</span></td><td class="text-white text-center"><strong><span style="color: red;">x</span> ${data.amount
                        }</strong></td></tr>`
                    );
             setTimeout(function(){
                  var element = $('.btn.games.btn-primary');
                //  alert(element.attr("data-name"));
        $("#gameName").html(element.attr("data-name"));
          var  decodedHtml = $('<textarea/>').html(element.attr("data-description")).text();
        $("#gameNoti").html(decodedHtml);
                });
             },200);        
       
        })
            .fail((error) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${error.statusText}`, "error"));
}
function handleDetail(data) {
    let status, isRefund;
    switch (data.status) {
        case "pending":
            status = '<span class="badge badge-primary">Đang xử lý</span>';
            break;
        case "success":
            status = '<span class="badge badge-success">Đã thanh toán</span>';
            break;
        case "limitBet":
            (isRefund = !0), (status = '<span class="badge badge-danger">Sai hạn mức</span>');
            break;
        case "errorComment":
            (isRefund = !0), (status = '<span class="badge badge-danger">Sai nội dung</span>');
            break;
        case "errorComment":
            status = '<span class="badge badge-danger">Giới hạn hoàn</span>';
            break;
        default:
            status = '<span class="badge badge-danger">Lỗi xử lý</span>';
    }
    isRefund ? $(".btn-refund").hasClass("d-none") && $(".btn-refund").removeClass("d-none") : !$(".btn-refund").hasClass("d-none") && $(".btn-refund").addClass("d-none"),
        $("#detailTransId").html(`#${data.transId}`),
        $("#tableDetails").html(
            `<tr>
        <td><b>Số tài khoản</b></td>
        <td class="text-secondary">${data.phone}</td>
        </tr>
        <tr>
        <td><b>Mã GD của bạn</b></td>
        <td class="text-info">${data.transId}</td>
        </tr>
        <tr>
        <td><b>Trạng Thái</b></td>
        <td class="text-info">${status}</td>
        </tr>
        <tr>
        <td><b>Trò chơi</b></td>
        <td class="text-warning">${data.gameName ? data.gameName : "Không xác định"
            }</td></tr><tr><td><b>Tiền cược</b></td><td class="text-secondary">${Intl.NumberFormat("en-US").format(data.amount)}đ</td></tr><tr><td><b>Nội dung</b></td><td class="text-info">${data.comment
            }</td></tr><tr><td><b>Tiền thắng</b></td><td class="text-secondary">${Intl.NumberFormat("en-US").format(data.bonus)}đ</td></tr><tr><td><b>Kết quả</b></td><td>${"CHIẾN THẮNG" == data.result ? '<span class="badge badge-success">Thắng</span>' : "THUA CUỘC" == data.result ? '<span class="badge badge-danger">Thua</span>' : '<span class="badge badge-warning">Không xác định</span>'
            }</td></tr><tr><td><b>Thời gian</b></td><td>${data.time}</td></tr>`
        ),
        $("#modalDetail").modal("show");
}

function numberFormat(number) {
    return number > 999 && number < 1e6 ? number / 1e3 + "K" : number >= 1e6 ? number / 1e6 + "M" : Intl.NumberFormat().format(number);
}

$(document).ready(function () {
    
      // Tạo một DOM element tạm để giải mã HTML entities hai lần
        function decodeHtml(encodedStr) {
            // Lần đầu giải mã chuỗi &lt;, &gt;, &amp;, v.v...
            let decoded = $('<textarea/>').html(encodedStr).text();
            // Giải mã lần hai cho các ký tự như \&quot; và các ký tự mã hóa khác còn lại
            decoded = $('<textarea/>').html(decoded).text();
            return decoded;
        }
     

     
    clipboard = new ClipboardJS(".copy-text"),
        clipboard.on("success", (e) => Swal.fire("Thông báo", `Sao chép thành công  ${e.text} `, "success")),
        $("body").on("click", ".games", function (e) {
            let _this = $(this);
            _this.removeClass("btn-outline-primary"),
                $(".games.btn-primary").removeClass("btn-primary").addClass("btn-outline-primary"),
                _this.addClass("btn-primary"),
                (gameName = _this.data("name")),
                (gameType = _this.data("type")),
                (description = _this.data("description")),
                 decodedHtml = $('<textarea/>').html(description).text(),
                $("#gameNoti").html(decodedHtml),
                $("#gameName").html(`${gameName} <span style="color: red;"></span>`),
                getReward(gameType);
        }),
        getReward('chan-le'),
        kuma(),
        $("#check_dayMis").on("click", function (e) {
            let phoneCheck = $('#checkMission [name="phoneCheck"]').val();
            phoneCheck
                ? phoneCheck.length < 3
                    ? Swal.fire("Thông báo", "Mã giao dịch không hợp lệ!", "error")
                    : $.ajax({
                        url: "../api/v1/getCount",
                        method: "POST",
                        dataType: "json",
                        data: { phone: phoneCheck },
                        beforeSend: () => {
                            $("#check_dayMis").prop("disabled", !0), $("#check_dayMis").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
                        },
                        success: (res) => {
                            if (($("#check_dayMis").prop("disabled", !1), $("#check_dayMis").html('<i class="fa fa-search"></i>'), !res.success))
                                return Swal.fire("Thông báo", res.message, "error"), void (response.success && ($(".money-day").removeClass("d-none") && $(".money-day").html(`${Intl.NumberFormat("en-US").format(response.count)} VNĐ`)));
                            handleDetail(res.data);
                        },
                    })
                : Swal.fire("Thông báo", "Vui lòng nhập đầy đủ thông tin!", "warning");
        }),
        $("#checkByTransidd").on("click", function (e) {
            let transId = $('#checkByTrans [name="transId"]').val();
            transId
                ? transId.length < 8
                    ? Swal.fire("Thông báo", "Mã giao dịch không hợp lệ!", "error")
                    : $.ajax({
                        url: "../api/v1/checkTransId",
                        method: "POST",
                        dataType: "json",
                        data: { transId: transId },
                        beforeSend: () => {
                            $("#checkByTransidd").prop("disabled", !0), $("#checkByTransidd").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
                        },
                        success: (res) => {
                            if (($("#checkByTransidd").prop("disabled", !1), $("#checkByTransidd").html('<i class="fa fa-search"></i>'), !res.success))
                                return Swal.fire("Thông báo", res.message, "error"), void (res.data && ($("#checkByTrans").addClass("d-none")));
                            handleDetail(res.data);
                        },
                    })
                : Swal.fire("Thông báo", "Vui lòng nhập đầy đủ thông tin!", "warning");
        }),
        $("#exploding").on("click", function (e) {
            let transId = $('#checkNoHu [name="transId"]').val();
            transId
                ? transId.length < 6
                    ? Swal.fire("Thông báo", "Mã giao dịch không hợp lệ!", "error")
                    : $.ajax({
                        url: "../api/v1/tamhpatuquy",
                        method: "POST",
                        dataType: "json",
                        data: { transId: transId },
                        beforeSend: () => {
                            $("#exploding").prop("disabled", !0), $("#exploding").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
                        },
                        success: (res) => {
                            $("#exploding").prop("disabled", !1), $("#exploding").html('<i class="far fa-gift"></i>'), res.success ? Swal.fire("Thông báo", res.message, "success") : Swal.fire("Thông báo", res.message, "error");
                        },
                    })
                : Swal.fire("Thông báo", "Vui lòng nhập đầy đủ thông tin!", "warning");
        });
        $("body").on("click", ".qrc", function () {
            var img = $("<img>");
            var data = $(this).attr('data-content');
            var md = $('#qr-download').attr("mobile-device");
            // var imageUrl = 'https://api.vietqr.io/' + $(this).attr('data-bankname') + '/' + $(this).attr('data-stk') + '/20000/' + $(this).attr('data-nd') + '/vietqr_net_2.jpg?accountName=' + $(this).attr('data-ctk');
            var imageUrl = 'https://img.vietqr.io/image/' + $(this).attr('data-bankname') + '-' + $(this).attr('data-stk') + '-compact.png?addInfo=' ;
            img.attr("src", imageUrl);
            img.css({
                width: 300,
                height: 300
            });
            $("#canvasQr").html("");
           // $("#canvasQr").append(img);
        });
        $("body").on("click", "#qr-reg", function () {
            var selectednoidungchoi = $("#noidungchoi option:selected").val();
            var selectedDaBankName = $("#dabankname option:selected").val();
        
            if (selectednoidungchoi && selectedDaBankName) {
                
                var values = selectedDaBankName.split('|');
                var bankname = values[0];
                var stk = values[1];
                
                var imageUrl = 'https://img.vietqr.io/image/' + bankname + '-' + stk + '-compact.png?addInfo='+settinghome.ndchoi+' '+selectednoidungchoi;
                var img = $("<img>").attr("src", imageUrl).css({ width: 300, height: 300 });
        
               // $("#canvasQr").html("").append(img);
            } else {
                alert("Please select a Game and Bank Name before generating the QR code.");
            }
        });
    $("body").on("click", "#check-giftCode", function (e) {
        let giftcode = $('input[name="giftcode"]').val();
        let phone = $('input[name="phoneCode"]').val();
        if (!giftcode) return Swal.fire("Thông báo", "Vui lòng nhập mã GiftCode!");
        if (!phone) return Swal.fire("Thông báo", "Vui lòng nhập Nickname đã tham gia!");
        $.ajax({
            url: "../api/v1/giftcode/check",
            method: "POST",
            dataType: "json",
            data: { giftcode: giftcode, phone: phone },
            beforeSend: () => {
                $("#check-giftCode").prop("disabled", !0), $("#check-giftCode").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
            },
            success: (res) => {
                $("#check-giftCode").prop("disabled", !1), $("#check-giftCode").html('<i class="far fa-gift"></i>'), res.success ? Swal.fire("Thông báo", res.message, "success") : Swal.fire("Thông báo", res.message, "error");
            },
        });
    });
    $("body").on("click", "#btnMuster", function (e) {
        let phone = $('input[name="phoneMuster"]').val();
        if (!phone) return Swal.fire("Thông báo", "Vui lòng nhập Nickname đã tham gia!");
        $.ajax({
            url: "../api/v1/diemdanh",
            method: "POST",
            dataType: "json",
            data: { phone: phone },
            beforeSend: () => {
                $("#btnMuster").prop("disabled", !0), $("#btnMuster").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
            },
            success: (res) => {
                $("#btnMuster").prop("disabled", !1), $("#btnMuster").html('<i class="far fa-user-crown"></i>'), 
                res.success ? Swal.fire("Thông báo", res.message, "success") : Swal.fire("Thông báo", res.message, "error");
            },
        });
    });
    $("#checkHistoryUserIDButton").on("click", function() {
        $('#checkHistoryUserIDButton').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "../ajaxs/client/auth.php",
            method: "POST",
            dataType: "JSON",
            data: { action: 'Login',
                usernicknamelog: $("#useridd").val() ,pass : $("#pass").val()},
            success: function(respone) {
                if (respone.status == 'success') {
                    Swal.fire("Thông báo", `Thành công  ${respone.msg} `, "success").then((result) => {
                        if (result.isConfirmed) {
                            location.href = '/';
                        }
                    });
                    location.href = '/';
                } else {
                    Swal.fire("Thông báo", respone.msg, "error")
                }
                $('#checkHistoryUserIDButton').html('Xác Nhận').prop('disabled', false);
            },
            error: function() {
                Swal.fire("Thông báo", 'Không thể xử lý', "error")
                $('#checkHistoryUserIDButton').html('Xác Nhận').prop('disabled', false);
            }
        });
    });
    $("#loginbutton").on("click", function() {
        $('#loginbutton').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "../ajaxs/client/auth.php",
            method: "POST",
            dataType: "JSON",
            data: { action: 'Login',
                usernicknamelog: $("#usernicknamelog").val(),pass : $("#pass").val() },
            success: function(respone) {
                if (respone.status == 'success') {
                    Swal.fire("Thông báo", `Thành công  ${respone.msg} `, "success").then((result) => {
                        if (result.isConfirmed) {
                            location.href = '/';
                        }
                    });
                    location.href = '/';
                } else {
                    Swal.fire("Thông báo", respone.msg, "error")
                }
                $('#loginbutton').html('Xác Nhận').prop('disabled', false);
            },
            error: function() {
                Swal.fire("Thông báo", 'Không thể xử lý', "error")
                $('#loginbutton').html('Xác Nhận').prop('disabled', false);
            }
        });
    });
    $("#Registerbutton").on("click", function() {
        $('#Registerbutton').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "../ajaxs/client/auth.php",
            method: "POST",
            dataType: "JSON",
            data: { action: 'Register',
                nickbankcode: $("#nickbankcode").val(),
                nickstk: $("#nickstk").val(),
                usernickname: $("#usernickname").val(),
                pass : $("#pass").val(),
                accname : $("#accName").val(),
                confirmPass : $("#confirmPass").val(),
                agentCode : $("#agentCode").val()
            },
               
            success: function(respone) {
                if (respone.status == 'success') {
                    Swal.fire("Thông báo", `Thành công  ${respone.msg} `, "success").then((result) => {
                        if (result.isConfirmed) {
                            location.href = '/';
                        }
                    });
                    location.href = '/';
                } else {
                    Swal.fire("Thông báo", respone.msg, "error")
                }
                $('#Registerbutton').html('Xác Nhận').prop('disabled', false);
            },
            error: function() {
                Swal.fire("Thông báo", 'Không thể xử lý', "error")
                $('#Registerbutton').html('Xác Nhận').prop('disabled', false);
            }
        });
    });
        var element = $('.btn.games.btn-primary');
        $("#gameName").html(element.attr("data-name"));
          var  decodedHtml = $('<textarea/>').html(element.attr("data-description")).text();
         $("#gameNoti").html(decodedHtml);
   
    
});
