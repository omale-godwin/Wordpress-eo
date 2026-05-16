<?php
if (!comments_open()) return;
?>

<section class="comment-section mt-24" id="comments">

  <div class="comments-wrapper">

    <?php
    wp_list_comments([
        'style'      => 'none', // 🔥 IMPORTANT
        'callback'   => 'eo_comment_layout',
        'avatar_size'=> 48,
        'max_depth'  => 2,
        'status'      => 'approve',
    ]);

    ?>

  </div>


  <h3>Leave a reply</h3>

  <p class="dtail-para mt-16">
   Your perspective matters. Share your insights, thoughts, or questions below. Our team reads every comment and is always eager to exchange ideas that push brand, tech, and growth conversations forward.


  </p>

  <div class="reply-form">

    <form
      method="post"
      action="<?php echo site_url('/wp-comments-post.php'); ?>"
      class="reply-form-inner"
      autocomplete="off"
    >

      <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
      <input type="hidden" name="comment_parent" id="comment_parent" value="0">

      <?php wp_nonce_field('comment_nonce_action', 'comment_nonce'); ?>

      <div class="flex gap-16 mt-24">
        <input
          type="text"
          name="author"
          placeholder="Your name"
          class="reply-input"
          required
          autocomplete="off"
        >

        <input
          type="email"
          name="email"
          placeholder="Work Email"
          class="reply-input"
          required
          autocomplete="off"
        >
      </div>

      <textarea
        name="comment"
        placeholder="Type your message"
        required
        autocomplete="off"
      ></textarea>

      <div class="formSubmit-Btn">
        <button
            type="submit"
            name="submit"
            class="reply-submit-btn mt-24"
            disabled
            >
            Submit
        </button>

      </div>

    </form>

  </div>

</section>
