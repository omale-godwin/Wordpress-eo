<?php
/* 
Template Name: Home Page
*/
get_header(); 
?>
<div class="main-body-container">
    <div id="scroll-button" class="scroll-button custom-maxW">
        <img src="https://cdn.electricoctopus.agency/ourwork/scroll-btn.png"
        alt="scroll"
        width="108"
        height="108"
        loading="lazy"
        decoding="async" />
    </div>
    <div id="section1" class="custom-maxW section">
        <?php get_template_part('template-parts/content', 'hero-section'); ?>
    </div>

    <div id="section2" class="tech-section section">
        <h2>Tech</h2>
        <p>Tech Stack We Work With</p>

        <div class="logo-sect img-slider">
            <?php 
            $tech_logos = get_field('tech_logos');
            if ($tech_logos) :
                foreach ($tech_logos as $logo) :
                    if (!empty($logo['url'])) : ?>
                        <div class="logo-img-slide">
                            <img 
                                src="<?php echo esc_url($logo['url']); ?>" 
                                alt="<?php echo esc_attr($logo['alt'] ?? 'Tech Logo'); ?>" 
                                loading="lazy" 
                            />
                        </div>
                    <?php endif;
                endforeach;
            endif;
            ?>
        </div>
    </div>

    <div id="section3">
        <div class="social-selling-routine custom-maxW">
            <div class="social-selling-routine-left">
                <h2>Data Without Borders</h2>
                <h3>Supporting B2B brands across 12+ industries for their marketing & sales operations</h3>
                <p class="selling-para">
                    We’ve assisted over <strong>770+ B2B Businesses</strong> in launching more than 
                    <strong>3000 multichannel marketing campaigns</strong>. Each dot on the map represents 
                    a partnership where Electric Octopus’s Go-To-Market strategies have transformed marketing 
                    challenges into quantifiable sales outcomes.
                </p>

                <div class="selling-data">
                    <?php
                    $stats = [
                        ['value' => '12+', 'text' => 'Industries transformed through programmatic marketing'],
                        ['value' => '2200+', 'text' => 'Projects delivered with measurable ROI'],
                        ['value' => '770+', 'text' => 'Active client partnerships driving continuous growth'],
                    ];

                    foreach ($stats as $stat) : ?>
                        <div>
                            <p class="selling-data-val"><?php echo esc_html($stat['value']); ?></p>
                            <p class="selling-data-txt"><?php echo esc_html($stat['text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="schedule-call-button">
                    <a href="#contact" aria-label="Schedule a call with an expert">Talk to Expert</a>
                </div>
            </div>

            <div class="social-selling-routine-right">
                <img 
                    src="https://cdn.electricoctopus.agency/ourwork/map-1.webp" 
                    alt="Global client partnership map" 
                    loading="lazy" 
                />
            </div>
        </div>
    </div>

<div id="section4" class="stripe-section section">
    <img 
        src="https://cdn.electricoctopus.agency/ourwork/Stripe.webp" 
        alt="Stripe Partnership Badge" 
        loading="lazy" 
    />
</div>

    <div id="casestudy" class="our-work-section custom-maxW section">
        
        <div class="case-study-section">
            <div class="case-study-left">
                <div class="our-work-section-head">
                    <h2>Meet our customers</h2>
                    <h3>Case Studies</h3>
                    <p>Results speak louder than promises. Browse our portfolio of successful partnerships where data-forward solutions created measurable business impact. Each case study demonstrates our commitment to driving meaningful metrics that matter to your bottom line.
                    </p>
                </div>
                <div class="casestudy-dropdown">
                    <!-- Industry Dropdown -->
                    <div  class="cat-filter-form">
                        <div class="cat-dropdown">
                       
                            <form id="industry-filter">
                                <select name="casestudy_industry" id="custom-industry-dropdown" class="custom-select placeholder" aria-label="Select Industry">
                                    <option value="">Industry</option>
                                    <?php 
                                    $industries = get_terms(['taxonomy' => 'casestudy_industry', 'hide_empty' => false]);
                                    foreach ($industries as $term) {
                                        $selected = (isset($_GET['filter']) && strpos($_GET['filter'], $term->slug) !== false) ? 'selected' : '';
                                        echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div  class="cat-filter-form">
                        <div class="cat-dropdown">
                            <form id="category-filter">
                                <select name="casestudy_category" id="custom-category-dropdown" class="custom-select placeholder" aria-label="Select Category">
                                    <option value="">Category</option>
                                    <?php 
                                    $categories = get_terms(['taxonomy' => 'casestudy_category', 'hide_empty' => false]);
                                    foreach ($categories as $term) {
                                        $selected = (isset($_GET['filter']) && strpos($_GET['filter'], $term->slug) !== false) ? 'selected' : '';
                                        echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <!-- Search Bar -->
                    <div class="search-post cat-filter-form">
                        <div class="cat-search">
                            <form id="search-form" class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                <input 
                                    type="text" 
                                    name="s" 
                                    placeholder="Search" 
                                    value="<?php echo esc_attr(get_search_query()); ?>" 
                                    id="search-input"
                                    autocomplete="off"
                                    maxlength="15"
                                />
                                <input type="hidden" name="post_type" value="case_studies">
                                <button type="submit" aria-label="Search">
                                    <img 
                                        loading="lazy"
                                        src="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png" 
                                        alt="Search icon" 
                                        class="cursor-point"
                                        width="24" height="24"
                                    >
                                </button>
                            </form>
                        </div>
                        <p>Max 15 Characters</p>
                    </div>
                </div>
                <div class="case-study-tags">
                    <h3>All Tags</h3>
                    <!-- Tag List (Dynamic Tags) -->
                    <div class="tag-list">
                        <?php 
                        $tags = get_terms([
                            'taxonomy' => 'post_tag',
                            'hide_empty' => false,
                            'number' => 20,
                            'orderby' => 'count',
                            'order' => 'DESC'
                        ]);

                        if (!empty($tags) && !is_wp_error($tags)) {
                            foreach ($tags as $tag) {
                                echo '<span class="custom-tag-link" data-tag-id="' . esc_attr($tag->term_id) . '" tabindex="0" role="button" aria-label="' . esc_attr($tag->name) . '">' . esc_html($tag->name) . '</span>';
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <div class="casestudy-post-sect">
                    <div id="filtered-posts">
                    <?php
                        $paged = max(1, get_query_var('paged', 1));
                        $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

                        $args = [
                            'post_type'      => 'case_studies',
                            'post_status'    => 'publish',
                            'posts_per_page' => 5,
                            'paged'          => $paged,
                            's'              => $search_query,
                        ];

                        if (!empty($_GET['filter'])) {
                            $filter_params = explode('/', sanitize_text_field($_GET['filter']));
                            $tax_query = [];

                            if (!empty($filter_params[0])) {
                                $tax_query[] = [
                                    'taxonomy' => 'casestudy_industry',
                                    'field'    => 'slug',
                                    'terms'    => $filter_params[0],
                                ];
                            }
                            if (!empty($filter_params[1])) {
                                $tax_query[] = [
                                    'taxonomy' => 'casestudy_category',
                                    'field'    => 'slug',
                                    'terms'    => $filter_params[1],
                                ];
                            }

                            if (!empty($tax_query)) {
                                $args['tax_query'] = $tax_query;
                            }
                        }

                        $query = new WP_Query($args);
                        
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                            ?>
                           <?php get_template_part('template-parts/case-study-view-block');?>
                                
                            <?php endwhile;
                        else :
                            echo '<p>No case studies found.</p>';
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>

                    <!-- Pagination with lazy-loaded icons -->
                    <div class="post-pagination" role="navigation" aria-label="Pagination Navigation">
                        <span data-page="first" aria-label="First Page">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/First.png" alt="First Page" class="first-page" loading="lazy">
                        </span>
                        <span data-page="prev" aria-label="Previous Page">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/Prev.png" alt="Previous Page" class="prev-page" loading="lazy">
                        </span>

                        <!-- These .page-number elements will be replaced dynamically -->
                        <span class="page-number active" data-page="1">1</span>
                        <span class="page-number" data-page="2">2</span>
                        <span class="page-number" data-page="3">3</span>
                        <span class="page-number" data-page="4">4</span>
                        <span class="page-number" data-page="5">5</span>

                        <span data-page="next" aria-label="Next Page">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/Next.png" alt="Next Page" class="next-page" loading="lazy">
                        </span>
                        <span data-page="last" aria-label="Last Page">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/Last.png" alt="Last Page" class="last-page" loading="lazy">
                        </span>
                    </div>
                </div>
            </div>
            <div class="case-study-right">             
                <div class="fav-block">
                    <h2>Business Insights & Trends</h2>
                    <div class="fav-img"><img src="https://cdn.electricoctopus.agency/ourwork/insigt-img.png" alt="insight" loading="lazy"/></div>
                    <p>Get the Exec’s Guide to understanding Business Insights for Your Function</p>
                    <div class="inspiration-block">
                        <a href="#" class="custom-button">Learn More</a>
                        <div class="insprtn-view"><img src="https://cdn.electricoctopus.agency/ourwork/view-graph.png" alt="view" loading="lazy"/>1.4K Views</div>
                    </div>                 
                </div>
                
                <div class="latest-post-block">
                    <h2>Blog - Most Viewed Articles </h2>
                    <?php echo do_shortcode('[most_viewed_articles]'); ?>
            
                </div>
                <div class="side-banner-block" style="background-image:url(https://cdn.electricoctopus.agency/ourwork/ourwork-side-banner.webp)">
                    <h2>Create Stunning </h2>
                    <h3>Websites</h3>
                    <p>To exceed quotas, your sales team must master social selling.</p>
                    <div><a href="#" class="msg-button">Learn More</a></div>
                    <div class="tech-logo">
                        <img src="https://cdn.electricoctopus.agency/ourwork/wo-1.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/wo-2.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/comp-logo1.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/comp-logo2.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/comp-logo3.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/comp-logo4.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/comp-logo5.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/comp-logo6.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/comp-logo7.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/comp-logo8.png" alt="logo" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/wo-3.png" alt="logo" loading="lazy"/>
                    </div>
                </div>
                 <div class="latest-post-block">
                    <h2>Blog - Latest Articles </h2>
                    <?php echo do_shortcode('[fetch_custom_posts]'); ?>
          
                </div>
                <div class="insight-tech">
                    <h2>Insights - Technology</h2>
                    <div class="fav-img"><img src="https://cdn.electricoctopus.agency/ourwork/insight-tech.png" alt="insight" loading="lazy"/></div>
                    <h3>Investing to Win in a shifting technology market</h3>
                    <p>Get the Exec’s Guide to understanding Business Insights for Your Function</p>
                    <div class="insight-learnMore"><a href="#" class="custom-button">Learn More</a> </div>            
                </div>
                <div class="followus-block mt-24">
                    <h3>Follow us on</h3>
                    <div class="foo-social-links mt-24">
                                <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/electric-octopus/media_ico11.png" loading="lazy" width="24" height="24"></a>
                                <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/electric-octopus/media_ico22.png" loading="lazy" width="25" height="24"></a>
                                <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/electric-octopus/media_ico33.png" loading="lazy" width="24" height="24"></a>
                                <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/electric-octopus/media_ico44.png" loading="lazy" width="25" height="24"></a>
                                <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/electric-octopus/media_ico55.png" loading="lazy" width="24" height="24"></a>
                                <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/electric-octopus/media_ico66.png" loading="lazy" width="25" height="24"></a>
                                <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/electric-octopus/media_ico77.png" loading="lazy" width="25" height="24"></a>                                           
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Section 6 -->
    <section id="section6" class="stripe-section section">
        <img src="https://cdn.electricoctopus.agency/ourwork/Stripe-img2.png" alt="Stripe Divider" loading="lazy">
    </section>
    <!-- Section 7 -->
    <section id="section7" class="marketing-agency-section section">
        <div class="custom-maxW agency-block">
            <div class="marketing-agency-left">
                <img src="https://cdn.electricoctopus.agency/ourwork/marketing-agncy.png" alt="Marketing Strategy" loading="lazy">
            </div>
            <div class="marketing-agency-right">
                <h2>Strategic Audience Segmentation</h2>
                <h3>We Find Your Perfect-Fit Prospects</h3>
                <p class="agency-para">
                    Our proprietary segmentation methodology divides broad markets into actionable customer groups based on shared characteristics and responsive triggers.
                </p>

                <?php
                $check_icon = 'https://cdn.electricoctopus.agency/ourwork/list-check1.png';
                $segmentation_points = [
                    'Firmographic and technographic data enrichment',
                    'AI-enhanced pattern recognition for segment identification',
                    'Multi-channel interaction tracking and analysis',
                    'Intent signal monitoring across digital ecosystems',
                ];
                ?>
                <ul>
                    <?php foreach ($segmentation_points as $point): ?>
                        <li>
                            <img src="<?php echo esc_url($check_icon); ?>" alt="Check Icon" loading="lazy">
                            <?php echo esc_html($point); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="selling-data">
                    <?php
                    $impact_stats = [
                        ['value' => '120%', 'text' => 'More effective resource allocation across segments'],
                        ['value' => '250%', 'text' => 'Higher engagement rates with segment-specific campaigns'],
                        ['value' => '100%', 'text' => 'Message resonance with tailored segment communications'],
                    ];
                    ?>
                    <?php foreach ($impact_stats as $stat): ?>
                        <div>
                            <p class="selling-data-val"><?php echo esc_html($stat['value']); ?></p>
                            <p class="selling-data-txt"><?php echo esc_html($stat['text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Section 8 -->
    <section id="section8" class="portfolio-sect custom-maxW section">
        <div class="portfolio-sect-left">
            <div class="portfolio-left-inner">
                <span>53%</span>
                <div class="portfolio-data">
                    <h3>Integrated Revenue Engine</h3>
                    <p>Average improvement in pipeline velocity through our integrated GTM architecture versus siloed marketing and sales approaches.</p>
                </div>
            </div>
            <div class="portfolio-left-inner">
                <span>644+</span>
                <div class="portfolio-data">
                    <h3>Acquisition To Advocacy</h3>
                    <p>Touchpoints analyzed and enhanced across the complete customer journey for optimal engagement at each stage.</p>
                </div>
            </div>
        </div>
        <div class="portfolio-sect-right">
            <h2>Revenue Acceleration</h2>
            <h3>Turn Attention Into Higher Yield: Sales Score Enhancement System</h3>
            <p>
                Our comprehensive approach optimizes every dimension of your revenue generation capabilities,
                creating predictable pipeline growth and conversion.
            </p>
            <div class="flex flex-wrap align-item-center gap-16">
                <a href="#" class="p-txt">Prospecting Consultancy 
                    <img src="https://cdn.electricoctopus.agency/ourwork/up-arrw1.png" alt="Arrow Icon" loading="lazy">
                </a>
                <a href="#" class="p-txt">Product Design & Development 
                    <img src="https://cdn.electricoctopus.agency/ourwork/up-arrw1.png" alt="Arrow Icon" loading="lazy">
                </a>
            </div>
        </div>
    </section>
    <!-- Section 9 -->
    <section id="section9" class="stripe-section section">
        <img src="https://cdn.electricoctopus.agency/ourwork/Banner-social.webp" alt="Social Engagement Banner" loading="lazy">
    </section>
    <!-- Section 10 -->
    <section id="section10" class="what-we-do custom-maxW section">
        <div class="what-we-do-left">
            <?php
            $services = [
                [
                    'heading' => 'Discovery & Strategy',
                    'text' => 'Electric Octopus begins with deep market analysis and competitive intelligence to identify opportunities for breakthrough performance gains.',
                    'image' => 'https://cdn.electricoctopus.agency/ourwork/b-up-icon.png',
                ],
                [
                    'heading' => 'Data-Driven Design & Dev',
                    'text' => 'Our conversion-focused approach to digital experiences has delivered 53% higher win rates and 75% increases in creative ad performance.',
                    'image' => 'https://cdn.electricoctopus.agency/ourwork/b-up-icon.png',
                ],
                [
                    'heading' => 'Integrated Implementation',
                    'text' => 'Seamless execution across channels creates cohesive customer journeys that generated 200% ROI for our semiconductor client.',
                    'image' => 'https://cdn.electricoctopus.agency/ourwork/b-up-icon.png',
                ],
                [
                    'heading' => 'Marketing Automation',
                    'text' => 'End-to-end automation streamlined lead qualification, reducing manual processes by 27% and increasing qualified opportunities by 183%.',
                    'image' => 'https://cdn.electricoctopus.agency/ourwork/b-up-icon.png',
                ],
            ];
            ?>
            <?php foreach ($services as $service): ?>
                <div class="do-left-1">
                    <div class="max-w">
                        <h3><?php echo esc_html($service['heading']); ?></h3>
                        <p><?php echo esc_html($service['text']); ?></p>
                    </div>
                    <span>
                        <img src="<?php echo esc_url($service['image']); ?>" alt="Section Icon" loading="lazy">
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="what-we-do-right">
            <h3 class="mb-16">Why Electric Octopus</h3>
            <p>
                Our integrated design & marketing solutions generate meaningful ROI and enable your organization to realize:
            </p>
            <div>
                <img src="https://cdn.electricoctopus.agency/ourwork/why-img.png" alt="Why Us Illustration" loading="lazy">
            </div>
        </div>
    </section>
    <!-- Section 11: Authority Impact -->
    <section id="section11" class="media-authority custom-maxW section">
        <div class="media-authority-left">
            <h2 class="mb-16">The Electric Octopus Advantage: Measurable Impact</h2>
            <p>Electric Octopus integrated design & marketing transformed the entire customer journey for enterprise clients, achieving 53% higher conversion rates and 200% ROI through data-driven optimizations.</p>
        </div>
        <div class="media-authority-right">
            <?php
            $stats = [
                ['heading' => 'Win Rate', 'value' => '53%', 'text' => 'Higher conversion rates through optimized customer journeys'],
                ['heading' => 'Pipeline Growth', 'value' => '183%', 'text' => 'Increase in qualified opportunities through our lead gen systems'],
                ['heading' => 'Creative Ads', 'value' => '75%', 'text' => 'Increased engagement with data-backed creative strategies'],
                ['heading' => 'Efficiency Gains', 'value' => '27%', 'text' => 'Reduction in sales cycle time through automated qualification processes'],
            ];
            foreach ($stats as $stat) : ?>
                <div class="authority-right-block">
                    <h3><?php echo esc_html($stat['heading']); ?></h3>
                    <p class="authority-val"><?php echo esc_html($stat['value']); ?></p>
                    <p class="authority-para"><?php echo esc_html($stat['text']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- Section 12: Stripe Divider -->
    <section id="section12" class="stripe-section section">
        <img src="https://cdn.electricoctopus.agency/ourwork/Stripe-img3.png" alt="Divider graphic" loading="lazy">
    </section>

    <!-- Section 13: Testimonials -->
    <section id="section13" class="testimonial-section custom-maxW section">
        <div class="testimonial-head">
            <h2>Testimonials</h2>
            <p>What Our Customers Say About Our Revenue Services to Shorten Sales Cycles and Win More Deals</p>
        </div>
        <div class="testimonial-sect">
            <?php if (have_rows('testimonials')) : ?>
                <!-- Tabs -->
                <div class="testimonial-tabs-nav">
                    <?php foreach (get_field('testimonials') as $index => $tab) : ?>
                        <button class="tab-toggle <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo esc_attr($index); ?>">
                            <span>
                                <img src="<?php echo esc_url($tab['tab_image']); ?>" alt="<?php echo esc_attr($tab['tab_title']); ?>" loading="lazy">
                            </span>
                            <?php echo esc_html($tab['tab_title']); ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Tab Content -->
                <div class="testimonial-tabs-content">
                    <?php $tabIndex = 0; ?>
                    <?php while (have_rows('testimonials')) : the_row(); ?>
                        <div class="testimonial-tab-group <?php echo $tabIndex === 0 ? 'active' : ''; ?>" data-index="<?php echo esc_attr($tabIndex); ?>">
                            <?php if (have_rows('tab_testimonials')) : $count = 0; ?>
                                <?php while (have_rows('tab_testimonials')) : the_row(); if ($count++ >= 3) break; ?>
                                    <div class="testimonial-slider-inner">
                                        <div class="testimonial-user">
                                            <img src="<?php the_sub_field('user_image'); ?>" alt="<?php the_sub_field('user_name'); ?>" class="testi-user-img" loading="lazy" />
                                            <div class="testimonial-user-right">
                                                <h3><?php the_sub_field('user_name'); ?></h3>
                                                <p><?php the_sub_field('user_position'); ?></p>
                                                <?php
                                                $star_rating = get_sub_field('star_rating');
                                                if ($star_rating) :
                                                    echo '<div class="star-rating">';
                                                    for ($i = 1; $i <= $star_rating; $i++) {
                                                        echo '<img src="https://cdn.electricoctopus.agency/ourwork/b-Star-1.png" alt="Star" loading="lazy">';
                                                    }
                                                    echo '</div>';
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="testimonial-budget">Budget: <?php the_sub_field('budget'); ?></div>
                                        <p class="testimonial-para"><?php the_sub_field('description'); ?></p>

                                        <div class="testimonial-sound">
                                            <span><img src="https://cdn.electricoctopus.agency/ourwork/PlayerPlay.png" alt="Play Audio" loading="lazy"></span>
                                            <span><img src="https://cdn.electricoctopus.agency/ourwork/music-1.png" alt="Audio Waveform" loading="lazy"></span>
                                            <span class="music-time">0:05</span>
                                            <span><img src="https://cdn.electricoctopus.agency/ourwork/PlayerVolume.png" alt="Adjust Volume" loading="lazy"></span>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <?php $tabIndex++; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Section: Our Services -->
    <section id="section-ourServices" class="our-services custom-maxW section">
        <div class="testimonial-head">
            <h2>Our Services</h2>
            <p>Full Support Digital Marketing</p>
        </div>   
        <div>
            <?php if (have_rows('service_slider')) : ?>
                <div class="services-slider">
                    <?php while (have_rows('service_slider')) : the_row();
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $description = get_sub_field('service_description');
                    ?>
                        <div class="service-slide">
                            <?php if ($icon) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="service-icon" loading="lazy" />
                            <?php endif; ?>
                            <h3><?php echo esc_html($title); ?></h3>
                            <p><?php echo esc_html($description); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>                         
    </section>

    <!-- Section 14: Trusted Companies -->
    <section id="section14" class="trusted-company-section custom-maxW section">
        <h2>Trusted by Many</h2>
        <p>Trusted by industry-leading enterprises and organizations of all sizes</p>
        <div class="trusted-img-block">
            <?php if (have_rows('industry_icons')) : ?>
                <div class="industry-icon-grid-wrapper">
                    <?php
                    $count = 0;
                    while (have_rows('industry_icons')) : the_row();
                        if ($count % 5 === 0) {
                            $rowClass = $count >= 15 ? 'industry-icon-row hidden-row' : 'industry-icon-row';
                            echo '<div class="' . esc_attr($rowClass) . '">';
                        }
                    ?>
                        <div class="industry-icon-item">
                            <span><img src="<?php the_sub_field('industry_icon'); ?>" alt="<?php the_sub_field('industry_label'); ?>" loading="lazy"></span>
                            <p><?php the_sub_field('industry_label'); ?></p>
                        </div>
                    <?php
                        $count++;
                        if ($count % 5 === 0) echo '</div>';
                    endwhile;
                    if ($count % 5 !== 0) echo '</div>';
                    ?>
                </div>

                <?php if ($count > 15) : ?>
                    <button id="showMoreBtn" class="show-more-btn">Show More <span class="toggle-icon">+</span></button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
    <div id="section15" class="mini-closure-section section">
        <div class="custom-maxW">
            <div class="mini-closure-inner">
                <div class="mini-closure-left">
                    <h3>Mini Course</h3>
                    <p class="para1">Get a growth strategy that comes with the vital website tracking tools you can use</p>
                    <p class="para2">
                        Get more leads from social media ads in 28 days, guaranteed*. For only 
                        <strong>$37.99</strong>, I'll show you how to get more leads from social media ads 
                        (or I'll work for <strong>free</strong> until you do*)</p>
                    <div><a href="#" class="course-button" role="button">Join Waitlist</a></div>
                    <p class="condition-txt">* Conditions apply</p>

                    <div class="user-view-block" aria-label="User avatars">
                        <img src="https://cdn.electricoctopus.agency/ourwork/mini-user1.png" alt="User 1" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/mini-user2.png" alt="User 2" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/mini-user3.png" alt="User 3" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/mini-user4.png" alt="User 4" loading="lazy"/>
                        <img src="https://cdn.electricoctopus.agency/ourwork/mini-user5.png" alt="User 5" loading="lazy"/>
                    </div>

                    <div class="user-review-sect">
                        <div class="review-count"><span>67</span> reviews on</div>
                        <img src="https://cdn.electricoctopus.agency/ourwork/g-logo.png" alt="Google Reviews" loading="lazy"/>
                        <div class="star-rating" aria-label="Rated 5 stars">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <img src="https://cdn.electricoctopus.agency/ourwork/g-Star.png" alt="Star" loading="lazy"/>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <div class="mini-closure-right">
                    <img src="https://cdn.electricoctopus.agency/ourwork/mini-book.png" alt="Mini Course Book Image" loading="lazy"/>
                </div>
            </div>
        </div>
    </div>
    <div id="section16" class="faqs section">
        <div class="custom-maxW">
            <div class="faq-section">
                <div class="faq-left">
                    <h2>Frequently Asked Questions</h2>
                    <h3>Here’s Our Common Question We Had So Far</h3>
                    <p>I specialize in crafting data-driven strategies that drive growth and engagement across performance marketing, email campaigns, and B2B initiatives. Explore my portfolio to see how I transform ideas into impactful results.</p>
                </div>

                <div class="faq-right">
                    <?php if (have_rows('faqs')) : ?>
                        <div class="faq-wrapper" role="list">
                            <?php $index = 0; ?>
                            <?php while (have_rows('faqs')) : the_row(); 
                                $question = get_sub_field('question');
                                $answer = get_sub_field('answer'); 
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
                                        <svg class="toggle-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
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
        </div>
    </div>

    <?php get_template_part( 'template-parts/content', 'common-section' ); ?>
</div>
<?php if ( isset($query) && $query instanceof WP_Query ) : ?>
    <script>
        const pagination_data = {
            ajax_url: "<?php echo admin_url('admin-ajax.php'); ?>",
            max_pages: <?php echo $query->max_num_pages; ?>
        };
    </script>
<?php endif; ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const paginationContainer = document.querySelector(".post-pagination");
    const postsContainer = document.querySelector("#filtered-posts");
    const maxPages = parseInt(pagination_data.max_pages) || 1;
    let currentPage = 1;

    function renderPagination(currentPage) {
        // Remove old .page-number spans
        paginationContainer.querySelectorAll(".page-number").forEach(el => el.remove());

        const maxVisible = 5;
        let start = Math.max(1, currentPage - Math.floor(maxVisible / 2));
        let end = start + maxVisible - 1;

        if (end > maxPages) {
            end = maxPages;
            start = Math.max(1, end - maxVisible + 1);
        }

        // Insert before the next button
        const nextBtn = paginationContainer.querySelector("[data-page='next']");

        for (let i = start; i <= end; i++) {
            const span = document.createElement("span");
            span.classList.add("page-number");
            if (i === currentPage) span.classList.add("active");
            span.dataset.page = i;
            span.textContent = i;
            paginationContainer.insertBefore(span, nextBtn);
        }
    }

    function fetchPosts(page) {
        const category = document.querySelector("#custom-category-dropdown")?.value || "";
        const industry = document.querySelector("#custom-industry-dropdown")?.value || "";
        const searchQuery = document.querySelector("#search-input")?.value || "";

        const data = new FormData();
        data.append("action", "load_posts");
        data.append("page", page);
        data.append("search_query", searchQuery);
        data.append("category", category);
        data.append("industry", industry);

        fetch(pagination_data.ajax_url, {
            method: "POST",
            body: data,
        })
        .then((response) => response.text())
        .then((html) => {
            postsContainer.innerHTML = html;
            currentPage = page;
            renderPagination(currentPage);
        })
        .catch((error) => console.error("Fetch error:", error));
    }

    paginationContainer.addEventListener("click", function (e) {
        const target = e.target.closest("img, span");
        if (!target) return;

        let page = currentPage;

        if (target.classList.contains("next-page")) {
            page = Math.min(currentPage + 1, maxPages);
        } else if (target.classList.contains("prev-page")) {
            page = Math.max(currentPage - 1, 1);
        } else if (target.classList.contains("first-page")) {
            page = 1;
        } else if (target.classList.contains("last-page")) {
            page = maxPages;
        } else if (target.classList.contains("page-number")) {
            page = parseInt(target.dataset.page);
        }

        if (page !== currentPage) {
            fetchPosts(page);
        }
    });

    // Dropdown listeners
    document.querySelector("#custom-category-dropdown")?.addEventListener("change", () => fetchPosts(1));
    document.querySelector("#custom-industry-dropdown")?.addEventListener("change", () => fetchPosts(1));
    document.querySelector("#search-input")?.addEventListener("input", () => fetchPosts(1));

    // First render
    renderPagination(currentPage);
});
</script>
<!-- //for dynamic url -->
<script>
    // JavaScript to handle dynamic URL generation and form submission
    document.addEventListener('DOMContentLoaded', function() {
        const industryDropdown = document.getElementById('custom-industry-dropdown');
        const categoryDropdown = document.getElementById('custom-category-dropdown');
        const searchInput = document.getElementById('search-input');
        
        function updateUrl() {
            const industry = industryDropdown.value;
            const category = categoryDropdown.value;
            let search = searchInput.value;

            // Replace spaces with hyphens for URL compatibility
            search = search.replace(/\s+/g, '-');

            // Build the filter string: industry/category/search
            let filter = 'filter=';
            if ( industry ) {
                filter += industry;
            }
            if ( category ) {
                filter += '/' + category;
            }
            if ( search ) {
                filter += '/' + search;
            }
            // Update the URL path (modify the path if needed)
            window.history.pushState({}, '', '/case-study?' + filter);
        }

        // Add event listeners
        industryDropdown.addEventListener('change', updateUrl);
        categoryDropdown.addEventListener('change', updateUrl);
        searchInput.addEventListener('input', updateUrl);
    });
</script>
<?php get_footer(); ?>