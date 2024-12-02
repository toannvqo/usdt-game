let settings;
let next_reset = new Date().getTime();
let noti_win = [];
let noti_wined = [];
function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

Number.prototype.format = function (n, x) {
    var re = '(\\d)(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$1,');
};
(function () {

    function l(r) {
        return null === r ? "" : encodeURIComponent(String(r).trim())
    }

    function r(r, e) {
        var t, a, o, s, i = [],
            n = !(!e || !e.lowerCase) && !!e.lowerCase;
        if (null === r ? a = "" : "object" == typeof r ? (a = "", e = r) : a = r, e) {
            if (e.path && (a && "/" === a[a.length - 1] && (a = a.slice(0, -1)), o = String(e.path).trim(), n && (o = o.toLowerCase()), 0 === o.indexOf("/") ? a += o : a += "/" + o), e.queryParams) {
                for (t in e.queryParams) {
                    if (e.queryParams.hasOwnProperty(t) && void 0 !== e.queryParams[t])
                        if (e.disableCSV && Array.isArray(e.queryParams[t]) && e.queryParams[t].length)
                            for (var u = 0; u < e.queryParams[t].length; u++) s = e.queryParams[t][u], i.push(t + "=" + l(s));
                        else s = n ? e.queryParams[t].toLowerCase() : e.queryParams[t], i.push(t + "=" + l(s))
                }
                a += "?" + i.join("&")
            }
            e.hash && (a += n ? "#" + String(e.hash).trim().toLowerCase() : "#" + String(e.hash).trim())
        }
        return a
    }

    var e = this,
        t = e.buildUrl;
    r.noConflict = function () {
        return e.buildUrl = t, r
    }, "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = r), exports.buildUrl = r) : e.buildUrl = r
}).call(this);
let DUNGA = function () {
    initUrl = (queryParams) => {
        // queryParams['hashvl'] = hash;
        // queryParams['hash_name'] = "hashvl";
        let type = queryParams['type'];
        delete queryParams['type'];
        return buildUrl("", {
            path: "api/" + type,
        });
    },
    cacheTab = (str)=>{
        localStorage.setItem('tabActive', str);
    },
    copyStringToClipboard = (str) => {
        var el = document.createElement('textarea');
        el.value = str;
        el.setAttribute('readonly', '');
        el.style = {
            position: 'absolute',
            left: '-9999px'
        };
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert('Đã sao chép số điện thoại này. Chúc bạn may mắn.');
    }
    number_format = (number) => {
        return parseInt(number).toLocaleString('it-IT', {
            style: 'currency',
            currency: 'VND'
        });
    }
    initAjax = (data_ajax) => {
        $.ajax(data_ajax);
    }
    getNum = (remove) => {
        let ends = [];
        for ($i = 0; $i < 10; $i++) {
            if (remove.indexOf($i) === -1) {
                ends.push($i);
            }
            ;
        }
        return ends;
    }
    loadMomo = (ag) => {
        initAjax({
            url: initUrl({
                type: "momo"
            }),
            method: "POST",
            success: function (data) {
                if (data.status == true) {
                    let table_one = "";
                    let table_ten = "<tr>";
                    if (data.data_momo) {
                        let status_momo = {
                            0: `<span class="badge bg-warning text-uppercase">Bảo trì</span>`,
                            1: `<span class="badge bg-success text-uppercase">Hoạt động</span>`
                        };
                        let data_momos = data.data_momo;
                        for (let momo of data.data_momo) {
                            var settings = momo.settings;
                            if (settings.transfers_today == undefined) {
                                settings.transfers_today = {
                                    times: 0,
                                    amount: 0
                                };
                            }
                            // table_one += `<tr>`;
                            // table_one += `<td>${momo.username} <span class="label label-success text-uppercase" onclick="DUNGA.coppy('${momo.username}')"><i class="fa fa-clipboard" aria-hidden="true"></i></span> <span class="label label-success text-uppercase" onclick="DUNGA.play('${momo.username}')"><i class="fa fa-play" aria-hidden="true"></i></span></td>`;
                            // table_one += `<td>${status_momo[momo.status]}</td>`;
                            // table_one += `<td><strong><span class="text-danger">${settings.transfers_today.times}</span> lần</strong></td>`;
                            // table_one += `<td><strong><span class="text-danger cash-format">${number_format(settings.transfers_today.amount)}</span> / 50.000.000 VND</strong></td>`;
                            // table_one += "</tr>";

                            table_one += `<tr>`;
                            table_one += `<td>`;
                            table_one += `<div class="d-flex">`;
                            table_one += `<div class="d-flex flex-column lh-1">`;
                            table_one += `<div class="text-white fw-bold text-nowrap">${momo.username} </div>`;
                            table_one += `</div>`;
                            table_one += `<div class="d-flex align-items-center ms-2">`;
                            table_one += `<span class="badge bg-success text-uppercase mx-1" onclick="DUNGA.coppy('${momo.username}')">`;
                            table_one += `<i class="fa fa-clipboard" aria-hidden="true"></i>`;
                            table_one += `</span>`;
                            table_one += `<span class="badge bg-success text-uppercase mx-1" onclick="DUNGA.play('${momo.username}')">`;
                            table_one += `<i class="fa fa-play" aria-hidden="true"></i>`;
                            table_one += `</span>`;
                            table_one += `</div>`;
                            table_one += `</div>`;
                            table_one += `</td>`;
                            table_one += `<td>${status_momo[momo.status]}</td>`;
                            table_one += `<td><strong><span class="text-danger">${settings.transfers_today.times}</span> lần</strong></td>`;
                            table_one += `<td><strong><span class="text-danger cash-format">${number_format(settings.transfers_today.amount)}</span> /`;
                            table_one += `50.000.000`;
                            table_one += `VND</strong>`;
                            table_one += `</td>`;
                            table_one += `</tr>`;

                        }
                    }
                    if (data.game.active) {
                        for (let game of data.game.active) {
                            $(`button[data-game="${game}"]`).removeClass("hidden");
                        }
                        $("div.play-rules").html(data.game.html);
                        if (ag == "" || ag == undefined) {
                            if (data.game.active.includes("chanle")) {
                                $(`button[data-game="chanle"]`).click();
                            } else {
                                $(`button[data-game="${data.game.active[0]}"]`).click();
                            }
                        } else {
                            $(`button[data-game="${ag}"]`).click();
                        }
                    }
                    $("#momo-status").html(table_one);
                }
            }
        })
    }
    loadSettings = () => {
        initAjax({
            url: initUrl({
                type: "settings"
            }),
            method: "POST",
            success: function (data) {
                if (data.status == true) {
                    settings = data;
                    if (data.active == 1) {
                        $("#author").html(`<a href="${data.href}" target="_blank">${data.author}</a>`);
                        let html_contact = "";
                        for (let contact of data.contacts) {
                            html_contact += `<p><a class="text-white" href="${contact.href}" target="_blank"><span class="btn btn-success text-uppercase">${contact.name}</span></a></p>`;
                        }
                        $("#note").html(data.note);
                        $("#note_modal").html(data.note);
                        $("#noteModal").modal();
                        $("#contact").html(html_contact);
                        if (data.ads !== "" && data.ads !== undefined) {
                            $(".ads").removeClass("hidden").html(data.ads);
                        }
                        if (data.notifications !== "" && data.notifications !== undefined) {
                            $(".notifications").removeClass("hidden").html(data.notifications);
                        }
                        loadMomo();
                        if (data.history !== undefined && data.history == "1") {
                            loadHistorys(data.only_win, data.limit);
                        }
                        if (data.hu !== undefined && data.hu == "1") {
                            loadHu();
                            $("#amount-hu").text(number_format(data.hu.amount));
                            // $("#roles-hu").text(data.hu.roles.join(", "));
                        }
                        
                        if (data.week_top !== undefined && data.week_top == 1) {
                            console.log("data.week_topdata.week_top", data.week_top);
                            loadWeekTop();
                            $(".week_top").removeClass("hidden");
                        }
                        if (data.day_mission !== undefined && data.day_mission == 1) {
                            loadMinigame({
                                game: "day_mission",
                            });
                        }
                        if (data.wheel !== undefined && data.wheel.active == 1) {
                            loadMinigame({
                                game: "wheel",
                            });
                        }
                        if (data.diemdanh !== undefined && data.diemdanh == 1) {
                            loadMinigame({
                                game: "diemdanh",
                            });
                        }
                        if (data.giftcode !== undefined && data.giftcode == 1) {
                            loadMinigame({
                                game: "giftcode",
                            });
                        }
                        if (data.refer_friend !== undefined && data.refer_friend.active == 1) {
                            loadMinigame({
                                game: "refer_friend",
                                settings_encode: data.refer_friend.settings_encode
                            });
                        }
                        setInterval(reset_data, 1000);
                        setInterval(day_limit, 5000);
                    }
                }
            }
        })
    };
    loadHistorys = (only_win, limit) => {
        initAjax({
            url: initUrl({
                type: "history",
                only_win,
                limit
            }),
            method: "POST",
            success: function (data) {
                if (data.status == true) {
                    if (data.history.status == true) {

                        let status_win = {
                            1: '<span class="label label-success text-uppercase">Thắng</span>',
                            0: '<span class="label label-secondary text-uppercase">Thua</span>'
                        }
                        let html_history = "";
                        for (let history of data.history.data) {
                            let color_change = '#' + ((1 << 24) * (Math.random() + 1) | 0).toString(16)
                                .substr(1);
                            html_history += "<tr>";
                            // if (time_tran == "1" && history.time_tran_date !== "") {
                            //     html_history += `<td>${history.time_tran_date}</td>`;
                            // }
                            html_history += `<td>${history.partnerId}</td>`;
                            html_history += `<td>${number_format(history.amount)}</td>`;
                            html_history += `<td><span class="fa-stack"><span class="fa fa-circle fa-stack-2x" style="color:${color_change}"></span><span class="fa-stack-1x text-white">${history.comment}</span></span></td>`;
                            html_history += `<td>${status_win[history.victory]}</td>`;
                            html_history += "</tr>";
                            if (history.amount >= 50000 && noti_wined[history.id] == undefined) {
                                noti_win[history.id] = {
                                    game: "",
                                    partnerId: history.partnerId,
                                    amount: history.amount
                                };
                            }

                        }
                        $("#history").html(html_history);
                    }
                } else {
                    //alert(data.message);
                }
            }
        });
    };
    loadWeekTop = () => {
        initAjax({
            url: initUrl({
                type: "week_top"
            }),
            method: "POST",
            success: function (data) {
                if (data.status == true) {
                    if (data.weekTop.status == true) {
                        let html_weektop = "";
                        for (let top of data.weekTop.data) {
                            // html_weektop += '<tr>';
                            // html_weektop += `<td><span class="fa-stack"> <span class="fa fa-circle fa-stack-2x text-danger"></span><strong class="fa-stack-1x text-white">${top.key}</strong></span></td>`;
                            // html_weektop += `<td class="col-xs-2"><span class="label label-success">${top.phone}</span></td>`;
                            // html_weektop += `<td class="col-xs-5 text-center"><span class="label label-danger">${number_format(top.amount)}</span></td>`;
                            // html_weektop += `<td class="col-xs-5 text-center"><span class="label label-danger">${number_format(top.amount)}</span></td>`;
                            // html_weektop += '</tr>';

                            html_weektop += `<tr>`;
                            html_weektop += `<td>`;
                            html_weektop += `<span class="fa-stack"> <span class="fa fa-circle fa-stack-2x text-danger"></span>`;
                            html_weektop += `<strong class="fa-stack-1x text-white">${top.key}</strong>`;
                            html_weektop += `</span>`;
                            html_weektop += `</td>`;
                            html_weektop += `<td class="col-xs-2"><span class="badge bg-success">${top.phone}</span></td>`;
                            html_weektop += `<td class="col-xs-5 text-center"><span class="badge bg-danger">${number_format(top.amount)}</span>`;
                            html_weektop += `</td>`;
                            html_weektop += `<td class="col-xs-5 text-center"><span class="badge bg-danger">${number_format(top.gift)}</span>`;
                            html_weektop += `</td>`;
                            html_weektop += `</tr>`;
                        }
                        $(".week_top #week_top").html(html_weektop);
                        // console.log();
                    }
                }
            }
        });
    };
    loadMinigame = (data) => {
        const {
            game,
        } = data;
        initAjax({
            url: initUrl({
                type: "render_minigame"
            }),
            method: "POST",
            data: {
                game,
            },
            success: function (data_xhr) {
                if (data_xhr.status == true) {
                    // $(`[data-minigame=${game}]`).removeClass("hidden");
                    // $(".minigame-rules").append(data_xhr.html);
                    $(`#${game}`).append(data_xhr.html);
                }
            }
        });
    }
    loadHu = () => {
        initAjax({
            url: initUrl({
                type: "balance-hu"
            }),
            method: "POST",
            success: function (data) {
                if (data.status == true) {
                    $("#hu-left-display").removeClass("hidden");
                    $(".hu-balance").html(number_format(data.amount));
                }
            }
        });
    }
    check_dayMission = (partnerId) => {
        initAjax({
            url: initUrl({
                type: "/v1/getCount",
            }),
            method: "POST",
            data: {
                phone: partnerId,
            },
            beforeSend: function () {
                $(".check-day-mission").attr("disabled", true).addClass("disabled");
                $("#day_mission_querying").show();
                $("#query_done").html();
                $("#non_query").hide();
            },
            success: function (data) {
                if (data.status == 'error') {
                    alert('Oh !! Số điện thoại này chưa chơi game nào, hãy kiểm tra lại');
                    $("#non_query").show();
                    $("#gift").hide();
                } else {
                    alert(data.message);
                    $("#non_query").show();
                    $("#day_mission_querying").hide();
                    $(".check-day-mission").attr("disabled", false).removeClass("disabled");
                }
            }
        })
    };
    reward_dayMission = (partnerId, milEncode) => {
        initAjax({
            url: initUrl({
                type: "reward-day-mission",
                partnerId
            }),
            method: "POST",
            data: {
                milEncode
            },
            beforeSend: function () {
                $(".reward-day-mission").attr("disabled", true).addClass("disabled");
            },
            success: function (data) {
                if (data.status == true) {
                    if (data.data.status == true) {
                        let data_response = data.data;
                        $(".reward-day-mission").remove();
                        $(".ntmsg").html(`
                            <div><b>${data_response.message}</b></div>
                            <div class="st"><b class="text-danger">Sá»‘ tiá»n: ${number_format(data_response.amount)} vnÄ‘</b></div>
                            <div class="st"><b class="text-warning">Lá»i nháº¯n: ${data_response.comment}</b></div>`);
                    }

                } else {
                    $(".ntmsg b").text(data.message).addClass("text-danger");
                }
            }
        })
    };
    checkTran = (tran_id) => {
        initAjax({
            url: initUrl({
                type: "checkTransId",
            }),
            data: {
                tran_id: tran_id
            },
            method: "POST",
            success: function (data) {
                if (data.status == true) {
                    if (data.data.status == true) {
                        $("#result-check").attr("class", "").addClass("alert alert-success").html(data.data.message);
                    } else {
                        $("#result-check").attr("class", "").addClass("alert alert-danger").html(data.data.message);
                    }
                } else {
                    if (data.code == 404) {
                        $(".more_infomation").removeClass("hidden");
                    } else {
                        $("#result-check").attr("class", "").addClass("alert alert-danger").html(data.message);
                    }

                }
                $(".check-tran").attr("disabled", false).removeClass("disabled");
            }
        })
    };
    refund = (tran_id) => {
        initAjax({
            url: initUrl({
                type: "refund",
            }),
            data: {
                tran_id: tran_id
            },
            method: "POST",
            success: function (data) {
                alert(data.message);
            }
        })
    };
    checkTran2 = (tran_id, receiver) => {
        initAjax({
            url: initUrl({
                type: "check-tran2"
            }),
            method: "POST",
            data: {
                tran_id,
                receiver
            },
            beforeSend: function () {
                $(".check-tran").attr("disabled", true).addClass("disabled");
            },
            success: function (data) {
                if (data.status == true) {
                    if (data.data.status == true) {
                        $("#result-check").attr("class", "").addClass("alert alert-success").html(data.data.message);
                    } else {
                        $("#result-check").attr("class", "").addClass("alert alert-danger").html(data.data.message);
                    }
                } else {
                    $("#result-check").attr("class", "").addClass("alert alert-danger").html(data.message);
                }
                $(".check-tran").attr("disabled", false).removeClass("disabled");
            }
        })
    };
    joinhu = function (partnerId) {
        initAjax({
            url: initUrl({
                type: "join-hu",
                partnerId
            }),
            method: "POST",
            beforeSend: function () {
                $(".submit-join-hu").attr("disabled", true).addClass("disabled");
            },
            success: function (data) {
                if (data.status == true) {
                    if (data.data.status == true) {
                        $("#msg_hu").html(data.data.message);

                        $(".submit-join-hu").attr("disabled", false).removeClass("disabled");
                        if (data.data.is_join == 1) {
                            $(".submit-join-hu").removeClass("btn-success").addClass("btn-danger").html("Há»§y Tham Gia");
                        } else {
                            $(".submit-join-hu").removeClass("btn-danger").addClass("btn-success").html("Tham Gia");
                        }
                    } else {
                        $("#msg_hu").html(data.data.message);
                        $(".submit-join-hu").attr("disabled", false).removeClass("disabled");
                    }
                } else {
                    $("#msg_hu").html(data.data.message);
                    $(".submit-join-hu").attr("disabled", false).removeClass("disabled");
                }
            }
        })
    }
    joinDiemdanh = (partnerId) => {
        initAjax({
            url: initUrl({
                type: "diem-danh",
            }),
            data: {
                phone: partnerId
            },
            method: "POST",
            success: function (data) {
                alert(data.message);
            }
        })
    };
    day_limit = function () {
        let times = $("#hmln[attr-name=times]").toggleClass("hidden");
        let amount = $("#hmln[attr-name=amount]").toggleClass("hidden");
    }
    reset_data = function () {
        var d = new Date().getTime();
        let sec = Math.floor((next_reset - d) / 1000);
        if (sec <= 0) {
            sec = 0;
        }
        $(".coundown-time").text(sec);
        if (sec % 2 == 0) {
            let id_his = Object.keys(noti_win)[0];
            if (id_his > 0) {
                DUNGA.noti_win(noti_win[id_his]);
                noti_wined[history.id] = history.id;
                delete noti_win[id_his];
            }
        }

        if (d >= next_reset) {
            if (settings.active == 1) {
                // if(typeof game_active === undefined){
                //     game_active = "chanle";
                // }
                var game_active = localStorage.getItem('tabActive');
                loadMomo(game_active?game_active:'tab-1');
                if (settings.history !== undefined && settings.history == 1) {
                    loadHistorys(settings.only_win, settings.limit);
                }
                if (settings.hu !== undefined && settings.hu.active == 1) {
                    loadHu();
                }
                next_reset = d + 20000;
            }

        }
    }
    return {
        init: function () {
            loadSettings();
        },
        cacheTab : function(str){
            cacheTab(str);
        },
        coppy: function (str) {
            copyStringToClipboard(str);
        },
        play: function (str) {
            window.open(`https://nhantien.momo.vn/${str}`, '_blank')
        },
        number_format: function (number) {
            number_format(number);
        },
        check_tranid: function () {
            $this = this;
            let tranid = $("input[name=tran_id]").val();
            checkTran(tranid);
        },
        refund: function () {
            $this = this;
            let tranid = $("input[name=tran_id]").val();
            refund(tranid);
        },
        check_tranid2: function () {
            $this = this;
            let tranid = $("input[name=tran_id]").val();
            let receiver = $("input[name=receiver]").val();
            checkTran2(tranid, receiver);
        },
        hu_click: function () {
            $("#hu-info").modal("show");
        },
        check_dayMission: function () {
            $this = this;
            console.log(123123);
            let partnerId = $("input[name=partnerId]").val();
            check_dayMission(partnerId);
        },
        joinDiemdanh: function () {
            $this = this;
            let phoneDiemDanh = $("input[name=phoneDiemDanh]").val();
            if (phoneDiemDanh.length <= 9) {
                alert(`Khong hop le`);
                return false;
            }
            let num1 = getRndInteger(1, 9);
            let num2 = getRndInteger(1, 9);
            let person = prompt("Xác minh bạn là học sinh giỏi toán " + num1 + "+" + num2 + "= ?:", "");
            if (person == null || person != (num1 + num2)) {
                alert(`Bạn đã nhập sai phép tính, vui lòng thử lại`);
                return false;
            }
            joinDiemdanh(phoneDiemDanh);
        },
        joinhu: function () {
            let partnerId = $("#result_hu input[name=partnerId]").val();
            joinhu(partnerId);
        },
        reward: function () {
            $this = this;
            let partnerId = $("input[name=partnerId]").val();
            let milEncode = $(".reward-day-mission").attr("data-mil-encode");
            reward_dayMission(partnerId, milEncode);
        },
        noti_win: function (data) {
            const {
                game,
                partnerId,
                amount
            } = data;

            // new Notify({
            //     status: 'success',
            //     title: 'Trò chơi: ' + game,
            //     text: `Chúc mừng <b>${partnerId}</b> đã thắng ${number_format(amount)}`,
            //     autoclose: true,
            //     customIcon: '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512"><path d="M19,9H14a5.006,5.006,0,0,0-5,5v5a5.006,5.006,0,0,0,5,5h5a5.006,5.006,0,0,0,5-5V14A5.006,5.006,0,0,0,19,9Zm-5,6a1,1,0,1,1,1-1A1,1,0,0,1,14,15Zm5,5a1,1,0,1,1,1-1A1,1,0,0,1,19,20ZM15.6,5,12.069,1.462A5.006,5.006,0,0,0,5,1.462L1.462,5a5.006,5.006,0,0,0,0,7.071L5,15.6a4.961,4.961,0,0,0,2,1.223V14a7.008,7.008,0,0,1,7-7h2.827A4.961,4.961,0,0,0,15.6,5ZM5,10A1,1,0,1,1,6,9,1,1,0,0,1,5,10ZM9,6a1,1,0,1,1,1-1A1,1,0,0,1,9,6Z"></path></svg>',
            // });

            $.notify(`Chúc mừng ${partnerId} đã thắng ${number_format(amount)}`,{
                elementPosition: 'bottom left',
                globalPosition: 'bottom left',
                className: 'success',
            });
        }

    }
}();
// "undefined" != typeof module && "undefined" != typeof module.exports && (module.exports = DUNGA), $(document).ready(function () {
//     // DUNGA.init()
//     var pusher = new Pusher('0fd074ebb0ba8b2a418c', {
//         cluster: "ap1",
//     });
// });

$("#result_hu [name=partnerId]").on("input", function () {
    if (this.value.length >= 10 && this.value.length <= 11) {
        $("#msg_hu2").html('<button type="text" class="btn btn-success submit-join-hu" onclick="DUNGA.joinhu()">Tham gia</button>');
    } else {
        $("#msg_hu2").html("Vui lòng nhập số điện thoại để tiếp tục");
    }
});
