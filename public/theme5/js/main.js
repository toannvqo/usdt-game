(function ($) {
    "use strict";
  
    // Copy ClipBoard
    $(".copy_clipboard").click(function (ev) {
      ev.preventDefault();
      var copyText = $(this).attr("data-copy");
      navigator.clipboard.writeText(copyText);
      try {
        var successful = document.execCommand("copy");
        var msg = successful ? "successful" : "unsuccessful";
        alert("Copying text command was " + msg + ` - ${copyText}`);
      } catch (err) {
        console.log("Oops, unable to copy");
      }
      return false;
    });
  
    // Spinner
    var spinner = function () {
      setTimeout(function () {
        if ($("#spinner").length > 0) {
          $("#spinner").removeClass("show");
        }
      }, 1);
    };
    spinner();
  
    // Initiate the wowjs
    new WOW().init();
  
    // Sticky Navbar
    $(window).scroll(function () {
      if ($(this).scrollTop() > 300) {
        $(".sticky-top").addClass("shadow-sm").css("top", "0px");
      } else {
        $(".sticky-top").removeClass("shadow-sm").css("top", "-100px");
      }
    });
  
    // Back to top button
    $(window).scroll(function () {
      if ($(this).scrollTop() > 300) {
        $(".back-to-top").fadeIn("slow");
      } else {
        $(".back-to-top").fadeOut("slow");
      }
    });
  
    //Back to top
    $(".back-to-top").click(function () {
      $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
      return false;
    });
  
    // Define selector for selecting
    // anchor links with the hash
    let anchorSelector = 'a[href^="#"]';
    $(anchorSelector).on("click", function (e) {
      // Prevent scrolling if the
      // hash value is blank
      e.preventDefault();
      // Get the destination to scroll to
      // using the hash property
      let destination = $(this.hash);
  
      // Get the position of the destination
      // using the coordinates returned by
      // offset() method
      let scrollPosition = destination?.offset()?.top;
      // Specify animation duration
      let animationDuration = 500;
      // Animate the html/body with
      // the scrollTop() method
      $("html, body").animate(
        {
          scrollTop: scrollPosition - 120,
        },
        animationDuration
      );
    });
  
    //movie
    var vid = document.getElementById("video-intro-player");
    $("#close_video_intro").click(function () {
      vid.pause();
    });
  
    //Menu Mobile
    $(document).ready(function () {
      var elementMenuRef = "#menuMobile";
      var mmenu = $(elementMenuRef)
        .mmenu({
          pageScroll: {
            scroll: true,
            update: true,
          },
          offCanvas: {
            position: "right",
          },
          sidebar: {
            expanded: {
              use: 800,
            },
          },
        })
        .data("mmenu");
  
      $(elementMenuRef).click(function (ev) {
        ev.preventDefault();
        mmenu.open();
      });
  
      $(".click_modalSp").click(function (ev) {
        ev.preventDefault();
        mmenu.close();
      });
    });
  })(jQuery);
  