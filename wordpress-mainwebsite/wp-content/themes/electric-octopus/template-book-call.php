<?php
/**
 * Template Name: Book a Call
 */
get_header();
?>

<main class="book-call-page">

  <!-- 1. HERO -->
  <?php get_template_part('template-parts/talk-to-expert/book-a-call/hero-section'); ?>

  <!-- 2. WHAT TO EXPECT -->
   <?php get_template_part('template-parts/talk-to-expert/book-a-call/what-to-expect'); ?>


  <!-- 3. TRUSTED LOGOS -->
  <?php get_template_part('template-parts/talk-to-expert/book-a-call/trusted-clients'); ?>

  <!-- 4. FEATURE GRID -->
<section class="problems-section pt-110">
  <div class="container">

    <!-- TOP CONTENT -->
    <div class="top-grid custom-maxW">
      <div class="left">
        <h2 class="top-heading mb-24">Problems we solve </h2>
          <h3 class="top-sub-heading">The Modern B2B Challenge: Fragmented Systems & Lost Opportunities</h3>
      </div>

      <ul class="right">
        <li><img src="https://cdn.electricoctopus.agency/electric-octopus/tick-big.png" alt="tick" width="17" height="17" loading="lazy"> Missed revenue opportunities from inadequate prospect targeting and engagement</li>
        <li><img src="https://cdn.electricoctopus.agency/electric-octopus/tick-big.png" alt="tick" width="17" height="17" loading="lazy">Database preparation (1,000 contacts)</li>
        <li><img src="https://cdn.electricoctopus.agency/electric-octopus/tick-big.png" alt="tick" width="17" height="17" loading="lazy">Database preparation (1,000 contacts)</li>
      </ul>
    </div>

    <?php
    $cdn = "https://cdn.electricoctopus.agency/electric-octopus/";
    $cards = [
      [
        'title' => "Data-Enriched Targeting & Outreach",
        'desc'  => "Our multi-channel prospecting strategies combine precision targeting with personalized engagement to connect with decision-makers who are ready to buy.",
        'image' => "p-img1.webp"
      ],
      [
        'title' => "Go-to-Market Strategy Optimization",
        'desc'  => "We transform your GTM approach into a scalable commercial engine.",
        'image' => "p-img2.webp"
      ],
      [
        'title' => "Revenue Technology Integration",
        'desc'  => "Seamlessly integrate CRM, marketing automation, and analytics.",
        'image' => "p-img3.webp"
      ],
      [
        'title' => "Sales Process Enhancement",
        'desc'  => "Optimize pipelines, enable sales teams, and close faster.",
        'image' => "p-img4.webp"
      ],
      [
        'title' => "Unified Commercial Engine",
        'desc'  => "Our multi-channel prospecting strategies combine precision targeting with personalized engagement to connect with decision-makers who are ready to buy.",
        'image' => "p-img5.webp"
      ],
    ];
    ?>

    <div class="cards-row">
      <?php foreach ($cards as $card): ?>
        <div class="card">
          <div class="card-inner">

            <div class="content">
              <h3><?php echo $card['title']; ?></h3>
              <p class="card-desc"><?php echo esc_html($card['desc']); ?></p>
              <a class="cta">GET STARTED <span><img src="https://cdn.electricoctopus.agency/electric-octopus/up-cur.png"></span></a>
            </div>

            <div class="image">
              <img src="<?php echo esc_url($cdn . $card['image']); ?>" alt="">
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>



      </div>
</section>



  <!-- 5. MARQUEE -->
 <div class="stripe"><img src="https://cdn.electricoctopus.agency/electric-octopus/p-strip.webp" alt="stripe" width="100%"></div>

  <!-- 6. TEAM GRID -->
