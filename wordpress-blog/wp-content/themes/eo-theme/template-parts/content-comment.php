<?php
/**
 * Template part for displaying Comment form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OC-theme
 */

?>

<div class="comment-section mt-24">
    <h3>Leave a reply</h3>
    <p class="dtail-para mt-16">
        <!-- Add your voice to the discussion. Share your insights, feedback, or questions below. Your email address will remain confidential.... -->
         Your perspective matters. Share your insights, thoughts, or questions below. Our team reads every comment and is always eager to exchange ideas that push brand, tech, and growth conversations forward.
    </p>    
    <div class="reply-form">
        <form id="replyForm">
			<div class="flex gap-16 mt-24">
            <input placeholder="Your name" class="reply-input " id="email" type="text" required="">
            <input placeholder="Work email" class="reply-input" id="email" type="email" required="">
			</div>
            <textarea placeholder="Type your message" id="message" required="">        </textarea>
            <div class="formSubmit-Btn"><button type="submit" class="reply-submit-btn mt-24">Submit</button></div>
        </form>  
        <p id="formResponse" class="form-response-message mt-16"></p>
    </div>
</div>