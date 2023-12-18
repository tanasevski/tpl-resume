/**
 * Page is ready
 */
$(document).ready(function () {
  document.documentElement.classList.add("is-ready");
});

/**
 * Scripts
 */
(function ($) {
  "use strict";
  $.exists = function (selector) {
    return $(selector).length > 0;
  };
  $(window).on("load", function () {
    $(window).trigger("scroll");
    $(window).trigger("resize");
    Preloader();
    PagePrint();
    ShowMore();
    ToTop();
  });

  /**
   * Preloader
   */
  function Preloader() {
    $(".overlay_top").addClass("translate-top"),
      $(".overlay_bottom").addClass("translate-top");
  }

  /**
   * Print
   */
  function PagePrint() {
    $(".print").click(function () {
      window.print();
      return false;
    });
  }

  /**
   * Expand/Collapse
   */
  function ShowMore() {
    $(".work-button").click(function () {
      $(".work-button").toggleClass("show");
      $(".long-text").slideToggle(500);
      $(".short-text").slideToggle(500);
    });
  }

  /**
   * Back to top
   */
  function ToTop() {
    var progressPath = document.querySelector(".back-to-top path");
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "none";
    progressPath.style.strokeDasharray = pathLength + " " + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "stroke-dashoffset 10ms linear";
    var updateProgress = function () {
      var scroll = $(window).scrollTop();
      var height = $(document).height() - $(window).height();
      var progress = pathLength - (scroll * pathLength) / height;
      progressPath.style.strokeDashoffset = progress;
    };
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 200;
    var duration = 550;
    $(window).on("scroll", function () {
      if ($(this).scrollTop() > offset) {
        $(".back-to-top").addClass("active");
      } else {
        jQuery(".back-to-top").removeClass("active");
      }
    });
    $(".back-to-top").on("click", function (event) {
      event.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, duration);
      return false;
    });
  }
})(jQuery);
