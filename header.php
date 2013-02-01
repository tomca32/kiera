<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]--> 
<head>
	<?php global $options; foreach ($options as $value) {
    	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
	}?>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	
	<!-- Meta -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		
	<?php wp_head(); ?>
	
	<script>
		firstVisit = true;
		HOME = "<?php echo home_url(); ?>";
		MENU = "<?php echo $kt_menu_position; ?>";
		TITLE = "<?php echo $kt_title_position; ?>";
		CONTENT = "<?php echo $kt_content_position; ?>";
	</script>
</head>
<body <?php body_class(); ?>>
	<div id="cover"></div> <!--This is the white cover that fades out-->
	<!-- Header -->
	<header>
		<div id="title">
			<h1><?php bloginfo('name'); ?></h1>
			<hr>
			<?php if($kt_description) { ?><h2><?php bloginfo('description'); ?></h2><?php } ?>
		</div>
			<!-- Nav -->
			
						<?php navigation_menu(); ?>

			<!-- /Nav -->
		
	
	</header>
	<!-- /Header -->
	<div class="container" id="container"> <!-- container for AJAX -->
		<span id="close_button"><a href="<?php bloginfo('url'); ?>/">X</a></span>
		<div id="main_content">