<section class="team-section pt-110">
  <div class="custom-maxW">
    <div class="team-wrapper-block">

      <!-- LEFT CONTENT -->
      <div class="team-content-block">
        <span class="top-heading">TEAM</span>

        <h2 class="top-sub-heading mb-24">
          We're changing the way the world thinks<br>
          about Marketing & Sales.
        </h2>

        <p class="common-para mb-24">
          We run and grow with ease, powering high-growth B2B brands
        </p>

        <a href="#" class="purple-button">VIEW ALL MEMBERS</a>
      </div>

      <!-- RIGHT GRID -->
      <div class="team-grid">
        <div class="team-card"><img src="https://cdn.electricoctopus.agency/electric-octopus/team-img1.webp" alt=""></div>
        <div class="team-card"><img src="https://cdn.electricoctopus.agency/electric-octopus/team-img2.webp" alt=""></div>
      
      </div>
        
    </div>
    <div class="bottom-team-card">
        <div class="team-card"><img src="https://cdn.electricoctopus.agency/electric-octopus/team-img3.webp" alt=""></div>
        <div class="team-card"><img src="https://cdn.electricoctopus.agency/electric-octopus/team-img4.webp" alt=""></div>
        <div class="team-card"><img src="https://cdn.electricoctopus.agency/electric-octopus/team-img5.webp" alt=""></div>
        <div class="team-card"><img src="https://cdn.electricoctopus.agency/electric-octopus/team-img6.webp" alt=""></div>
      </div>  
  </div>
</section>


  <!-- 7. VALUES (CIRCULAR ICONS) -->
  <section class="values custom-maxW pt-110">
    <div class="values-wrapper">
          <h2 class="top-heading text-center mb-24">HOW GO-TO-MARKET WORKS</h2>
          <h3 class="top-sub-heading text-center">Scale Revenue When Others Fail</h3>
          <p class="common-para text-center mt-16 mb-24">
              Our team of GTM experts would plan and launch a multichannel campaign 
                that aligns your marketing to your sales strategies and revenue goals. 
          </p>
      </div>
      <div>
          <img src="https://cdn.electricoctopus.agency/electric-octopus/val-img4.webp" alt="banner">
          <div class="val-bottom-txt">
              <p>Learn how intent data enhances precision, personalization, and timing to drive better sales and marketing outcomes</p>
              <a href="#" class="purple-button">Learn More</a>
          </div>
      </div>
  </section>
  <!-- 8. STATS -->
<div class="stripe"><img src="https://cdn.electricoctopus.agency/electric-octopus/p-strip2.webp" alt="stripe" width="100%"></div>

  <!-- 9. EXPERT -->
