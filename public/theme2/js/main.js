let musterTime = setInterval(function () {
    countTimer();
}, 1e3);
function getPhone() {
    fetch("../api/v1/getPhone")
    .then((response) => response.json())
    .then((res) => {
        if (!res.success) return Swal.fire("Thông báo", res.message, "error");
        res.data.length
        ? $("#tablePhone").html("") && $("#tableThongKe").html("")
        : $("#tablePhone").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>') &&
        $("#tableThongKe").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
        let gameType = $(".games.btn-primary").data("type");
        res.data.map((dataPhone) => {
            "active" == dataPhone.status &&
            (dataPhone.amountDay + 2 * dataPhone.betMax >= dataPhone.limitDay || dataPhone.amountMonth + 2 * dataPhone.betMax >= dataPhone.limitMonth || dataPhone.count + 10 >= dataPhone.number) &&
            (dataPhone.status = "pendingStop"),
            $("#tablePhone").append(
                `<tr><td>${dataPhone.phone} <span class="badge badge-info copy-text" data-clipboard-text="${dataPhone.phone}"><i class="fas fa-copy"></i></span><br><small><b><span class="text-success">${Intl.NumberFormat(
                    "en-US"
                    ).format(dataPhone.amountDay)}</span>/<span class="text-primary">${numberFormat(dataPhone.limitDay)}</span> ~ <span class="text-info">${dataPhone.count}</span>/<span class="text-primary">${dataPhone.number}</span>${
                    dataPhone.bonus > 1 && "CL_Game" == gameType ? ` ~ <strong><span style="color: red;">x</span> ${dataPhone.bonus}</strong>` : ""
                }</b></small></td><td>${Intl.NumberFormat("en-US").format(dataPhone.betMin)} VNĐ</td><td>${Intl.NumberFormat("en-US").format(dataPhone.betMax)} VNĐ</td><td>${
                    "success" == dataPhone.status
                    ? '<span class="badge badge-success">Hoạt động</span>'
                    : "pendingStop" == dataPhone.status
                    ? '<span class="badge badge-warning">Sắp bảo trì</span>'
                    : '<span class="badge badge-danger">Bảo trì</span>'
                }</td></tr>`
                ),
            $("#tableThongKe").append(
                `<tr><td>${dataPhone.phone} <span class="badge badge-info copy-text" data-clipboard-text="${dataPhone.phone}"><i class="fas fa-copy"></i></span></td><td>${dataPhone.name}</td><td><span class="${
                    "active" == dataPhone.status ? "text-success" : "text-danger"
                }">${Intl.NumberFormat("en-US").format(dataPhone.amountDay)}</span>/${Intl.NumberFormat("en-US").format(dataPhone.limitDay)}</td><td><span class="${
                    "active" == dataPhone.status ? "text-success" : "text-danger"
                }">${Intl.NumberFormat("en-US").format(dataPhone.count)}</span>/${Intl.NumberFormat("en-US").format(dataPhone.number)}</td></tr>`
                );
        });
    })
    .catch((err) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${err}`, "error"));
}
function getHistory() {
    fetch("../api/v1/getHistory")
    .then((response) => response.json())
    .then((res) => {
        if (!res.success) return Swal.fire("Thông báo", res.message, "error");
        res.data.length
        ? $("#tableHistory").html("")
        : $("#tableHistory").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>'),
        res.data.map((data) =>
            $("#tableHistory").append(
                `<tr><td>${new Date(data.time).toLocaleString()}</td><td>${data.phone}</td><td>${data.tranId}</td><td>${data.tranIdsite}</td><td>${Intl.NumberFormat("en-US").format(data.money)}</td><td>${Intl.NumberFormat("en-US").format(data.bonus)}</td><td>${
                    data.gameName
                }</td><td><span class="badge badge-primary">${data.content.toUpperCase()}</span></td><td><span class="badge badge-success">Thắng</span></td><td><span class="badge badge-primary">${data.dscr}</span></td></tr>`
                )
            );
    })
    .catch((err) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${err}`, "error"));
}
function getReward(gameType) {
    gameType ||
    ((gameType = $(".games.btn-primary").data("type")),
        (gameName = $(".games.btn-primary").data("name")),
        (description = $(".games.btn-primary").data("description")),
        $("#gameNoti").html(description),
        $("#gameName").html(`Cách Chơi ${gameName}`)),
    $.post({
        url: "../api/v1/getReward",
        data: {
            gameType: gameType
        },
        dataType: "json"
    }).done((response) => {
        if (!response.success) return Swal.fire("Thông báo", response.message, "error");
        response.data.length
        ? $("#tableReward").html("")
        : $("#tableReward").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>'),
        response.data.map((data) => {
            $("#tableReward").append(
                `<tr><td><b>${data.content}</b></td><td><span class="badge badge-info">${data.numberTLS.join('</span> - <span class="badge badge-info">')}</span></td><td><strong><span style="color: red;">x</span> ${
                    data.amount
                }</strong></td></tr>`
                );
        });
    })
    .fail((error) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${error.statusText}`, "error"));
}

function handleDetail(data) {
    let status, isRefund;
    switch (data.status) {
        case "wait":
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
        <td><b>Số điện thoại</b></td>
        <td class="text-secondary">${data.phone}</td>
        </tr>
        <tr>
        <td><b>Mã GD của bạn</b></td>
        <td class="text-info">${data.transId}</td>
        </tr>
        <tr>
        <td><b>Mã GD của chúng tôi</b></td>
        <td class="text-info">${data.randid}</td>
        </tr>
        <tr>
        <td><b>Tổng mã giao dịch</b></td>
        <td class="text-info">${data.tranIdsite}</td>
        </tr>
        <tr>
        <td><b>Trạng Thái</b></td>
        <td class="text-info">${status}</td>
        </tr>
        <tr>
        <td><b>Trò chơi</b></td>
        <td class="text-warning">${
            data.gameName ? data.gameName : "Không xác định"
        }</td></tr><tr><td><b>Tiền cược</b></td><td class="text-secondary">${Intl.NumberFormat("en-US").format(data.amount)}đ</td></tr><tr><td><b>Nội dung</b></td><td class="text-info">${
            data.comment
        }</td></tr><tr><td><b>Tiền thắng</b></td><td class="text-secondary">${Intl.NumberFormat("en-US").format(data.bonus)}đ</td></tr><tr><td><b>Kết quả</b></td><td>${
            "CHIẾN THẮNG" == data.result ? '<span class="badge badge-success">Thắng</span>' : "THUA CUỘC" == data.result ? '<span class="badge badge-danger">Thua</span>' : '<span class="badge badge-warning">Không xác định</span>'
        }</td></tr><tr><td><b>Thời gian</b></td><td>${data.time}</td></tr>`
        ),
    $("#modalDetail").modal("show");
}
function getGame() {
    fetch("../api/v1/getGame")
    .then((response) => response.json())
    .then((res) => {
        if (!res.success) return Swal.fire("Thông báo", res.message, "error");
        $("#list-game").html(""),
        res.data.map((data, index) =>
            $("#list-game").append(
                `<div style="padding: 5px"><button class="btn ${0 == index ? "btn-primary" : "btn-outline-primary"} games" data-name="${data.name}" data-description="${data.description}" data-type="${data.gameType}" ><b>${
                    data.name
                }</b></button></div>`
                )
            );
    })
    .catch((err) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${err}`, "error"));
}
function numberFormat(number) {
    return number > 999 && number < 1e6 ? number / 1e3 + "K" : number >= 1e6 ? number / 1e6 + "M" : Intl.NumberFormat().format(number);
}
function countTimer() {
    let second = $("#muster-time").html();
    if (second < 1) return clearInterval(musterTime), $("#muster-time").html(0);
    $("#muster-time").html(second - 1);
}
$(document).ready(function () {
    const pusher = new Pusher(appKey, { cluster: "ap1" }),
    Toast = Swal.mixin({
        toast: !0,
        position: "top-end",
        showConfirmButton: !1,
        timer: 2e3,
        timerProgressBar: !0,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer), toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    }),
    clipboard = new ClipboardJS(".copy-text"),
    channel = pusher.subscribe("appPusher");
    $(".select2").select2(),
    setInterval(getPhone, 18e4),
    clipboard.on("success", (e) => Swal.fire("Thông báo", `Sao chép thành công  ${e.text} `, "success")),
    channel.bind("historyData", (data) => {
        data.length
        ? $("#tableHistory").html("")
        : $("#tableHistory").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>'),
        data.map((history) =>
            $("#tableHistory").append(
                `<tr><td>${history.time}</td><td>${history.phone}</td><td>${Intl.NumberFormat("en-US").format(history.money)}</td><td>${Intl.NumberFormat("en-US").format(history.bonus)}</td><td>${
                    history.gameName
                }</td><td><span class="badge badge-primary">${history.content.toUpperCase()}</span></td><td><span class="badge badge-success">Thắng</span></td></tr>`
                )
            );
    }),
    channel.bind("phoneData", (data) => {
        let gameType = $(".games.btn-primary").data("type");
        data.length
        ? $("#tablePhone").html("") && $("#tableThongKe").html("")
        : $("#tablePhone").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>') &&
        $("#tableThongKe").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>'),
        data.map((dataPhone) => {
            "active" == dataPhone.status &&
            (dataPhone.amountDay + 2 * dataPhone.betMax >= dataPhone.limitDay || dataPhone.amountMonth + 2 * dataPhone.betMax >= dataPhone.limitMonth || dataPhone.count + 10 >= dataPhone.number) &&
            (dataPhone.status = "pendingStop"),
            $("#tablePhone").append(
                `<tr><td>${dataPhone.phone} <span class="badge badge-info copy-text" data-clipboard-text="${dataPhone.phone}"><i class="fas fa-copy"></i></span><br><small><b><span class="text-success">${Intl.NumberFormat(
                    "en-US"
                    ).format(dataPhone.amountDay)}</span>/<span class="text-primary">${numberFormat(dataPhone.limitDay)}</span></span> ~ <span class="text-info">${dataPhone.count}</span>/<span class="text-primary">${
                    dataPhone.number
                }</span>${dataPhone.bonus > 1 && "CL_Game" == gameType ? ` ~ <strong><span style="color: red;">x</span> ${dataPhone.bonus}</strong>` : ""}</b></small></td><td>${Intl.NumberFormat("en-US").format(
                    dataPhone.betMin
                    )} VNĐ</td><td>${Intl.NumberFormat("en-US").format(dataPhone.betMax)} VNĐ</td><td>${
                    "active" == dataPhone.status
                    ? '<span class="badge badge-success">Hoạt động</span>'
                    : "pendingStop" == dataPhone.status
                    ? '<span class="badge badge-warning">Sắp bảo trì</span>'
                    : '<span class="badge badge-danger">Bảo trì</span>'
                }</td></tr>`
                ),
            $("#tableThongKe").append(
                `<tr><td>${dataPhone.phone} <span class="badge badge-info copy-text" data-clipboard-text="${dataPhone.phone}"><i class="fas fa-copy"></i></span></td><td><span class="${
                    "active" == dataPhone.status ? "text-success" : "text-danger"
                }">${Intl.NumberFormat("en-US").format(dataPhone.amountDay)}</span>/${Intl.NumberFormat("en-US").format(dataPhone.limitDay)}</td><td><span class="${
                    "active" == dataPhone.status ? "text-success" : "text-danger"
                }">${Intl.NumberFormat("en-US").format(dataPhone.count)}</span>/${Intl.NumberFormat("en-US").format(dataPhone.number)}</td></tr>`
                );
        });
    }),
    channel.bind("gameData", (data) => {
        data.length &&
        ($("#list-game").html(""),
            data.map((data, index) =>
                $("#list-game").append(
                    `<div style="padding: 5px"><button class="btn ${0 == index ? "btn-primary" : "btn-outline-primary"} games" data-name="${data.name}" data-description="${data.description}" data-type="${data.gameType}"><b>${
                        data.name
                    }</b></button></div>`
                    )
                ),
            getReward());
    }),
    channel.bind("rewardData", (data) => {
        let gameType = $(".games.btn-primary").data("type");
        if (data == gameType) return getReward(gameType);
    }),
    channel.bind("notiWin", (data) => {
        data && Toast.fire({ icon: "success", title: `Chúc mừng <b>${data.phone}</b> đã thắng ${Intl.NumberFormat("en-US").format(data.amount)}đ` });
    }),
    $("body").on("click", ".games", function (e) {
        let _this = $(this);
        _this.removeClass("btn-outline-primary"),
        $(".games.btn-primary").removeClass("btn-primary").addClass("btn-outline-primary"),
        _this.addClass("btn-primary"),
        (gameName = _this.data("name")),
        (gameType = _this.data("type")),
        (description = _this.data("description")),
        $("#gameNoti").html(description),
        $("#gameName").html(`Cách Chơi ${gameName}`),
        getReward(gameType),
        getPhone();
    }),
    getPhone(),
    getReward(),
    getHistory(),
    $("#checkMission button").on("click", function (e) {
        let phoneCheck = $('#checkMission [name="phoneCheck"]').val();
        console.log(phoneCheck),
        $.post("../api/v1/getCount", { phone: phoneCheck })
        .done((response) => {
            response.success ? Swal.fire("Thông báo", response.message, "success") : Swal.fire("Thông báo", response.message, "error"),
            response.success && $(".money-day").removeClass("d-none") && $(".money-day").html(`${Intl.NumberFormat("en-US").format(response.count)} VNĐ`);
        })
        .fail((error) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${error.statusText}`, "error"));
    }),
    $('.form-jackpot [name="phone"]').on("change", function (e) {
        let phone = $('.form-jackpot [name="phone"]').val();
        $("div.form-jackpot>div.message").html(""),
        $.post("../api/v1/jackpot/checkJoin", { phone: phone })
        .done((res) => {
            if (!res.success) return $("div.form-jackpot>div.message").html(`<div class="alert alert-warning">${res.message}</div>`);
            let data = res.data;
            0 == data.isJoin || -1 == data.isJoin ? $(".form-jackpot div.input-group-append").html('<button class="btn btn-primary btn-join">Tham gia</button>') : $(".form-jackpot div.input-group-append").html('<button class="btn btn-danger btn-out">Hủy tham gia</button>'),
            0 == data.isJoin ? !$(".jackpot-time").hasClass("d-none") && $(".jackpot-time").addClass("d-none") : $(".jackpot-time").hasClass("d-none") && $(".jackpot-time").removeClass("d-none"),
            0 != data.isJoin && (1 == data.isJoin ? $(".jackpot-time").html(`Thời gian tham gia nổ hũ: <strong>${data.time}</strong>`) : $(".jackpot-time").html(`Thời gian hủy tham gia nổ hũ: <strong>${data.time}</strong>`));
        })
        .fail((error) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${error.statusText}`, "error"));
    }),
    $("#checkByTrans button").on("click", function (e) {
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
              $("#checkByTrans button").prop("disabled", !0), $("#checkByTrans button").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
          },
          success: (res) => {
              if (($("#checkByTrans button").prop("disabled", !1), $("#checkByTrans button").html('<i class="fa fa-search"></i>'), !res.success))
                  return Swal.fire("Thông báo", res.message, "error"), void (res.data && ($("#checkByTrans").addClass("d-none"), $("#checkByPhone").removeClass("d-none"), $('#checkByPhone [name="transId"]').val(transId)));
              handleDetail(res.data);
          },
      })
        : Swal.fire("Thông báo", "Vui lòng nhập đầy đủ thông tin!", "warning");
    }),
    $("#checkByPhone button").on("click", function (e) {
        let transId = $('#checkByPhone [name="transId"]').val(),
        phone = $('#checkByPhone [name="phoneCheck"]').val();
        transId && phone
        ? transId.length < 8
        ? Swal.fire("Thông báo", "Mã giao dịch không hợp lệ!", "error")
        : $.ajax({
          url: "../api/v1/checkTransId",
          method: "POST",
          dataType: "json",
          data: { phone: phone, transId: transId },
          beforeSend: () => {
              $("#checkByPhone button").prop("disabled", !0), $("#checkByPhone button").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
          },
          success: (res) => {
              if (($("#checkByPhone button").prop("disabled", !1), $("#checkByPhone button").html('<i class="fa fa-search"></i>'), !res.success)) return Swal.fire("Thông báo", res.message, "error");
              $("#checkByTrans").removeClass("d-none") && $("#checkByPhone").addClass("d-none"), handleDetail(res.data);
          },
      })
        : Swal.fire("Thông báo", "Vui lòng nhập đầy đủ thông tin!", "warning");
    }),
    $("body").on("click", ".form-jackpot div.input-group-append>button", function (e) {
        let phone = $('.form-jackpot [name="phone"]').val(),
        typeData = $(this).hasClass("btn-join") ? "join" : "out",
        oldText = $(this).text();
        if (!phone) return $("div.form-jackpot>div.message").html('<div class="alert alert-warning">Vui lòng nhập số điện thoại!</div>');
        $.ajax({
            url: `../api/v1/jackpot/${typeData}`,
            method: "POST",
            dataType: "json",
            data: { phone: phone },
            beforeSend: () => {
                $(".form-jackpot div.input-group-append>button").prop("disabled", !0), $(".form-jackpot div.input-group-append>button").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
            },
            success: (res) => {
                $(".form-jackpot div.input-group-append>button").prop("disabled", !1),
                $(".form-jackpot div.input-group-append>button").html(oldText),
                res.success ? $("div.form-jackpot>div.message").html(`<div class="alert alert-success">${res.message}</div>`) : $("div.form-jackpot>div.message").html(`<div class="alert alert-warning">${res.message}</div>`),
                !$(".jackpot-time").hasClass("d-none") && $(".jackpot-time").addClass("d-none"),
                $(".form-jackpot div.input-group-append").html(""),
                $('.form-jackpot [name="phone"]').val("");
            },
        });
    }),
    $("body").on("click", "#modalDetail button.btn-refund", function (e) {
        let transId = $("#detailTransId").text();
        if (!transId) return Swal.fire("Thông báo", "Vui lòng kiểm tra lại giao dịch!", "error");
        (transId = transId.replace(/\D/g, "")),
        $.ajax({
            url: "../api/v1/refundTransId",
            method: "POST",
            dataType: "json",
            data: { transId: transId },
            beforeSend: () => {
                $("#modalDetail button.btn-refund").prop("disabled", !0), $("#modalDetail button.btn-refund").html('Đang xử lý <i class="fas fa-spinner text-white fa-spin ml-2" aria-hidden="true"></i>');
            },
            success: (res) => {
                $("#modalDetail button.btn-refund").prop("disabled", !1),
                $("#modalDetail button.btn-refund").html("Hoàn tiền"),
                $("#modalDetail").modal("hide"),
                res.success ? Swal.fire("Thông báo", res.message, "success") : Swal.fire("Thông báo", res.message, "error");
            },
        });
    });
    $("body").on("click", "#btnGiftCode", function (e) {
        let giftcode = $('input[name="giftcode"]').val();
        let phone = $('input[name="phoneCode"]').val();
        if (!giftcode) return Swal.fire("Thông báo", "Vui lòng nhập mã GiftCode!");
        if (!phone) return Swal.fire("Thông báo", "Vui lòng nhập số điện thoại!");
        $.ajax({
            url: "../api/v1/giftcode/check",
            method: "POST",
            dataType: "json",
            data: { giftcode: giftcode, phone: phone },
            beforeSend: () => {
                $("#btnGiftCode").prop("disabled", !0), $("#btnGiftCode").html('<i class="fas fa-spinner fa-spin" aria-hidden="true"></i>');
            },
            success: (res) => {
                $("#btnGiftCode").prop("disabled", !1), $("#btnGiftCode").html('<i class="far fa-gift"></i>'), res.success ? Swal.fire("Thông báo", res.message, "success") : Swal.fire("Thông báo", res.message, "error");
            },
        });
    });
});
