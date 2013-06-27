<?php 
/**
*
* Helper Functions
*
* @package _sf
* since 1.1.0

                  .      .                         .        
                                                            
                                    N$$8.                   
                      .            I?????                   
      .                            7?????                   
                                   $??7??           .       
                                   Z?????                   
                                   O?????                   
                                   D?????                   
                                   $?????                   
                                   +?I???                   
                                   ?????O                   
                                   ?????I                   
                                 .   7I~                    
                                      +~.                   
    .                                 8~?...                
                                  .8?7?~$????????~..        
         .                     8????ZMN??????????ZN=7.      
                       .      ???????I?8?????????Z~=~.      
                             ~????????????8777??~8~~?:      
                             $??????????????????~Z~~~.      
                             ~???????????????????$~+N       
                             $D??????????????????8N~N       
                             .?.???ZZZ?????????????+??      
                             .?. ???????????????Z. .??.     
                             .?. $????????????I     +??     
       .                     .?= :????????????,      ??.    
                              ?+ .????????????       :??    
                              ??  ????????????        ??    
                              ?I  ?????????7.         .??   
                             .?.   ...?~~~~~           8=   
                             O?.      DNM~~~           ??.  
                             ??       .~$~~            ??   
                             ??       ~$~??.          :?I   
                             ??       ~8~~~           ??    
                             ~      ..~=O=~8:.        ?I    
                             ~     ???????????    .   ~.    
                   .         :    .???????????.       :   
*/

/**
* Turn Category ID into whatever
* 
* @ since terminus 0.1
* @param int $CatID - The Category's ID
* @param string $form. What form you want output to be in. Possible options:
	term_id
	name
    slug
    term_group
    term_taxonomy_id
    taxonomy
    description 
    parent
    count
    cat_ID
    category_count
    category_description
    cat_name
    category_nicename
    category_parent
    desc
* @return string Category ID translated into whatever form.
*/
function _sf_translate_CatID($catID, $form) {
	if ( ! is_array($catID) ) {
		$cat = get_category($catID);
		$output = $cat->$form;
		return $output;
	}
	else {
		foreach ($catID as $catID) {
			$cat = get_category($catID);
			$output = $cat->$form;
			return array($output);
		}
	}
}

/**
* Filters for the_excerpt 
*/

//add class of excerpt to excerpt
if (! function_exists('_sf_add_class_to_excerpt' ) ) :
function _sf_add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="excerpt"', $excerpt);
}
add_filter( "the_excerpt", "_sf_add_class_to_excerpt" );
endif; //! ! _sf_add_class_to_excerpt exists

if (! function_exists('_sf_new_excerpt_more' ) ) :
function _sf_new_excerpt_more( $more ) {
	if (function_exists('_sf_scripts_masonry')) {
		return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More</a>';
	}
}
add_filter( 'excerpt_more', '_sf_new_excerpt_more' );
endif; //! _sf_new_excerpt_more exists

if (! function_exists('_sf_custom_excerpt_length') ) :
function _sf_custom_excerpt_length( $length ) {
	//get the value of the masonry excerpt length option, or set it to 10 if !isset
	$masonry_excerpt_length = get_theme_mod('masonry_excerpt_length', 10);
	//if masonry functions exists, since we're using it set using $masonry_excerpt_length, else leave at 55.
	if (function_exists('_sf_scripts_masonry')) {
		return $masonry_excerpt_length;
	}
	else {
		return 55;
	}
}
add_filter( 'excerpt_length', '_sf_custom_excerpt_length', 999 );
endif; // ! _sf_custom_excerpt_length exists

/**
* Masonry Brick Width As A Percentage
* Use to set value with width selector.
*/

if (! function_exists('_sf_masonry_width') ) :
function _sf_masonry_width() {
	//get the theme_mod that tells us how many wide we want to go. If it isn't set return 4 so we don't get an error. 4 is a nice looking number.
	$howmany = get_theme_mod('masonry_how_many', 4);
	//divide that by 100 to get the percent width
	$percent = 100/$howmany;
	//echo it with a % sign.
	echo $percent.'%;';
}
endif; //_sf_masonry_width exsits

