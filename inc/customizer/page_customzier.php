<?php
/**
 * _sf Theme Customizer: Page Layout Controls
 *
 * @package _sf
 * since 1.0.5.1
 */
 
/**
* Home Page Slider
*/
if (! function_exists('_sf_page_customize_register') ) :
function _sf_page_customize_register( $wp_customize ) {
//Slider section
    $wp_customize->add_section('_sf_home_slider', array(
        'title'    => __('Home Page Slider', '_s_f'),
        'priority' => 120,
    ));
   
 
  	//  ============================
    //  = Show Slider on Home Page? =
    //  =============================
	$wp_customize->add_setting(
    '_sf_slider_visibility'
    );

    $wp_customize->add_control(
    '_sf_slider_visibility',
    array(
        'type' => 'checkbox',
        'label' => 'Hide Home Page Slider?',
        'section' => '_sf_home_slider',
        )
    );
 
    //  ============================
    //  = Number of Slides To Show =
    //  ============================
 
    $wp_customize->add_setting(
    '_sf_slide_numb'
    );

    $wp_customize->add_control(
    '_sf_slide_numb',
    array(
        'type' => 'text',
		'default' => 5,
        'label' => 'Number Of Slides To Show - Default is 5. Enter numbers only.',
        'section' => '_sf_home_slider',
        )
    );
   
 
    //  =====================
    //  = Category Dropdown =
    //  =====================
    $categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}
 
	$wp_customize->add_setting('_sf_slide_cat', array(
		'default'        => $default
	));
	$wp_customize->add_control( 'cat_select_box', array(
		'settings' => '_sf_slide_cat',
		'label'   => 'Select Category:',
		'section'  => '_sf_home_slider',
		'type'    => 'select',
		'choices' => $cats,
	));
add_action('customize_register', '_sf_page_customize_register');
endif; //! _sf_page_customize_register exists