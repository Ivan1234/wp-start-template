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
					<?php if (function_exists('get_field')) { ?>
						<div class="container">
							<div class="home-intro">
								<div class="row">
									<div class="col-md-6">
										<?php
										global $last_post;
										$last_post = get_field( "latest_news" );
										echo get_intro_post($last_post); ?>
									</div>
									<div class="col-md-6">
										<?php
										global $popular_news;
										$popular_news = get_field( "popular_news" );
										echo get_intro_post($popular_news); ?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
					<?php get_template_part('template-parts/latest-posts'); ?>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