<section class="customer-success  custom-maxW pt-110">
    <?php
  $customer_success_slides = [
    [
      'title' => 'CUSTOMER SUCCESS STORIES',
      'subTitle' => 'We don’t blow our own trumpet',
      'para' => 'Hear from customers who made the switch to Electric Octopus',
      'stats1' => '12+',
      'statsContent1' =>"Industries transformed through programmatic",
      'stats2' => '2200+',
      'statsContent2' =>"Projects delivered with measurable ROI",
      'stats3' => '770+',
      'statsContent3' =>"Active client partnerships driving ",
      'name' => 'Hamad Mubarak Al-Hajri',
      'role' => 'Head of Marketing, SamSonite',
      'quote' => '“Before, I’d use 4 different marketing agency for my ABM,
        Email Outbound and Paid Ads, now I have a single agency
        manages 90% of my qualified lead generation.”',
      'image' => 'customer-st1.webp'
    ],
    [
      'title' => 'CUSTOMER SUCCESS STORIES',
      'subTitle' => 'We don’t blow our own trumpet',
      'para' => 'Hear from customers who made the switch to Electric Octopus',
      'stats1' => '12+',
      'statsContent1' =>"Industries transformed through programmatic",
      'stats2' => '2200+',
      'statsContent2' =>"Projects delivered with measurable ROI",
      'stats3' => '770+',
      'statsContent3' =>"Active client partnerships driving ",
      'name' => 'Juan Pablo Ortega',
      'role' => 'Chief Executive Officer, Yuno',
      'quote' => '"Before, I\'d use 4 different marketing agency for my ABM, Email Outbound and Paid Ads, now I have a single agency manages 90% of my qualified lead generation"',
      'image' => 'customer-st2.webp'
    ],
    [
      'title' => 'CUSTOMER SUCCESS STORIES',
      'subTitle' => 'We don’t blow our own trumpet',
      'para' => 'Hear from customers who made the switch to Electric Octopus',
      'stats1' => '12+',
      'statsContent1' =>"Industries transformed through programmatic",
      'stats2' => '2200+',
      'statsContent2' =>"Projects delivered with measurable ROI",
      'stats3' => '770+',
      'statsContent3' =>"Active client partnerships driving ",
      'name' => 'Kristina Riakhina',
      'role' => 'Head of Growth, Manpower Group',
      'quote' => 'Electric Octopus delivers detailed ad performance reports, enabling data-driven decisions. With these insights, we quadrupled our lead volume and cut cost per lead by 20%.',
      'image' => 'customer-st3.webp'
    ],
    [
      'title' => 'CUSTOMER SUCCESS STORIES',
      'subTitle' => 'We don’t blow our own trumpet',
      'para' => 'Hear from customers who made the switch to Electric Octopus',
      'stats1' => '12+',
      'statsContent1' =>"Industries transformed through programmatic",
      'stats2' => '2200+',
      'statsContent2' =>"Projects delivered with measurable ROI",
      'stats3' => '770+',
      'statsContent3' =>"Active client partnerships driving ",
      'name' => 'Mikhail Bulanov',
      'role' => 'Head Of Customer Acquisition, Peninsula',
      'quote' => '"Electric Octopus product launch strategy for our new semiconductor line exceeded all expectations, generating 200% more pre-orders than projected."',
      'image' => 'customer-st4.webp'
    ],
  ];
  ?>

  <div class="customer-success-slider testomonial-slick-slider">

    <?php foreach ($customer_success_slides as $slide) : ?>
      <div>
        <div class="customer-success__container">

          <!-- LEFT CONTENT -->
          <div class="customer-success__content">

            <span class="customer-success__eyebrow">
              <?php echo esc_html($slide['title']); ?>
            </span>

            <h2 class="customer-success__title">
              <?php echo esc_html($slide['subTitle']); ?>
            </h2>

            <p class="customer-success__subtitle">
              <?php echo esc_html($slide['para']); ?>
            </p>

            <div class="customer-success__rating">★★★★★</div>

            <h3 class="customer-success__name">
              <?php echo esc_html($slide['name']); ?>
            </h3>

            <p class="customer-success__designation">
              <?php echo esc_html($slide['role']); ?>
            </p>

            <blockquote class="customer-success__quote">
              <?php echo esc_html($slide['quote']); ?>
            </blockquote>

            <!-- STATS -->
            <div class="customer-success__stats">

              <div class="customer-success__stat">
                <span class="customer-success__stat-value"><?php echo esc_html($slide['stats1']); ?></span>
                <span class="customer-success__stat-label">
                  <?php echo esc_html($slide['statsContent1']); ?>
                </span>
              </div>

              <div class="customer-success__stat">
                <span class="customer-success__stat-value"><?php echo esc_html($slide['stats2']); ?></span>
                <span class="customer-success__stat-label">
                  <?php echo esc_html($slide['statsContent2']); ?>
                </span>
              </div>

              <div class="customer-success__stat">
                <span class="customer-success__stat-value"><?php echo esc_html($slide['stats3']); ?></span>
                <span class="customer-success__stat-label">
                  <?php echo esc_html($slide['statsContent3']); ?>
                </span>
              </div>

            </div>

            <!-- CTA -->
            <div class="customer-success__actions">
              <a href="#" class="purple-button">READ THE CASE STUDY</a>
              <a href="#" class="purple-button">WATCH THE TECH TALK</a>
            </div>

          </div>

          <!-- RIGHT VISUAL -->
          <div class="customer-success__visual">
            <div class="customer-success__hero-image">
              <img
                src="https://cdn.electricoctopus.agency/electric-octopus/<?php echo esc_attr($slide['image']); ?>"
                alt="<?php echo esc_attr($slide['name']); ?>"
                loading="lazy"
              />
            </div>
          </div>

        </div>
      </div>
    <?php endforeach; ?>

  </div>

</section>
  <!-- 10. SOLUTIONS LIST -->
