<div class="header-image-wrap">
	<?php
		global $post;
		if (is_front_page()) {
			$image_url = get_the_post_thumbnail_url($post, 'full');
		}
	?>
	<div class="hiw-overlay"></div>
	<div class="hiw_inner" style="background-image: url('<?php echo $image_url; ?>');">
		
	</div>
</div>