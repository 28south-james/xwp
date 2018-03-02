<?php

get_header();

if (have_posts()) : while (have_posts()) : the_post();

?>

<div id="content" class="z5">

	<div id="postImg"><?php the_post_thumbnail('large'); ?></div>
	
	<h1 id="postTitle"><span class="wrapper"><?php the_title(); ?></span></h1>

	<div class="wrapper">

		<?php the_content();?>

	</div>

</div>

<?php cta_section(); ?>

<?php

endwhile; endif;

get_footer();

?>