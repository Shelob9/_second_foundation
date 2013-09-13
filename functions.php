<?php
/**
 * Includes the various parts of the library.
 * Note: Library is a git submodule.
 * Source = https://github.com/Shelob9/_sf_lib
 *
 * @package _sf
 */

// Will load file from child theme if it exists, if not from parent theme.
// Disallow in child theme or with plugin
// https://github.com/Shelob9/the-great-deactivator). More plugins for modifying theme to come.
// https://github.com/Shelob9/_sf_lib). Is included as submodule in theme itself.
$files_to_include = array(
    '/lib/theme-setup.php',
    '/lib/scripts-styles.php',
    '/lib/header-menu.php',
    '/lib/open-close.php',
    '/lib/image-stuff.php',
    '/lib/customizer/customizer.php',
    '/lib/customizer/customizer_sanitizer.php',
    '/lib/css/style.php',
    '/lib/extras.php',
    '/lib/template-tags.php',
    '/lib/tha/tha-theme-hooks.php',   
);
$files_to_include = apply_filters(
    '_sf_files_to_include',
    $files_to_include
);

if ( ! empty ( $files_to_include ) )
{
    foreach ( $files_to_include as $file )
        locate_template( $file, true );
}


/**
* Optional Stuff That Theme Doesn't Use By Default
*/

//Galleria
//_sf_locate_template('/lib/galleria.php', true);
//Slideout Sidebar
//_sf_locate_template('/lib/slideSidebar', true);






