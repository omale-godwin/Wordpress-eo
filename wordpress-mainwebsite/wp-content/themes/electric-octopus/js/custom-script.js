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
// tabs functionality
  const tabButtons = document.querySelectorAll(".tab-btn");
  const tabPanels = document.querySelectorAll(".tab-panel");

  tabButtons.forEach((btn, index) => {
    btn.addEventListener("click", () => {
      
      // Remove active from all
      tabButtons.forEach(b => b.classList.remove("active"));
      tabPanels.forEach(panel => panel.classList.remove("active"));

      // Activate clicked
      btn.classList.add("active");
      tabPanels[index].classList.add("active");
    });
  });

// FAQ collapse
// solution collapse
jQuery(document).ready(function($) {
  $(".faq-question").on("click", function() {
    var $button = $(this);
    var $parent = $button.closest(".faq-item");
    var $answer = $parent.find(".faq-answer");

    // Close all other FAQs
    $(".faq-item").not($parent).removeClass("active")
      .find(".faq-answer").slideUp().attr("hidden", true)
      .prev(".faq-question").attr("aria-expanded", "false");

    // Toggle the clicked FAQ
    var isActive = $parent.hasClass("active");
    if (isActive) {
      $parent.removeClass("active");
      $answer.slideUp().attr("hidden", true);
      $button.attr("aria-expanded", "false");
    } else {
      $parent.addClass("active");
      $answer.slideDown().attr("hidden", false);
      $button.attr("aria-expanded", "true");
    }
  });
});

// stack slide

document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.case-slider');
  if (!container) return;

  let slides = Array.from(container.querySelectorAll('.case-slide'));
  if (slides.length === 0) return;

  const AUTO_MS = 3000;
  let timer = null;
  let isAnimating = false;

  slides.forEach((s, i) => s.dataset.pid = i);

  function fitHeight() {
    const active = container.querySelector('.case-slide.active') || slides[0];
    if (!active) return;
    const h = Math.ceil(active.getBoundingClientRect().height);
    container.style.height = h + 'px';
  }

  function assignClasses() {
    slides.forEach(s =>
      s.classList.remove('active','next','next2','next3','out-left')
    );

    if (slides[0]) slides[0].classList.add('active');
    if (slides[1]) slides[1].classList.add('next');
    if (slides[2]) slides[2].classList.add('next2');
    if (slides[3]) slides[3].classList.add('next3');

    fitHeight();
    updateDots();
  }

  function rotateOnce() {
    return new Promise(resolve => {
      if (isAnimating || slides.length <= 1) {
        resolve();
        return;
      }

      isAnimating = true;
      const first = slides[0];
      assignClasses();
      first.classList.add('out-left');

      const finish = () => {
        first.removeEventListener('transitionend', finish);

        container.appendChild(first);
        slides = Array.from(container.querySelectorAll('.case-slide'));

        requestAnimationFrame(() => {
          assignClasses();
          isAnimating = false;
          resolve();
        });
      };

      first.addEventListener('transitionend', finish);

      setTimeout(() => {
        if (!isAnimating) return;
        try { first.removeEventListener('transitionend', finish); } catch {}
        container.appendChild(first);
        slides = Array.from(container.querySelectorAll('.case-slide'));
        requestAnimationFrame(() => {
          assignClasses();
          isAnimating = false;
          resolve();
        });
      }, 900);
    });
  }

  async function goTo(targetPid) {
    if (isAnimating) return;

    const active = container.querySelector('.case-slide.active');
    const currentPid = parseInt(active.dataset.pid);

    if (targetPid === currentPid) return;

    let steps = (targetPid - currentPid + slides.length) % slides.length;

    while (steps-- > 0) {
      await rotateOnce();
    }
  }

  function startAuto() {
    stopAuto();
    timer = setInterval(rotateOnce, AUTO_MS);
  }

  function stopAuto() {
    if (timer) clearInterval(timer);
    timer = null;
  }

  const dotsContainer = document.createElement('div');
  dotsContainer.classList.add('case-dots');
  container.appendChild(dotsContainer);

  let dots = [];

  slides.forEach((slide, i) => {
    const dot = document.createElement('span');
    dot.classList.add('dot');
    if (i === 0) dot.classList.add('active');

    dot.dataset.pid = i;
    dotsContainer.appendChild(dot);
    dots.push(dot);

    dot.addEventListener('click', () => {
      goTo(parseInt(dot.dataset.pid));
    });
  });

  function updateDots() {
    const active = container.querySelector('.case-slide.active');
    const pid = parseInt(active.dataset.pid);

    dots.forEach(d => d.classList.remove('active'));
    const match = dots.find(d => parseInt(d.dataset.pid) === pid);
    if (match) match.classList.add('active');
  }

  assignClasses();
  startAuto();

  container.addEventListener('mouseenter', stopAuto);
  container.addEventListener('mouseleave', startAuto);

  window.addEventListener('resize', () => requestAnimationFrame(fitHeight));
});





