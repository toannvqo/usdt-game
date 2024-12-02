const regexPhone = t => /(84|0[3|5|7|8|9])+([0-9]{8})\b/g.test(t);

function loadtableHistory(err, response) {
    err && Swal.fire('Thông Báo', `Có lỗi xảy ra ${err.message}`, 'warning');
    !response.success && Swal.fire('Thông Báo', response.message, 'error');
    if (response.success) {
        $('#tableHistory').html('');
            response.data.map((data,index)=>{
                $("#tableHistory").append(
                    `<tr><td class="text-white text-center">${new Date(data.time).toLocaleString()}</td><td class="text-white text-center">${data.phone}</td><td class="text-white text-center">${data.tranid}</td><td class="text-white text-center">${Intl.NumberFormat("en-US").format(data.money)}</td><td class="text-white text-center">${data.gameName}</td><td class="text-white text-center">${data.comment}</td><td><span class="badge badge-success">Thắng</span></td></tr>`
                )
            }
        );
    }
}
function loadtablePhone(err, response) {
    err && Swal.fire('Thông Báo', `Có lỗi xảy ra ${err.message}`, 'warning');
    !response.success && Swal.fire('Thông Báo', response.message, 'error');
    if (response.success) {
        $('#tablePhone').html('');
            response.data.map((data,index)=>{
                 $("#tablePhone").append(
                `<tr> <td>${data.status == 'success' ? '<span class="badge badge-success">Hoạt động</span>' :  '<span class="badge badge-danger">Bảo trì</span>'}</td> <td class="text-white text-center">${data.status == 'success' ? data.phone :  'XXXXXXXXXXXX'} <span class="badge badge-info copy-text" data-clipboard-text="${data.phone}"><i class="fa fa-copy"></i></span>
                 </td><td class="text-white text-center"><img src="${data.bankimg}" width="100"></td><td class="text-white text-center">${data.status == 'success' ? data.name :  'Số Offline'}</td><td>
                      <button data-toggle="modal" data-target="#modal-qr" href="javascript:void(0);" data-nd="${settinghome.ndchoi}" data-ctk="${data.name}" data-stk="${data.phone}" data-bankname="${data.bankname}"  class="qrc catalog__btn catalog__btn--banned">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"></path>  <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z"></path>  <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z"></path>  <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z"></path>  <path d="M12 9h2V8h-2v1Z"></path></svg>
                        </button>  
                </td></tr>`);
            }
        );
    }
}


