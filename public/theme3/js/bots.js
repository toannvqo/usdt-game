function copyAndShowModal(phone, min, max,name) {
    document.getElementById("phone").innerHTML = phone;
    document.getElementById("min").innerHTML = min;
    document.getElementById("max").innerHTML = max;
    document.getElementById("name").innerHTML = name;

    var qrCodeImg = document.getElementById("qrCode");
    var qrCodeUrl = "https://chart.googleapis.com/chart?chs=480x480&cht=qr&choe=UTF-8&chl=2|99|" + phone + "|" + name + "|admin@gmail.com|0|0|10000|CC|transfer_myqr";
    qrCodeImg.src = qrCodeUrl;

    showModal();
}

function showModal() {
    var modal = document.getElementById("playcoin");
    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("playcoin");
    modal.style.display = "none";
}

function check_tranid() {
    var zData = $("#check_tranid").serialize();
    $.ajax({
        type: "POST",
        url: "../api/v1/checkTransId",
        data: zData,
        success: (res) => {
            if (($("#checkByTrans button").prop("disabled", !1), $("#checkByTrans button").html('<i class="fa fa-search"></i>'), !res.success))
                return Swal.fire("Thông báo", res.message, "error"), void(res.data && ($("#checkByTrans").addClass("d-none"), $("#checkByPhone").removeClass("d-none"), $('#checkByPhone [name="transId"]').val(transId)));
            handleDetail(res.data);
        },
    });
}

function check_his() {
 fetch("../api/v1/getHistory")
                .then((response) => response.json())
                .then((res) => {
                    if (!res.success) return Swal.fire("Thông báo", res.message, "error");
                    if (res.data.length) {
                        $("#tableHistory").html("");
                    } else {
                        $("#tableHistory").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                    }
                    res.data.forEach((data) => {
                        $("#tableHistory").append(
                            `<tr><td>${new Date(data.time).toLocaleString()}</td><td>${data.phone}</td><td>${data.tranId}</td><td>${Intl.NumberFormat("en-US").format(data.money)}</td><td>${Intl.NumberFormat("en-US").format(data.bonus)}</td><td>${data.gameName}</td><td><span class="badge badge-primary">${data.content.toUpperCase()}</span></td><td><span class="badge badge-success">Thắng</span></td></tr>`
                        );
                    });
                })
                .catch((err) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${err}`, "error"));
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
check_his();
$(document).ready(function() {
    $('#noticeModal').modal('show')
    $('[data-toggle="tooltip"]').tooltip()
});
$(document).ready(function() {
    $('#nohumodal').modal('hide')
    $('[data-toggle="tooltip"]').tooltip()
});
$(document).ready(function() {
    function Timer(fn, t) {
        var timerObj = setInterval(fn, t);

        this.stop = function() {
            if (timerObj) {
                clearInterval(timerObj);
                timerObj = null;
            }
            return this;
        }

        // start timer using current settings (if it's not already running)
        this.start = function() {
            if (!timerObj) {
                this.stop();
                timerObj = setInterval(fn, t);
            }
            return this;
        }

        // start with new or original interval, stop current interval
        this.reset = function(newT = t) {
            t = newT;
            return this.stop().start();
        }
    }



    var timeleft = 20;
    var downloadTimer = new Timer(function() {
        if (timeleft <= 0) {
            downloadTimer.stop();
            const elements = document.querySelectorAll('.coundown-time');
            elements.forEach(el => {
                el.innerHTML = 0;
            });

            fetch("../api/v1/getHistory")
                .then((response) => response.json())
                .then((res) => {
                    if (!res.success) return Swal.fire("Thông báo", res.message, "error");
                    if (res.data.length) {
                        $("#tableHistory").html("");
                    } else {
                        $("#tableHistory").html('<tr><td colspan="12"><div class="text-center"><img src="../assets/images/photos/404.png"><p class="font-weight-bold">Không tìm thấy dữ liệu...</p></div></td></tr>');
                    }
                    res.data.forEach((data) => {
                        $("#tableHistory").append(
                            `<tr><td>${new Date(data.time).toLocaleString()}</td><td>${data.phone}</td><td>${data.tranId}</td><td>${Intl.NumberFormat("en-US").format(data.money)}</td><td>${Intl.NumberFormat("en-US").format(data.bonus)}</td><td>${data.gameName}</td><td><span class="badge badge-primary">${data.content.toUpperCase()}</span></td><td><span class="badge badge-success">Thắng</span></td></tr>`
                        );
                    });
                })
                .catch((err) => Swal.fire("Thông báo", `Có lỗi xảy ra, ${err}`, "error"));

            const elements2 = document.querySelectorAll('.coundown-time');
            elements2.forEach(el => {
                el.innerHTML = 20;
            });
            timeleft = 20;
            downloadTimer.start();
        } else {
            const elements3 = document.querySelectorAll('.coundown-time');
            elements3.forEach(el => {
                el.innerHTML = timeleft;
            });
        }
        timeleft -= 1;
    }, 1000);
});