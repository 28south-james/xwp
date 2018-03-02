
	<div id="base">
		<span class="bolt back"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="616px" height="988.5px" viewBox="0 0 616 988.5"	 style="overflow:scroll;enable-background:new 0 0 616 988.5;" xml:space="preserve"><defs></defs><polygon class="st0" points="367.9,343.7 563.8,0 250.7,0 0,570.9 207.4,559.5 51.4,988.5 110,988.5 616,323.9 "/></svg></span>
		<span class="bolt"><svg version="1.1"	 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="616px" height="988.5px" viewBox="0 0 616 988.5" style="overflow:scroll;enable-background:new 0 0 616 988.5;" xml:space="preserve"><defs></defs><polygon class="st0" points="367.9,315.2 546.6,0 238.8,0 0,542.4 207.4,531 41.1,988.5 88.3,988.5 616,295.4 "/></svg></span>
		<div class="wrapper">
			<div class="text">
				<?php wp_nav_menu([
					'menu' => 'Footer',
					'container' => false
				]); ?>
				<div class="logos">
					<div class="social"><h6>Connect with us</h6><?php socialMedia(); ?></div>
					<div class="footerLogo"><?php the_field('rvspark_logo','option');?></div>
					<div class="twenty8"><a href="http://28southcreative.com" title="designed and built by 28South"><?php the_field('28south_logo','option');?></a></div>
				</div>
				<?php 
					$disclaim = get_field('copyrightdisclaimer','option');
					$output = apply_filters( 'the_content', $disclaim );
				    $output = str_replace( ']]>', ']]&gt;', $output );
				    echo $output;
				?>
			</div>
		</div>
	</div>

</div> <!-- #core -->
<?php wp_enqueue_script('rvspark-js', get_template_directory_uri() .'/assets/scripts.js?v=2.2', array('jquery'), null, true); ?>
<?php wp_footer(); ?>
</body>
</html>