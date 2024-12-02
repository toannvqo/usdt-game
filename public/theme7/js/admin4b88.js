(function (window, document, undefined) {
	'use strict';

	/*==============================
	Header
	==============================*/
	if (document.querySelector('.header')) {
		const headerBtn = document.querySelector('.header__btn');
		const headerNav = document.querySelector('.sidebar');

		function toggleHeaderMenu() {
			headerBtn.classList.toggle('header__btn--active');
			headerNav.classList.toggle('sidebar--active');
		}

		headerBtn.addEventListener('click', toggleHeaderMenu);
	}

	/*==============================
	Scrollbar
	==============================*/
	var Scrollbar = window.Scrollbar;

	if (document.querySelector('.dashbox__table-bank-infos')) {
		Scrollbar.init(document.querySelector('.dashbox__table-bank-infos'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: true
		});
	}

	if (document.querySelector('#recently-histories')) {
		Scrollbar.init(document.querySelector('#recently-histories'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: true
		});
	}


	if (document.querySelector('.dashbox__table-wrap-win-games')) {
		Scrollbar.init(document.querySelector('.dashbox__table-wrap-win-games'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: true
		});
	}
	if (document.querySelector('.dashbox__table-wrap--111')) {
		Scrollbar.init(document.querySelector('.dashbox__table-wrap--111'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: true
		});
	}
	if (document.querySelector('.dashbox__table-wrap--11')) {
		Scrollbar.init(document.querySelector('.dashbox__table-wrap--11'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: true
		});
	}
	if (document.querySelector('.dashbox__table-wrap--2')) {
		Scrollbar.init(document.querySelector('.dashbox__table-wrap--2'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: true
		});
	}
    if (document.querySelector('.dashbox__table-wrap--1')) {
		Scrollbar.init(document.querySelector('.dashbox__table-wrap--1'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: true
		});
	}
	if (document.querySelector('.dashbox__table-wrap--4')) {
		Scrollbar.init(document.querySelector('.dashbox__table-wrap--4'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: true
		});
	}
	if (document.querySelector('.sidebar__nav')) {
		Scrollbar.init(document.querySelector('.sidebar__nav'), {
			damping: 0.1,
			renderByPixels: true,
			alwaysShowTracks: false,
			continuousScrolling: true
		});
	}

	/*==============================
	Filter
	==============================*/
	if (document.querySelector('.sign__selectjs')) {
		new SlimSelect({
			select: '.sign__selectjs',
			settings: {
				showSearch: true,
			}
		});
	}

	/*==============================
	Upload
	==============================*/
	if (document.getElementById('sign__gallery-upload')) {
		var galleryUpload = document.getElementById('sign__gallery-upload');

		galleryUpload.addEventListener('change', function(event) {
			var length = event.target.files.length;
			var galleryLabel = galleryUpload.getAttribute('data-name');
			var label = document.querySelector(galleryLabel);

			if (length > 1) {
				label.textContent = length + " files selected";
			} else {
				label.textContent = event.target.files[0].name;
			}
		});
	}

	if (document.querySelector('.sign__video-upload')) {
		document.querySelectorAll('.sign__video-upload').forEach(function(element) {
			element.addEventListener('change', function() {
				var videoLabel = element.getAttribute('data-name');
				var vlabel = document.querySelector(videoLabel);

				if (element.value !== '') {
					vlabel.textContent = element.files[0].name;
				} else {
					vlabel.textContent = "Upload video";
				}
			});
		});
	}

	/*==============================
	Section bg
	==============================*/
	if (document.querySelector('.section--bg')) {
		var mainBg = document.querySelector('.section--bg');

		if (mainBg.getAttribute('data-bg')) {
			mainBg.style.background = `url(${mainBg.getAttribute('data-bg')})`;
			mainBg.style.backgroundPosition = 'center center';
			mainBg.style.backgroundRepeat = 'no-repeat';
			mainBg.style.backgroundSize = 'cover';
		}
	}

})(window, document);
$(document).on("click", ".show-notes", function () {
	var data = $(this).attr("data-content");
	$('#modal-notes .comments__text').html(data);
});
$(document).on("click", ".show-bill", function () {
	var bc = $(this).attr('data-bt');
	if (bc != 'MB') {
		$('.bill-frame').css('max-width', '390px');
	}
	else {
		$('.bill-frame').css('max-width', '1360px');
	}
	$('#show-bill-ifr').attr('src', "/showbankbill/?d=" + $(this).attr('data-bi'));
	$('#ifr-bill-panel').fadeIn(300);
})
$(document).on("click", ".close-bill-frame", function () {
	$('#show-bill-ifr').attr('src', 'about:blank');
	$('#ifr-bill-panel').fadeOut(300);
});
$(document).on("click", ".sidebar__user-btn", function () {
	window.location.href = '/client/dangxuat';
});
var qrCode;
function loadQR(data, img, bgc) {
	qrCode = new QRCodeStyling({
		width: 400,
		height: 400,
		data: data,
		image: img,
		dotsOptions: { color: bgc, type: "rounded" },
		backgroundOptions: { color: "#FFF" },
		imageOptions: { crossOrigin: "anonymous", margin: 5, imageSize: 0.5 },
	});
	$("#canvasQr").html(""), qrCode.append(document.getElementById("canvasQr"));
}
$(document).on("click", ".qrc", function () {
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
    $("#canvasQr").append(img);
});
$(document).on("click", "#qr-reg", function () {
    var selectednoidungchoi = $("#noidungchoi option:selected").val();
    var selectedDaBankName = $("#dabankname option:selected").val();

    if (selectednoidungchoi && selectedDaBankName) {
        
        var values = selectedDaBankName.split('|');
        var bankname = values[0];
        var stk = values[1];
        
        var imageUrl = 'https://img.vietqr.io/image/' + bankname + '-' + stk + '-compact.png?addInfo='+settinghome.ndchoi+' '+selectednoidungchoi;
        var img = $("<img>").attr("src", imageUrl).css({ width: 300, height: 300 });

        $("#canvasQr").html("").append(img);
    } else {
        alert("Please select a Game and Bank Name before generating the QR code.");
    }
});
$(document).on("click", ".resend-reward", function () {
	var pr = $(this).parent();
	pr.html('<span><img src="/Content/loading.gif" style="height: 13px;vertical-align: middle;" alt="loading ..." /></span>');
	gh = false;
	$.post("/home/resendreward/?d=" + $(this).attr('data-bi')).always(function () {
		pr.html('<span class="gstatus wait">WAIT</span>');
		gh = true;
	});
});
$(window).on('load', function () {
	$('.preloader').fadeOut(500);
	$('.preloader1').fadeOut(500);
});
function showLoader() {
	$('.preloader').fadeIn(500);
}
$(window).on('beforeunload', function () {
	showLoader();
});
$(window).on('pagehide', function () {
	$('.preloader').fadeOut(500);
});
$(window).on('unload', function () {
	$('.preloader').fadeOut(500);
});

    // Chặn chuột phải
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // Chặn hành động bôi đen và sao chép
    document.addEventListener('selectstart', function(e) {
        e.preventDefault();
    });

    document.addEventListener('copy', function(e) {
        e.preventDefault();
    });