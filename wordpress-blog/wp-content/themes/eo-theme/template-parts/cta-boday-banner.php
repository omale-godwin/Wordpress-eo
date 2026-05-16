<?php
                // Get the selected banner
                $selected_banner = get_field('select_body_banner') ?: 'banner1';

                // Map each banner key to its field name and template part
                $banner_map = [
                    'banner1' => [
                        'field' => 'banner_1_fields',
                        'template' => 'template-parts/content-article-body-banner1',
                    ],
                    'banner2' => [
                        'field' => 'banner_2_fields',
                        'template' => 'template-parts/content-article-body-banner2',
                    ],
                    'banner3' => [
                        'field' => 'banner_3_fields',
                        'template' => 'template-parts/content-article-body-banner-cta',
                    ],
                    'banner4' => [
                        'field' => 'banner_4_fields',
                        'template' => 'template-parts/content-article-body-banner-cta2',
                    ],
                    'banner5' => [
                        'field' => 'banner_5_fields',
                        'template' => 'template-parts/content-article-body-banner-cta3',
                    ],
                ];

                // If valid banner is selected, load its fields and template
                if (isset($banner_map[$selected_banner])) {
                    $field_name = $banner_map[$selected_banner]['field'];
                    $template_path = $banner_map[$selected_banner]['template'];

                    $banner_fields = get_field($field_name);
                    set_query_var($field_name, $banner_fields);

                    get_template_part($template_path);
                }
                ?>