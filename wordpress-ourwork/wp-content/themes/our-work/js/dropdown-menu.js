jQuery(document).ready(function ($) {
  $(".menu-item-has-children > a").on("click", function (e) {
    var $submenu = $(this).siblings(".sub-menu");

    if ($submenu.length > 0) {
      e.preventDefault();
      $submenu.stop(true, true).slideToggle(200);
      $(".sub-menu").not($submenu).slideUp(200);
    }
  });

  $(document).on("click", function (e) {
    if (!$(e.target).closest(".header-menu").length) {
      $(".sub-menu").slideUp(200);
    }
  });
});
