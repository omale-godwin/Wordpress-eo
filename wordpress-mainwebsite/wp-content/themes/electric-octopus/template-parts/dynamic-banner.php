<div class="keap-banner">
    <div class="ticker-wrapper">
        <div class="ticker-content">
            <span class="ticker-item">
                You’re seeing our fresh new design! We’re updating the rest of the pages, as part of our site-wide redesign | 
            </span>
            <span class="ticker-item">
                You’re seeing our fresh new design! We’re updating the rest of the pages, as part of our site-wide redesign | 
            </span>
            <span class="ticker-item">
                You’re seeing our fresh new design! We’re updating the rest of the pages, as part of our site-wide redesign | 
            </span>
            <span class="ticker-item">
                You’re seeing our fresh new design! We’re updating the rest of the pages, as part of our site-wide redesign | 
            </span>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Array of color options
    const colors = ["#F1FF72", "#FEB033", "#33CFFE", "#86FF46"];
  
    // Pick a random color
    const randomColor = colors[Math.floor(Math.random() * colors.length)];
  
    // Apply it to the banner
    const banner = document.querySelector(".keap-banner");
    banner.style.backgroundColor = randomColor;
  
    // Adjust text and close icon color if background is white
    if (randomColor.toUpperCase() === "#FFFFFF") {
      banner.style.color = "#000000";
      const closeIcon = banner.querySelector(".close-banner");
      if (closeIcon) {
        closeIcon.style.color = "#000000";
      }
      // Optional: If you have links inside the banner
      const links = banner.querySelectorAll("a");
      links.forEach(link => {
        link.style.color = "#000000";
      });
    }
  });
</script>