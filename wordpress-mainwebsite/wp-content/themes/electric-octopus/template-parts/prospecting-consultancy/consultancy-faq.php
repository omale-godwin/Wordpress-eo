 <section class="custom-maxW pt-110">
    <div class="faq section">
        <div class="faq-left">
            <h2 class="top-heading mb-16"> Frequently Asked Questions</h2>
            <h3 class="top-sub-heading mb-24"> Here’s Our Common<br/> Question We Had So Far</h3>
            <p class="common-para">I specialize in crafting data-driven strategies that drive growth and engagement across performance marketing, email campaigns, and B2B initiatives. Explore my portfolio to see how I transform ideas into impactful results.</p>
        </div>
        <div class="faq-block">
                    <?php if (have_rows('features_faq')) : ?>
                        <div class="faq-wrapper" role="list">
                            <?php $index = 0; ?>
                            <?php while (have_rows('features_faq')) : the_row(); 
                                $question = get_sub_field('question');
                                $answer   = get_sub_field('answer'); 
                                $is_first = ($index === 0);
                            ?>
                                <div class="faq-item" role="listitem">
                                    <button 
                                        class="faq-question" 
                                        aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>" 
                                        aria-controls="faq-answer-<?php echo $index; ?>" 
                                        id="faq-question-<?php echo $index; ?>" 
                                        type="button"
                                    >
                                        <?php echo esc_html($question); ?>
                                        <span class="faq-icon" aria-hidden="true"></span>
                                    </button>

                                    <div 
                                        id="faq-answer-<?php echo $index; ?>" 
                                        class="faq-answer" 
                                        role="region" 
                                        aria-labelledby="faq-question-<?php echo $index; ?>" 
                                        <?php echo !$is_first ? 'hidden' : ''; ?>
                                    >
                                        <?php echo wp_kses_post($answer); ?>
                                    </div>
                                </div>
                                <?php $index++; ?>
                            <?php endwhile; ?>
                        </div>          
                    <?php endif; ?>
                </div>
    </div>
</section>