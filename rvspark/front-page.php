<?php

	get_header(); 

	$zIndex = 10;

	if (have_posts()) : while (have_posts()) : the_post();

?>

	<div id="hero" class="z<?php echo $zIndex; ?>">
		<span class="bolt back"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="616px" height="988.5px" viewBox="0 0 616 988.5"	 style="overflow:scroll;enable-background:new 0 0 616 988.5;" xml:space="preserve"><defs></defs><polygon class="st0" points="367.9,343.7 563.8,0 250.7,0 0,570.9 207.4,559.5 51.4,988.5 110,988.5 616,323.9 "/></svg></span>
		<span class="bolt"><svg version="1.1"	 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="616px" height="988.5px" viewBox="0 0 616 988.5" style="overflow:scroll;enable-background:new 0 0 616 988.5;" xml:space="preserve"><defs></defs><polygon class="st0" points="367.9,315.2 546.6,0 238.8,0 0,542.4 207.4,531 41.1,988.5 88.3,988.5 616,295.4 "/></svg></span>
		<div class="wrapper">
			<div class="text">
				<span id="heroLogo"><?php the_field('hero_logo'); ?></span>
				<h1><?php the_field('hero_big_text'); ?></h1>
				<p><?php the_field('hero_paragraph'); ?></p>
				<a href="#features" class="btn">See features</a><a href="http://sites.rvspark.com/demo" target="_blank" class="btn trans">View demo</a>
			</div>
		</div>
		
	</div>
<a name="features"></a>
<?php

	$oddOrEven = 'odd white';
	$greenOrange = ' orange';
	$count = 1;

		if (have_rows('features')) : while (have_rows('features')) : the_row(); $count++;

			$zIndex = $zIndex - 1;
			$title = get_sub_field('title');
			$subTitle = get_sub_field('subtitle');
			$paragraph = get_sub_field('paragraph');
			$icon = get_sub_field('icon');
			$iconClass = false;
			$bgColor = false;

			if (!$icon) {
				$iconClass = ' noIcon';
			}

			if ($count % 2 == 1) {
				$oddOrEven = 'even';
				$bgColor = $greenOrange;
				if ($greenOrange == ' green') {
					$greenOrange = ' orange';
				} else {
					$greenOrange = ' green';
				}
			} else {
				$oddOrEven = 'odd white';
			}

			echo '<section class="feature ' .$oddOrEven .$bgColor .$iconClass .' z' .$zIndex .'">';
				echo '<div class="wrapper">';
					if ($icon) { echo '<span class="icon">' .$icon .'</span>'; }
					echo '<div class="text">';
						if ($title) { echo '<h2>' .$title .'</h2>'; }
						if ($subTitle) { echo '<h4>' .$subTitle .'</h4>'; }
						if ($paragraph) { echo '<p>' .$paragraph .'</p>'; }
					echo '</div>';
				echo '</div>';
			echo '</section>';

		endwhile; endif;

		if ($oddOrEven == 'odd') {
			$oddOrEven == 'even';
		} else {
			$oddOrEven == 'odd';
		}

		$zIndex = $zIndex - 1;
		echo '<a name="pricing"></a>';
		echo '<section id="pricing" class="feature noIcon ' .$oddOrEven .' z' .$zIndex .'">';
			// echo '<div class="wrapper">';
				echo '<h2>Pricing</h2>';

				if (get_field('one_price_only') == '1') {

					$pre = 'one_price_';
					$setup = get_field($pre .'setup_fee');
					$price = get_field($pre .'monthly');
					$special = get_field($pre .'special');
					if ($special) { $price = $special; }
					$buttonText = get_field($pre .'button_text');
					$buttonLink = get_field($pre .'button_link');

					echo '<div class="wrapper">';
						echo '<div id="prices" class="text">';
							if ($setup) { echo '<p class="setup">$' .$setup .' one-time setup</p>'; }
							echo '<p class="priceInfo">';
							echo '<span class="dolla">$</span><span class="price">' .$price .'</span> <span class="perMonth">per month</span> ';
							echo '<span class="priceSub">' .$priceText .'</span>';
							echo '</p>';
							echo '<a href="' .$url .'" class="btn">Sign up</a>';
						echo '</div>'; // #prices.text
					echo '</div>'; // .wrapper

				} else {

					echo '<div class="options">';
					$priceCount = 0;
						echo '<ul id="prices">';
						while(have_rows('pricing_options')) : the_row();

							$priceCount++;
							$title = get_sub_field('title');
							$subtitle = get_sub_field('subtitle');
							$setup = get_sub_field('setup_fee');
							$price = get_sub_field('price');
							$priceText = get_sub_field('price_subtext');
							$features = get_sub_field('features');
							$featureList = explode(',',$features);
							$url = get_sub_field('url');

							echo '<li>';
								echo '<div class="box">';
								echo '<h5>' .$title .'</h5>';
								echo '<p class="subtitle">' .$subtitle .'</p>';
								if ($setup) { echo '<p class="setup">$' .$setup .' one-time setup</p>'; }
								echo '<p class="priceInfo">';
								echo '<span class="dolla">$</span><span class="price">' .$price .'</span> <span class="perMonth">per month</span> ';
								echo '<span class="priceSub">' .$priceText .'</span>';
								echo '</p>';
								echo '<a href="' .$url .'" class="btn">Sign up</a>';
								echo '</div>';
								echo '<h6>Includes</h6>';
								echo '<ul class="featureList">';
								for($x=0; $x<count($featureList); $x++){
									echo '<li>' .$featureList[$x] .'</li>';
								}
								echo '</ul>';
							echo '</li>';

						endwhile; 
						echo '</ul>';

					echo '</div>'; // .options

				}

		echo '</section>';

		cta_section();

	endwhile; endif;

	get_footer();

?>