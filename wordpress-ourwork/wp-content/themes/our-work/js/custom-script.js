document.addEventListener("DOMContentLoaded", function () {
    const headerNav = document.querySelector(".header-main-nav");
    const headerBox = document.querySelector(".header-box");

    if (headerNav && headerBox) {
        const stickyPoint = headerBox.offsetHeight; // trigger after full header

        window.addEventListener("scroll", function () {
            if (window.scrollY > stickyPoint) {
                headerNav.classList.add("sticky");
            } else {
                headerNav.classList.remove("sticky");
            }
        });
    }
});
/*for toggle menu*/
function togglediv(id, icon) {
    var id = document.getElementById(id);
    id.classList.toggle('active');
    var cross = document.getElementById(icon);
    cross.classList.toggle('close');
  
}
// show more/less tags
jQuery(document).ready(function($) {
    $('#toggle-tags').on('click', function() {
        var $hiddenTags = $('.hidden-tags');
        var isVisible = $hiddenTags.first().is(':visible');

        if (isVisible) {
            $hiddenTags.slideUp();
            $(this).html('show more <span>+</span>');
        } else {
            $hiddenTags.slideDown();
            $(this).html('show less <span>-</span>');
        }
    });
});
// reply submit button
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".reply-form-inner");
  if (!form) return;

  const inputs = form.querySelectorAll(
    'input[name="author"], input[name="email"], textarea[name="comment"]'
  );

  const submitBtn = form.querySelector(".reply-submit-btn");

  function validateForm() {
    let allFilled = true;

    inputs.forEach(input => {
      if (!input.value.trim()) {
        allFilled = false;
      }
    });

    if (allFilled) {
      submitBtn.classList.add("active");
      submitBtn.removeAttribute("disabled");
    } else {
      submitBtn.classList.remove("active");
      submitBtn.setAttribute("disabled", "disabled");
    }
  }

  inputs.forEach(input => {
    input.addEventListener("input", validateForm);
  });
});


  





