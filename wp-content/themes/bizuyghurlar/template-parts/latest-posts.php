<div class="container">
	<section class="home-latest-news">
		<div class="row">
			<div class="col-md-9 home-latest-news__inner">
				<div class="row">
					<div class="col-12">
						<h3>
							<?php _e('Последние записи', 'bizuyghurlar'); ?>
						</h3>
					</div>
					<div class="col-12 home-latest-news__posts">
						<div class="row">
							<?php
								global $last_post, $popular_news;


								$count = wp_count_posts( 'post' );
								$numberposts = 6;

								$args = array(
									'numberposts' => $numberposts,
									'orderby'     => 'date',
									'order'       => 'DESC',
									'post_type'   => 'post',
									'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
								);

								if (isset($last_post) && $last_post) {
									$args['exclude'][] = $last_post->ID;
									$count->publish--;
								}

								if (isset($popular_news) && $popular_news) {
									$args['exclude'][] = $popular_news->ID;
									$count->publish--;
								}

								$posts = get_posts( $args );

								foreach($posts as $post){ setup_postdata($post); ?>
								    <div class="col-md-4 home-latest-news__item">
							    		<?php $thumbnail = get_the_post_thumbnail_url( $post->ID, 'large' ); 
										if ($thumbnail) {
											$post_cat_arr = get_the_category( $post->ID );
											if (isset($post_cat_arr[0])) {
												$t_id = $post_cat_arr[0]->term_id;
												$term_meta = get_option( "taxonomy_$t_id" );
												$cat_color = $term_meta['custom_color'];
											}
										 ?>
											<div class="home-latest-news__image_container">
												<?php if (isset($post_cat_arr[0])) { ?>
													<a <?php echo (isset($cat_color) ? 'style="background-color: '.$cat_color.'"' : ''); ?> href="<?php echo get_term_link($post_cat_arr[0]) ?>" class="home-latest-news__label">
														<?php echo $post_cat_arr[0]->name; ?>
													</a>
												<?php } ?>
												<link rel="prefetch" href="<?php echo $thumbnail; ?>">
												<a class="home-latest-news__image" href="<?php echo get_permalink($post); ?>" style="background-image: url('<?php echo $thumbnail; ?>');">
													
												</a>
											</div>
										<?php } ?>
										<div class="home-latest-news__content_container">
											<div class="home-latest-news__title">
												<a href="<?php echo get_permalink($post); ?>">
													<?php echo $post->post_title; ?>
												</a>
											</div>
											<div class="home-latest-news__excerpt">
												<?php 
												if ($post->post_excerpt) {
													echo $post->post_excerpt;
												} else {
													echo wp_trim_words( $post->post_content, 18, ' ...' );	
												} ?>
											</div>
											<div class="home-latest-news__read_more">
												<a href="<?php echo get_permalink($post); ?>">
													<?php _e('Читать далее', 'bizuyghurlar'); ?>
												</a>
											</div>
										</div>
								    </div>
								<?php }

								wp_reset_postdata(); // сброс

								?>
						</div>
						<?php if ($count->publish > $numberposts) { ?>
							<div class="get_more_post">
								<i></i>
								<span>
									<?php _e('Смотреть еще', 'bizuyghurlar'); ?>
								</span>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
	</section>
</div>