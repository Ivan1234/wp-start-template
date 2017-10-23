<?php get_header();
	global $post;
?>
	<div id="inner-wrap">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h1 class="home_title">
						<?php the_title(); ?>	
					</h1>
				</div>
				<div class="home-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
