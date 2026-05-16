<?php
$post_url   = get_permalink();
$post_title = get_the_title();

// UTM parameters
$utm_params = [
  'utm_source'   => 'social_share',
  'utm_medium'   => 'organic',
  'utm_campaign' => 'article_share',
];

$post_url_with_utm = add_query_arg($utm_params, $post_url);

// For JS
$post_url_raw      = esc_url($post_url);
$post_url_for_copy = esc_url($post_url_with_utm);
?>



<!-- <div class="floating-social-wrapper" aria-label="Social Share Section">
  <div class="share-count" aria-hidden="true">
    <span class="count">966</span>
    <span class="label">Shares</span>
  </div>

  <div class="floating-social-icons">
  <a href="https://linkedin.com/in/yourprofile" target="_blank" rel="noopener noreferrer" class="social-icon linkedin" aria-label="Share on LinkedIn">
      <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/linkedin_ico.png" alt="LinkedIn Icon" width="32" height="32" loading="lazy">
    </a>
   

    <a href="https://twitter.com/yourprofile" target="_blank" rel="noopener noreferrer" class="social-icon twitter" aria-label="Share on Twitter">
      <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/twitter_ico.png" alt="Twitter Icon" width="32" height="32" loading="lazy">
    </a>

    <a href="https://instagram.com/yourprofile" target="_blank" rel="noopener noreferrer" class="social-icon instagram" aria-label="View on Instagram">
      <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/insta_ico.png" alt="Instagram Icon" width="32" height="32" loading="lazy">
    </a>

    <a href="https://facebook.com/yourpage" target="_blank" rel="noopener noreferrer" class="social-icon facebook" aria-label="Share on Facebook">
      <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/facebook_ico.png" alt="Facebook Icon" width="32" height="32" loading="lazy">
    </a>
  </div>
</div> -->
<div class="floating-social-wrapper">

  <div class="share-count">
    <span class="count" id="shareCount">0</span>
    <span class="label">Shares</span>
  </div>

  <div class="floating-social-icons">

    <!-- LinkedIn -->
    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($post_url_with_utm); ?>"
       target="_blank" rel="noopener">
      <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/linkedin_ico.png" width="32">
    </a>

    <!-- Twitter -->
    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($post_url_with_utm); ?>&text=<?php echo urlencode($post_title); ?>"
       target="_blank" rel="noopener">
      <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/twitter_ico.png" width="32">
    </a>

    <!-- Facebook -->
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($post_url_with_utm); ?>"
       target="_blank" rel="noopener">
      <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/facebook_ico.png" width="32">
    </a>

    <!-- Copy Link -->
    <!-- <button id="copyLinkBtn" class="copy-link-btn" aria-label="Copy link">
      📋
    </button> -->

  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

  // COPY LINK
  const copyBtn = document.getElementById("copyLinkBtn");
  const copyText = "<?php echo esc_js($post_url_for_copy); ?>";

  if (copyBtn) {
    copyBtn.addEventListener("click", () => {
      navigator.clipboard.writeText(copyText).then(() => {
        copyBtn.classList.add("copied");
        setTimeout(() => copyBtn.classList.remove("copied"), 1500);
      });
    });
  }

  // FLOATING VISIBILITY
  const floatBox = document.querySelector(".floating-social-wrapper");
  window.addEventListener("scroll", () => {
    floatBox.classList.toggle("visible", window.scrollY > 300);
  });

  // SIMPLE CLIENT-SIDE SHARE COUNT
  const shareCountEl = document.getElementById("shareCount");
  let count = localStorage.getItem("article_share_<?php echo get_the_ID(); ?>") || 0;
  shareCountEl.textContent = count;

  document.querySelectorAll(".floating-social-icons a").forEach(link => {
    link.addEventListener("click", () => {
      count++;
      localStorage.setItem("article_share_<?php echo get_the_ID(); ?>", count);
      shareCountEl.textContent = count;
    });
  });

});
</script>

