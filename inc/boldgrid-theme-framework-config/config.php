<?php
function boldgrid_theme_framework_config( $boldgrid_framework_configs ) {
	/**
	 * General Configs
	 */
	$boldgrid_framework_configs['boldgrid-parent-theme'] = true;
	$boldgrid_framework_configs['parent-theme-name'] = 'bg-prime';
	$boldgrid_framework_configs['theme_name'] = 'bg-prime-child';
	$boldgrid_framework_configs['scripts']['boldgrid-sticky-footer'] = false;
	$boldgrid_framework_configs['temp']['attribution_links'] = false;
	$boldgrid_framework_configs['customizer-options']['typography']['enabled'] = true;
	$boldgrid_framework_configs['template']['footer'] = 'generic';
	$boldgrid_framework_configs['template']['navbar-search-form'] = false;
	$boldgrid_framework_configs['template']['header'] = 'generic';
	$boldgrid_framework_configs['customizer-options']['background']['defaults']['background_image'] = false;
	$boldgrid_framework_configs['bootstrap-compile'] = true;

	// Remove Container ID that is targetted by navbar-toggle.
	$boldgrid_framework_configs['menu']['prototype']['primary']['container_id'] = 'primary-menu';

	// Remove the container classes that are targetted with navbar-collapse.
	$boldgrid_framework_configs['menu']['prototype']['primary']['container_class'] = 'primary-menu';
	
		$boldgrid_framework_configs['template']['locations']['header'] = array(
			'1' => array( '[menu]secondary' ),
			'6' => array( '[action]boldgrid_site_identity', '[menu]social' ),
			'8' => array( '[widget]boldgrid-widget-2' ),
			'11' => array( '[action]boldgrid_primary_navigation' ),
			'13' => array( '[menu]tertiary' ),
		);
		// Assign Locations for Generic Footer.
		$boldgrid_framework_configs['template']['locations']['footer'] = array(
			'1' => array( '[menu]footer_center' ),
			'5' => array( '[widget]boldgrid-widget-3' ),
			'8' => array( '[action]boldgrid_display_attribution_links' ),
		);

	/**
	 * Customizer Configs
	 */
	$boldgrid_framework_configs['customizer-options']['colors']['enabled'] = true;
	$boldgrid_framework_configs['customizer-options']['colors']['defaults'] = array (
		array (
			'default' => true,
			'format' => 'palette-primary',
			'neutral-color' => '#ffffff',
			'colors' => array(
				'#000000',
				'#000000',
				'#ffffff',
			)
		),
		array (
			'format' => 'palette-primary',
			'neutral-color' => '#000000',
			'colors' => array(
				'#ffffff',
				'#000000',
				'#ffffff',
			)
		),
		array (
			'format' => 'palette-primary',
			'neutral-color' => '#ffffff',
			'colors' => array(
				'#169dc5',
				'#000000',
				'#facc2d',
			)
		),
		array (
			'format' => 'palette-primary',
			'neutral-color' => '#ffffff',
			'colors' => array(
				'#72754d',
				'#000000',
				'#40422c',
			)
		),
		array (
			'format' => 'palette-primary',
			'neutral-color' => '#c3ae69',
			'colors' => array(
				'#6c473f',
				'#6c473f',
				'#c3ae69',
			),
		)
	);

	// Get Subcategory ID from the Database
	$boldgrid_install_options = get_option( 'boldgrid_install_options', array() );
	$subcategory_id = null;
	if ( !empty( $boldgrid_install_options['subcategory_id'] ) ) {
		$subcategory_id = $boldgrid_install_options['subcategory_id'];
	}

	// Override Options per Subcategory
	switch ( $subcategory_id ) {
		case 14: //<-- Fashion
			$boldgrid_framework_configs['customizer-options']['colors']['defaults'][1]['default'] = true;
			break;
		case 32: //<-- General
			$boldgrid_framework_configs['customizer-options']['colors']['defaults'][3]['default'] = true;
			break;

		// Default Behavior
		default:
			$boldgrid_framework_configs['customizer-options']['colors']['defaults'][0]['default'] = true;
			break;
	}



	// Social Media Icons.
	$boldgrid_framework_configs['social-icons']['type'] = 'icon-circle-open-thin';
	$boldgrid_framework_configs['social-icons']['size'] = 'normal';

	// Text Contrast Colors.
	$boldgrid_framework_configs['customizer-options']['colors']['light_text'] = '#ffffff';
	$boldgrid_framework_configs['customizer-options']['colors']['dark_text'] = '#000000';

	// Menu Locations.
	$boldgrid_framework_configs['menu']['locations']['secondary'] = "Above Header Center";
	$boldgrid_framework_configs['menu']['locations']['tertiary'] = "Top Right, Above Header";
	$boldgrid_framework_configs['menu']['locations']['social'] = "Header, Under Logo";
	$boldgrid_framework_configs['menu']['footer_menus'][] = 'social';


	$boldgrid_framework_configs['widget']['sidebars']['boldgrid-widget-2']['name'] = 'Below Primary Navigation';
	$boldgrid_framework_configs['widget']['sidebars']['boldgrid-widget-3']['name'] = 'Footer Center';
	
		$boldgrid_framework_configs['components']['bootstrap']['variables'] = array(
		// Here we will just reset our navbar to transparent.
		// This saves us from having to overwrite a million properties.  This could
		// possibly be a good starting place for the initial template to keep things
		// basic.  One downside to compiling bootstrap using the boldgrid palette
		// colors is that compiling the entire bootstrap library in the customizer
		// during the live preview is way too resource intensive, so the live previews
		// wouldn't reflect the actual color changes.  This can be examined again
		// if this feature become a part of the normal workflow.
		'navbar-default-bg' => 'transparent',
		// Now let's change the default link color to one in our
		// color palette.
		'navbar-default-link-color' => '$palette-primary_2',
		// We'll set apart the active link color to another color in the palette.
		'navbar-default-link-active-color' => '$palette-primary_1',
		// Let's give some hover color to the links too.  We will set the hover color
		// to the 1st color, like the active link is.
		'navbar-default-link-hover-color' => '$palette-primary_1',
		// Now we will redefine some of the navbar toggle's definitions to make
		// the toggle fit our theme a little better.
		// This will remove the border:
		'navbar-default-toggle-border-color' => 'transparent',
		// This will remove the hover background:
		'navbar-default-toggle-hover-bg' => 'transparent',
		// This will give the hamburger a color from our palette.
		'navbar-default-toggle-icon-bar-bg' => '$palette-primary_2',
	);

	// Configs above will override framework defaults
	return $boldgrid_framework_configs;
}
add_filter( 'boldgrid_theme_framework_config', 'boldgrid_theme_framework_config' );


function starter_back_to_top( $configs ) {
	// We will assign this hook to location 13, it is using jQuery goup for the smooth scroll
	$configs['scripts']['options']['goup']['enabled'] = true;
	return $configs;
}
// Then just like the other configs, we will modify the array with our new values
// when the filter is called.
add_filter( 'boldgrid_theme_framework_config', 'starter_back_to_top' );

/**
 * Site Title & Logo Controls
 */
function filter_logo_controls( $controls ) {
	$controls['logo_font_family']['default'] = 'Open Sans';

	// Controls above will override framework defaults
	return $controls;
}
add_filter( 'kirki/fields', 'filter_logo_controls' );
