<?php 
/**
*
* Helper Functions
*
* @package _sf
* since 1.1.0
*/

/**
* Turn Categor ID into whatever
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
