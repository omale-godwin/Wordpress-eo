<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Preload only necessary font weights -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/rajdhani/rajdhani-v16-latin-500.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/rajdhani/rajdhani-v16-latin-600.woff2" as="font" type="font/woff2" crossorigin="anonymous">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div id="header" class="header-box">
        <?php get_template_part( 'template-parts/dynamic-banner' ); ?>
        <!-- Header content with logo and menu -->
        <div class="header-content custom-maxW">
            <a href="https://electricoctopus.agency/" class="logo-link">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/electric-octopus-logo.webp" alt="Electric Octopus Logo" width="136" height="53">
                <span class="beta-badge">BETA</span>
            </a>
            
            <!-- Simplified header button menu -->
            <div class="header-menubttn">
                <?php wp_nav_menu(array(
                    'theme_location' => 'header-buttons',
                    'menu_class' => 'header-button-menu',
                    'container' => false,
                    'depth' => 1,
                    'fallback_cb' => false
                )); ?>
            </div>
        </div>

        <!-- Main Navigation -->
        <div class="header-main-nav">
            <div class="custom-maxW">
                <?php wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'menu_class' => 'header-menu',
                    'container' => 'nav',
                    'container_class' => 'header-nav',
                    'depth' => 2,
                    'walker' => new Custom_Walker_Nav_Menu(),
                    'fallback_cb' => false
                )); ?>

                <!-- Mobile menu, simplified -->
                <div class="mobile-menu">
                    <div onclick="togglediv('menubar','menu-toggle');" id="menu-toggle" class="menu-toggle-bttn">
                        <span class="toggle-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="6" x2="21" y2="6" stroke="#fff"></line>
                                <line x1="3" y1="12" x2="21" y2="12" stroke="#fff"></line>
                                <line x1="3" y1="18" x2="14" y2="18" stroke="#fff"></line>
                            </svg>
                        </span>
                    </div>

                    <!-- Mobile menu items -->
                    <div class="menu-items" id="menubar">
                        <span class="close-btn" onclick="togglediv('menubar','menu-toggle');">
                            <svg width="28px" height="28px" viewBox="0 0 1024 1024" class="icon" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#fff" d="M764.288 214.592L512 466.88 259.712 214.592a31.936 31.936 0 00-45.12 45.12L466.752 512 214.528 764.224a31.936 31.936 0 1045.12 45.184L512 557.184l252.288 252.288a31.936 31.936 0 0045.12-45.12L557.12 512.064l252.288-252.352a31.936 31.936 0 10-45.12-45.184z"/>
                            </svg>
                        </span>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'menu_class' => 'header-menu',
                            'container' => 'nav',
                            'container_class' => 'header-nav',
                            'depth' => 2,
                            'walker' => new Custom_Walker_Nav_Menu(),
                            'fallback_cb' => false
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
