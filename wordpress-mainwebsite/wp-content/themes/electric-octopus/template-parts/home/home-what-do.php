<section id="what-we-do">
    <div class="custom-maxW pt-110">
        <div class="what-common-wrapper text-center">
            <h2 class="top-heading mb-16"> What we do</h2>
            <h3 class="top-sub-heading mb-16">Our Solutions Blueprints </h3>
            <p class="common-para">Tomorrow's business success requires both specialization and integrated thinking. Our forward-looking approach anticipates market changes, identifies emerging opportunities, and implements innovative solutions designed to create lasting value. We don't just solve today's problems—we position your business for future growth.</p>
            
        </div>
        <?php
            $services = [
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/campaign.png',
                    'title' => 'Allbound Intent Based Marketing Solutions   ',
                    'desc'  => 'We architect multi-channel engagement systems that identify high-intent buyers and compress sales cycles by 34% on average. Our intent orchestration connects first-party data, buyer behavior signals, and predictive analytics to deliver conversations when decision-makers are actively evaluating solutions.'
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-2.png',
                    'title' => 'Social Media & Digital PR Solutions',
                    'desc'  => 'Our social selling frameworks and thought leadership strategies have generated 3.2x more engaged prospects for B2B tech companies. We create data-backed content calendars and executive positioning campaigns that establish category expertise.'
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-3.png',
                    'title' => 'Web / Mobile Apps Design & Development',
                    'desc'  => 'We build high-performance web and mobile applications designed for measurable business outcomes—not just aesthetics. Our development approach integrates CRO, SEO, user behavior analytics, and technical performance optimization.'
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-04.png',
                    'title' => 'Server-side Tagging For Web & Mobile Apps',
                    'desc'  => 'Our server-side tracking implementations bypass browser restrictions, improve data accuracy by 30%, and give you complete control over customer intelligence while reducing page load time.'
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-05.png',
                    'title' => 'AI call & CRM Implementation Solutions',
                    'desc'  => 'Our AI-powered conversation systems and CRM orchestration help sales teams qualify 156% more prospects while reducing manual data entry by 89%. We implement intelligent routing, automated lead scoring, and call analysis that transform your CRM into a revenue acceleration engine.'
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-06.png',
                    'title' => 'WordPress & WooCommerce Solutions    ',
                    'desc'  => 'We build high-conversion WooCommerce platforms and content marketing systems optimized for B2B lead generation. Our implementations integrate marketing automation, advanced analytics, and headless CMS capabilities—delivering 58% faster page speeds and 3.4x higher organic traffic growth.'
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-07.png',
                    'title' => 'SEO Outreach & Link-Building Solutions',
                    'desc'  => "Our strategic link acquisition methodology has increased client's organic traffic by 214% within 12 months through high-authority placements. We combine data-driven prospect research, personalized outreach at scale, and content partnerships that generate both referral traffic and sustained rankings improvements."
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-08.png',
                    'title' => 'Custom Sales Funnel Solutions     ',
                    'desc'  => "We design conversion-optimized funnel architectures that have generated $47M+ in attributed pipeline for B2B technology companies. Our approach integrates behavioral triggers, progressive profiling, and multi-step nurture sequences—creating systematic growth engines that scale qualified opportunity flow by 3-5x."
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-09.png',
                    'title' => 'RevOps & Go-To-Market Engineering Solutions   ',
                    'desc'  => "We architect RevOps infrastructures that unify marketing, sales, and customer success around shared metrics and automated workflows. Our clients see 47% reduction in CAC and 78% higher qualified pipeline through elimination of silos and process automation across every buyer touchpoint."
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-010.png',
                    'title' => 'Data Analytics & Reporting Solutions  ',
                    'desc'  => "We build custom analytics frameworks and executive dashboards that surface the metrics that actually drive your business forward. Our reporting systems integrate multi-source data streams, predictive modeling, and automated insight generation—turning raw data into real-time revenue intelligence."
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-011.png',
                    'title' => 'Programmatic Ads & Pay-Per-Click (PPC)   ',
                    'desc'  => "Our programmatic strategies and PPC management have delivered 4.7x return on ad spend for B2B brands through systematic testing and creative optimization. We combine first-party data targeting, dynamic creative personalization, and cross-channel attribution to eliminate wasted spend and scale profitable acquisition."
                ],
                [
                    'icon' => 'https://cdn.electricoctopus.agency/electric-octopus/w-do-012.png',
                    'title' => 'Marketing Automation System Engineering ',
                    'desc'  => "We engineer marketing automation architectures that orchestrate complex buyer journeys across email, web, social, and sales touchpoints. Our implementations deliver 312% increase in MQLs and 43% improvement in lead-to-opportunity conversion through intelligent segmentation and behavioral triggering."
                ],
                // Add all remaining items same way...
            ];
        ?>

            <div class="services-grid mt-48">
                <?php foreach ($services as $service) : ?>
                    <div class="service-card">
                        <div class="service-icon">
                            <img src="<?php echo esc_url($service['icon']); ?>" alt="icon">
                        </div>
                        <div class="service-right">
                            <h3 class="service-title">
                                <?php echo esc_html($service['title']); ?>
                            </h3>

                            <p class="service-desc">
                                <?php echo esc_html($service['desc']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

    </div>
</section>