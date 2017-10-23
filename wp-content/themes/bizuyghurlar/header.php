<?php
/**
 * The header for theme
 *
 * This is the template that displays all of the <head>
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?> <?php wp_title("", true); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">
	<div id="header">
		<div class="container-fluid header">
			<div class="row">
				<div id="menu" class="col-xl-2 col-3">
					<div class="menu-btn">
						<i class="fa fa-bars"></i><span><?php _e('Меню', 'bizuyghurlar'); ?></span>
					</div>
					<div class="menu-content">
						
					</div>
				</div>
				<div class="logo-wrap col-xl-8 col-6">
					<div class="logo-inner">
						<?php the_custom_logo(); ?>
					</div>
				</div>

				<div class="search-wrap col-xl-2 col-3">
					<div class="search-btn">
						<span><?php _e('Поиск', 'bizuyghurlar'); ?></span><i class="fa fa-search"></i>
					</div>
				</div>
			</div>
		</div>
		<?php get_template_part('template-parts/header-image'); ?>
	</div>