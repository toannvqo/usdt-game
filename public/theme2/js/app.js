(function (e) {
    "use strict";
    e(document).ready(function () {
        e(".app-sidebar a").each(function () {
            var t = window.location.href.split(/[?#]/)[0];
            this.href == t && (e(this).addClass("active"), e(this).parent().addClass("active"), e(this).parent().parent().prev().addClass("active"), e(this).parent().parent().prev().click());
        });
    }),
        e(document).ready(function () {
            e("#sidebar a").each(function () {
                var t = window.location.href.split(/[?#]/)[0];
                this.href == t && (e(this).addClass("active"), e(this).parent().addClass("active"), e(this).parent().parent().prev().addClass("active"), e(this).parent().parent().prev().click());
            });
        }),
        e("#fullscreen-button").on("click", function () {
            (void 0 !== document.fullScreenElement && null === document.fullScreenElement) ||
            (void 0 !== document.msFullscreenElement && null === document.msFullscreenElement) ||
            (void 0 !== document.mozFullScreen && !document.mozFullScreen) ||
            (void 0 !== document.webkitIsFullScreen && !document.webkitIsFullScreen)
                ? document.documentElement.requestFullScreen
                    ? document.documentElement.requestFullScreen()
                    : document.documentElement.mozRequestFullScreen
                    ? document.documentElement.mozRequestFullScreen()
                    : document.documentElement.webkitRequestFullScreen
                    ? document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT)
                    : document.documentElement.msRequestFullscreen && document.documentElement.msRequestFullscreen()
                : document.cancelFullScreen
                ? document.cancelFullScreen()
                : document.mozCancelFullScreen
                ? document.mozCancelFullScreen()
                : document.webkitCancelFullScreen
                ? document.webkitCancelFullScreen()
                : document.msExitFullscreen && document.msExitFullscreen();
        }),
        e(window).on("load", function (t) {
            e("#global-loader").fadeOut("slow");
        }),
        e(window).on("scroll", function (t) {
            e(this).scrollTop() > 0 ? e("#back-to-top").fadeIn("slow") : e("#back-to-top").fadeOut("slow");
        }),
        e("#back-to-top").on("click", function (t) {
            return e("html, body").animate({ scrollTop: 0 }, 600), !1;
        }),
        e(".cover-image").each(function () {
            var t = e(this).attr("data-image-src");
            void 0 !== t && !1 !== t && e(this).css("background", "url(" + t + ") center center");
        }),
        e(".chart-circle").length &&
            e(".chart-circle").each(function () {
                let t = e(this);
                t.circleProgress({ fill: { color: t.attr("data-color") }, size: t.height(), startAngle: (-Math.PI / 4) * 2, emptyFill: "#f6f6f6", lineCap: "round" });
            });
    var t = location.pathname
        .split("/")
        .slice(-1)[0]
        .replace(/^\/|\/$/g, "");
    e(".admin-navbar .nav li a").each(function () {
        var n;
        (n = e(this)),
            t && -1 !== n.attr("href").indexOf(t) && (n.parents(".admin-navbar .nav-item").last().addClass("active"), n.parents(".admin-navbar .nav-sub").length && n.parents(".admin-navbar .sub-item ul li").last().addClass("active"));
    });
    const n = "div.card";
    e('[data-toggle="tooltip"]').tooltip(),
        e('[data-toggle="popover"]').popover({ html: !0 }),
        e('[data-toggle="card-remove"]').on("click", function (t) {
            return e(this).closest(n).remove(), t.preventDefault(), !1;
        }),
        e('[data-toggle="card-collapse"]').on("click", function (t) {
            return e(this).closest(n).toggleClass("card-collapsed"), t.preventDefault(), !1;
        }),
        e('[data-toggle="card-fullscreen"]').on("click", function (t) {
            return e(this).closest(n).toggleClass("card-fullscreen").removeClass("card-collapsed"), t.preventDefault(), !1;
        }),
        e(".scroll-to").click(function (t) {
            let n = e(this).attr("href");
            e("li.nav-item.with-sub.active").removeClass("active"), e(this).parent().addClass("active"), e("html, body").animate({ scrollTop: e(n).offset().top - 30 }, 500);
        });
})(jQuery);