<section class="solutions">

  <div class="solutions__container">

    <!-- LEFT SIDE -->
    <div class="solutions__visual">

      <div class="solutions__image-wrapper">
        <div class="solutions__image active" data-index="0">
          <img src="https://cdn.electricoctopus.agency/electric-octopus/solution-img01.webp" alt="">
          <!-- FLOATING TEXT PILLS -->
            <div class="solutions__pills">
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
            </div>
        </div>
        
        <div class="solutions__image" data-index="1">
          <img src="https://cdn.electricoctopus.agency/electric-octopus/solution-2.webp" alt="">
          <!-- FLOATING TEXT PILLS -->
            <div class="solutions__pills">
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
            </div>
        </div>
        <div class="solutions__image" data-index="2">
          <img src="https://cdn.electricoctopus.agency/electric-octopus/solution-3.webp" alt="">
          <!-- FLOATING TEXT PILLS -->
            <div class="solutions__pills">
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
            </div>
        </div>
        <div class="solutions__image" data-index="3">
          <img src="https://cdn.electricoctopus.agency/electric-octopus/solution-4.webp" alt="">
          <!-- FLOATING TEXT PILLS -->
            <div class="solutions__pills">
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
            </div>
        </div>
        <div class="solutions__image" data-index="4">
          <img src="https://cdn.electricoctopus.agency/electric-octopus/solution-5.webp" alt="">
          <!-- FLOATING TEXT PILLS -->
            <div class="solutions__pills">
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
            </div>
        </div>
        <div class="solutions__image" data-index="5">
          <img src="https://cdn.electricoctopus.agency/electric-octopus/solution-6.webp" alt="">
          <!-- FLOATING TEXT PILLS -->
            <div class="solutions__pills">
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
              <div class="solutions__pill"><img src="https://cdn.electricoctopus.agency/electric-octopus/add_reaction.png" alt="" width="24" height="24"> Dummy text will come here</div>
            </div>
        </div>
      </div>

      

    </div>

    <!-- RIGHT SIDE -->
    <div class="solutions__content">

      <span class="top-heading mb-24">NEXUS PORTAL PLATFORM</span>
      <h2 class="top-sub-heading mb-24">
        Solutions for Your Biggest<br>Marketing Challenges
      </h2>

      <div class="solutions__accordion">

        <div class="solutions__item active" data-index="0">
          <div class="solutions__header">
            <span>01</span>
            <h4>Track marketing performance</h4>
            <i></i>
          </div>
          <div class="solutions__body">
            Before, I’d use 4 different marketing agency for my ABM,
            Email Outbound and Paid Ads, now I have a single agency
            manages 90% of my qualified lead generation.
          </div>
        </div>

        <div class="solutions__item" data-index="1">
          <div class="solutions__header">
            <span>02</span>
            <h4>Track marketing performance</h4>
            <i></i>
          </div>
          <div class="solutions__body">
            "Before, I'd use 4 different marketing agency for my ABM, Email Outbound and Paid Ads , now I have a single agency manages 90% of my qualified lead generation " 
          </div>
        </div>

        <div class="solutions__item" data-index="2">
          <div class="solutions__header">
            <span>03</span>
            <h4>Track marketing performance</h4>
            <i></i>
          </div>
          <div class="solutions__body">
            "Before, I'd use 4 different marketing agency for my ABM, Email Outbound and Paid Ads , now I have a single agency manages 90% of my qualified lead generation " 
          </div>
        </div>

        <div class="solutions__item" data-index="3">
          <div class="solutions__header">
            <span>04</span>
            <h4>Track marketing performance</h4>
            <i></i>
          </div>
          <div class="solutions__body">
           "Before, I'd use 4 different marketing agency for my ABM, Email Outbound and Paid Ads , now I have a single agency manages 90% of my qualified lead generation " 
          </div>
        </div>

        <div class="solutions__item" data-index="4">
          <div class="solutions__header">
            <span>05</span>
            <h4>Track marketing performance</h4>
            <i></i>
          </div>
          <div class="solutions__body">
            "Before, I'd use 4 different marketing agency for my ABM, Email Outbound and Paid Ads , now I have a single agency manages 90% of my qualified lead generation " 
          </div>
        </div>

        <div class="solutions__item" data-index="5">
          <div class="solutions__header">
            <span>06</span>
            <h4>Track marketing performance</h4>
            <i></i>
          </div>
          <div class="solutions__body">
            "Before, I'd use 4 different marketing agency for my ABM, Email Outbound and Paid Ads , now I have a single agency manages 90% of my qualified lead generation " 
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

  <!-- 11. FEATURED INSIGHTS -->
  <section class="insights custom-maxW pt-110">
    <div class="insights-wrapper">
          <h2 class="top-heading text-center mb-24">STAY INFORMED. STAY AHEAD</h2>
          <h3 class="top-sub-heading text-center">Featured Business Insights </h3>
          <p class="common-para text-center mt-16">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
          </p>
      </div>
      <div class="insights-card-block mt-48">
          <div class="insight-card">
              <div class="insignt-img-block mb-24"><img src="https://cdn.electricoctopus.agency/electric-octopus/insight-img1.webp" alt="post image"></div>
              <div class="cat-selection">
                <span class="industry-cat">Finance</span>
              </div>
              <div class="case-study-post-date mb-16">
                    <span class="date-white">12, Friday</span>
                    <span class="date-gray">Dec 2025</span>
                </div>
                <h2 class="mb-16">How Modern PE Firms Win: The Execution Engine,Intelligence Execution at Scale</h2>
                <div class="case-study-post-para">
                  Electric Octopus's complete tactical playbook for operationalizing $2.9B PE firm's intelligence + velocity + infrastructure transformation—from signal detection to closed deal in 24 days            
                </div>
                <div class="case-study-link mt-24">
                  <span class="read-mo-button">View Case Study</span>
                  <span class="case-study-view">
                      <img src="https://cdn.electricoctopus.agency/ourwork/g-eye.png" alt="view" loading="lazy">
                      06
                  </span>
              </div>
              <div class="portfolio-tags">

                <span>Banking</span><span>FinTech</span><span>SDR Cost</span>
            </div>
          </div>
          <div class="insight-card">
              <div class="insignt-img-block mb-24"><img src="https://cdn.electricoctopus.agency/electric-octopus/insight-img2.webp" alt="post image"></div>
              <div class="cat-selection">
                <span class="industry-cat">Finance</span>
              </div>
              <div class="case-study-post-date mb-16">
                    <span class="date-white">12, Friday</span>
                    <span class="date-gray">Dec 2025</span>
                </div>
                <h2 class="mb-16">How Modern PE Firms Win: The Execution Engine,Intelligence Execution at Scale</h2>
                <div class="case-study-post-para">
                  Electric Octopus's complete tactical playbook for operationalizing $2.9B PE firm's intelligence + velocity + infrastructure transformation—from signal detection to closed deal in 24 days            
                </div>
                <div class="case-study-link mt-24">
                  <span class="read-mo-button">View Case Study</span>
                  <span class="case-study-view">
                      <img src="https://cdn.electricoctopus.agency/ourwork/g-eye.png" alt="view" loading="lazy">
                      06
                  </span>
              </div>
              <div class="portfolio-tags">

                <span>Banking</span><span>FinTech</span><span>SDR Cost</span>
            </div>
          </div>
          <div class="insight-card">
              <div class="insignt-img-block mb-24"><img src="https://cdn.electricoctopus.agency/electric-octopus/insight-img3.webp" alt="post image"></div>
              <div class="cat-selection">
                <span class="industry-cat">Finance</span>
              </div>
              <div class="case-study-post-date mb-16">
                    <span class="date-white">12, Friday</span>
                    <span class="date-gray">Dec 2025</span>
                </div>
                <h2 class="mb-16">How Modern PE Firms Win: The Execution Engine,Intelligence Execution at Scale</h2>
                <div class="case-study-post-para">
                  Electric Octopus's complete tactical playbook for operationalizing $2.9B PE firm's intelligence + velocity + infrastructure transformation—from signal detection to closed deal in 24 days            
                </div>
                <div class="case-study-link mt-24">
                  <span class="read-mo-button">View Case Study</span>
                  <span class="case-study-view">
                      <img src="https://cdn.electricoctopus.agency/ourwork/g-eye.png" alt="view" loading="lazy">
                      06
                  </span>
              </div>
              <div class="portfolio-tags">

                <span>Banking</span><span>FinTech</span><span>SDR Cost</span>
            </div>
          </div>
      </div>
  </section>