function loaddatahisuer(err, response) {
    err && Swal.fire('Thông Báo', `Có lỗi xảy ra ${err.message}`, 'warning');
    !response.success && Swal.fire('Thông Báo', response.message, 'error');
    if (response.success) {
        $('#datahisuer').html('');
            response.data.map((data,index)=>{
                 $("#datahisuer").append(
                    `<tr><td class="text-white text-center">${new Date(data.time).toLocaleString()}</td><td class="text-white text-center">${data.phone}</td><td class="text-white text-center">${data.tranid}</td><td class="text-white text-center">${Intl.NumberFormat("en-US").format(data.money)}</td><td class="text-white text-center">${data.gameName}</td><td class="text-white text-center">${data.comment}</td><td><span class="badge ${data.trangthai === 'CHIẾN THẮNG' ? "badge-success" : "badge-primary"}">${data.trangthai}</span></td><td><span class="badge ${data.result === 'success' ? "badge-success" : "badge-primary"}">${data.result}</span></tr>`);
            }
        );
    }
}
function loaddatahisgd(err, response) {
    err && Swal.fire('Thông Báo', `Có lỗi xảy ra ${err.message}`, 'warning');
    !response.success && Swal.fire('Thông Báo', response.message, 'error');
    if (response.success) {
        $('#datahisgd').html('');
            response.data.map((data,index)=>{
                $("#datahisgd").append(
                        `<tr><td class="text-white text-center">${new Date(data.time).toLocaleString()}</td><td class="text-white text-center">${bankImage(data.bankcode)}</td><td class="text-white text-center">${data.stk}</td><td class="text-white text-center">${data.nickname}</td></tr>`);
            }
        );
    }
}
function bankImage(bin) {
    let html;

    switch (bin) {
        case 970415:
            html = `<img src="https://api.vietqr.io/img/ICB.png" width="100">`;
            break;
        case 970436:
            html = `<img src="https://api.vietqr.io/img/VCB.png" width="100">`;
            break;
        case 970418:
            html = `<img src="https://api.vietqr.io/img/BIDV.png" width="100">`;
            break;
        case 970405:
            html = `<img src="https://api.vietqr.io/img/VBA.png" width="100">`;
            break;
        case 970448:
            html = `<img src="https://api.vietqr.io/img/OCB.png" width="100">`;
            break;
        case 970422:
            html = `<img src="https://api.vietqr.io/img/MB.png" width="100">`;
            break;
        case 970407:
            html = `<img src="https://api.vietqr.io/img/TCB.png" width="100">`;
            break;
        case 970416:
            html = `<img src="https://api.vietqr.io/img/ACB.png" width="100">`;
            break;
        case 970432:
            html = `<img src="https://api.vietqr.io/img/VPB.png" width="100">`;
            break;
        case 970423:
            html = `<img src="https://api.vietqr.io/img/TPB.png" width="100">`;
            break;
        case 970403:
            html = `<img src="https://api.vietqr.io/img/STB.png" width="100">`;
            break;
        case 970437:
            html = `<img src="https://api.vietqr.io/img/HDB.png" width="100">`;
            break;
        case 970454:
            html = `<img src="https://api.vietqr.io/img/VCCB.png" width="100">`;
            break;
        case 970429:
            html = `<img src="https://api.vietqr.io/img/SCB.png" width="100">`;
            break;
        case 970441:
            html = `<img src="https://api.vietqr.io/img/VIB.png" width="100">`;
            break;
        case 970443:
            html = `<img src="https://api.vietqr.io/img/SHB.png" width="100">`;
            break;
        case 970431:
            html = `<img src="https://api.vietqr.io/img/EIB.png" width="100">`;
            break;
        case 970426:
            html = `<img src="https://api.vietqr.io/img/MSB.png" width="100">`;
            break;
        case 546034:
            html = `<img src="https://api.vietqr.io/img/CAKE.png" width="100">`;
            break;
        case 546035:
            html = `<img src="https://api.vietqr.io/img/UBANK.png" width="100">`;
            break;
        case 963388:
            html = `<img src="https://vietqr.net/portal-service/resources/icons/TIMO.png" width="100">`;
            break;
        case 971005:
            html = `<img src="https://api.vietqr.io/img/VIETTELMONEY.png" width="100">`;
            break;
        case 971011:
            html = `<img src="https://api.vietqr.io/img/VNPTMONEY.png" width="100">`;
            break;
        case 970400:
            html = `<img src="https://api.vietqr.io/img/SGICB.png" width="100">`;
            break;
        case 970409:
            html = `<img src="https://api.vietqr.io/img/BAB.png" width="100">`;
            break;
        case 970412:
            html = `<img src="https://api.vietqr.io/img/PVCB.png" width="100">`;
            break;
        case 970414:
            html = `<img src="https://api.vietqr.io/img/OCEANBANK.png" width="100">`;
            break;
        case 970419:
            html = `<img src="https://api.vietqr.io/img/NCB.png" width="100">`;
            break;
        case 970424:
            html = `<img src="https://api.vietqr.io/img/SHBVN.png" width="100">`;
            break;
        case 970425:
            html = `<img src="https://api.vietqr.io/img/ABB.png" width="100">`;
            break;
        case 970427:
            html = `<img src="https://api.vietqr.io/img/VAB.png" width="100">`;
            break;
        case 970428:
            html = `<img src="https://api.vietqr.io/img/NAB.png" width="100">`;
            break;
        case 970430:
            html = `<img src="https://api.vietqr.io/img/PGB.png" width="100">`;
            break;
        case 970433:
            html = `<img src="https://api.vietqr.io/img/VIETBANK.png" width="100">`;
            break;
        case 970438:
            html = `<img src="https://api.vietqr.io/img/BVB.png" width="100">`;
            break;
        case 970440:
            html = `<img src="https://api.vietqr.io/img/SEAB.png" width="100">`;
            break;
        case 970446:
            html = `<img src="https://api.vietqr.io/img/COOPBANK.png" width="100">`;
            break;
        case 970449:
            html = `<img src="https://api.vietqr.io/img/LPB.png" width="100">`;
            break;
        case 970452:
            html = `<img src="https://api.vietqr.io/img/KLB.png" width="100">`;
            break;
        case 668888:
            html = `<img src="https://api.vietqr.io/img/KBANK.png" width="100">`;
            break;
        case 970458:
            html = `<img src="https://api.vietqr.io/img/UOB.png" width="100">`;
            break;
        case 970410:
            html = `<img src="https://api.vietqr.io/img/SCVN.png" width="100">`;
            break;
        case 970439:
            html = `<img src="https://api.vietqr.io/img/PBVN.png" width="100">`;
            break;
        case 801011:
            html = `<img src="https://api.vietqr.io/img/NHB.png" width="100">`;
            break;
        case 970434:
            html = `<img src="https://api.vietqr.io/img/IVB.png" width="100">`;
            break;
        case 970456:
            html = `<img src="https://api.vietqr.io/img/IBK.png" width="100">`;
            break;
        case 970455:
            html = `<img src="https://api.vietqr.io/img/IBK.png" width="100">`;
            break;
        case 970421:
            html = `<img src="https://api.vietqr.io/img/VRB.png" width="100">`;
            break;
        case 970457:
            html = `<img src="https://api.vietqr.io/img/WVN.png" width="100">`;
            break;
        case 970462:
            html = `<img src="https://api.vietqr.io/img/KBHN.png" width="100">`;
            break;
        case 970463:
            html = `<img src="https://api.vietqr.io/img/KBHCM.png" width="100">`;
            break;
        case 458761:
            html = `<img src="https://api.vietqr.io/img/HSBC.png" width="100">`;
            break;
        case 970442:
            html = `<img src="https://api.vietqr.io/img/HLBVN.png" width="100">`;
            break;
        case 970408:
            html = `<img src="https://api.vietqr.io/img/GPB.png" width="100">`;
            break;
        case 970406:
            html = `<img src="https://api.vietqr.io/img/DOB.png" width="100">`;
            break;
        case 796500:
            html = `<img src="https://api.vietqr.io/img/DBS.png" width="100">`;
            break;
        case 422589:
            html = `<img src="https://api.vietqr.io/img/CIMB.png" width="100">`;
            break;
        case 970444:
            html = `<img src="https://api.vietqr.io/img/CBB.png" width="100">`;
            break;
        case 533948:
            html = `<img src="https://api.vietqr.io/img/CITIBANK.png" width="100">`;
            break;
        case 970466:
            html = `<img src="https://api.vietqr.io/img/KEBHANAHCM.png" width="100">`;
            break;
        case 970467:
            html = `<img src="https://api.vietqr.io/img/KEBHANAHN.png" width="100">`;
            break;
        case 977777:
            html = `<img src="https://api.vietqr.io/img/MAFC.png" width="100">`;
            break;
        case 999888:
            html = `<img src="https://api.vietqr.io/img/VBSP.png" width="100">`;
            break;
        default:
            html = `<span class="badges badge-danger">Không rõ</span>`;
            break;
    }
    return html;
}
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
var cookie = document.cookie.split(';').map(function (c) {
    return c.trim().split('=').map(decodeURIComponent);
}).reduce(function (a, b) {
    try {
        a[b[0]] = JSON.parse(b[1]);
    } catch (e) {
        a[b[0]] = b[1];
    }
    return a;
}, {});