<div class="stripe"><img src="https://cdn.electricoctopus.agency/electric-octopus/p-strip3.png" alt="stripe" width="100%"></div>
  <!-- 12. CONTENT LEADERS -->
  <section class="insights custom-maxW pt-110">
    <div class="insights-wrapper">
          <h2 class="top-heading text-center mb-24">BUILDING THE FUTURE</h2>
          <h3 class="top-sub-heading text-center">Content for marketing & sales leaders</h3>
          <p class="common-para text-center mt-16">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
          </p>
      </div>
      <div class="insights-card-block mt-48">
          <div class="insight-card">
              <div class="insignt-img-block mb-24"><img src="https://cdn.electricoctopus.agency/electric-octopus/lead-img1.webp" alt="post image"></div>

              <div class="insight-post-date mb-16">
                   12 Feb, 2025
                </div>
                <h2 class="mb-16">How Modern PE Firms Win: The Execution Engine,Intelligence Execution at Scale</h2>
                <div class="case-study-post-para">
                  Electric Octopus's complete tactical playbook for operationalizing $2.9B PE firm's intelligence + velocity + infrastructure transformation—from signal detection to closed deal in 24 days            
                </div>
                <div class="case-study-link mt-24">
                  <a href="#" class="purple-button">Read More</a>
              </div>
              <div class="portfolio-tags">

                <span>Banking</span><span>FinTech</span><span>SDR Cost</span>
            </div>
          </div>
          <div class="insight-card">
              <div class="insignt-img-block mb-24"><img src="https://cdn.electricoctopus.agency/electric-octopus/lead-img2.webp" alt="post image"></div>

              <div class="insight-post-date mb-16">
                   12 Feb, 2025
                </div>
                <h2 class="mb-16">How Modern PE Firms Win: The Execution Engine,Intelligence Execution at Scale</h2>
                <div class="case-study-post-para">
                  Electric Octopus's complete tactical playbook for operationalizing $2.9B PE firm's intelligence + velocity + infrastructure transformation—from signal detection to closed deal in 24 days            
                </div>
                <div class="case-study-link mt-24">
                    <a href="#" class="purple-button">Read More</a>
                </div>
              <div class="portfolio-tags">

                <span>Banking</span><span>FinTech</span><span>SDR Cost</span>
            </div>
          </div>
          <div class="insight-card">
              <div class="insignt-img-block mb-24"><img src="https://cdn.electricoctopus.agency/electric-octopus/lead-img3.webp" alt="post image"></div>

              <div class="insight-post-date mb-16">
                   12 Feb, 2025
                </div>
                <h2 class="mb-16">How Modern PE Firms Win: The Execution Engine,Intelligence Execution at Scale</h2>
                <div class="case-study-post-para">
                  Electric Octopus's complete tactical playbook for operationalizing $2.9B PE firm's intelligence + velocity + infrastructure transformation—from signal detection to closed deal in 24 days            
                </div>
                <div class="case-study-link mt-24">
                    <a href="#" class="purple-button">Read More</a>
                </div>
              <div class="portfolio-tags">

                <span>Banking</span><span>FinTech</span><span>SDR Cost</span>
            </div>
          </div>
      </div>
  </section>

  <!-- 13. FAQ -->
<?php get_template_part('template-parts/talk-to-expert/book-a-call/faq'); ?>


</main>
<script>
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('click', () => {
    document.querySelectorAll('.card').forEach(c => {
      if (c !== card) c.classList.remove('is-active');
    });
    card.classList.toggle('is-active');
  });
});
</script>
<!-- solution -->
<script>
document.addEventListener('DOMContentLoaded', () => {

  const items = document.querySelectorAll('.solutions__item');
  const images = document.querySelectorAll('.solutions__image');

  items.forEach(item => {
    item.addEventListener('click', () => {

      const index = item.dataset.index;

      /* ACCORDION */
      items.forEach(i => i.classList.remove('active'));
      item.classList.add('active');

      /* IMAGE SWITCH (SAFE) */
      images.forEach(img => img.classList.remove('active'));

      const targetImage = document.querySelector(
        `.solutions__image[data-index="${index}"]`
      );

      if (targetImage) {
        targetImage.classList.add('active');
      } else {
        /* fallback: keep last image active */
        images[images.length - 1].classList.add('active');
      }

    });
  });

});
</script>




<?php get_footer(); ?>
