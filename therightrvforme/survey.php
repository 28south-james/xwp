
<?php 

/*
 Template Name: Survey
*/

include 'header.php'; ?>

<div id="stage" class="loading">

	<div class="scene" data-scene="0">
		<div class="background"></div>
		<div class="foreground"></div>
		<div class="question intro text" data-question="0">
			<div class="textWrap">
				<h1>So you want to hit the road?</h1>
				<h4>More text here please. We'll help you find the right RV for your travels. You're only a few questions and giggles away!</h4>
			</div>
			<div class="buttons"><span class="btn continue">Get started</span></div>
		</div>
		<div class="question text" data-question="1">
			<div class="textWrap">
				<h2>Let's go, shall we?</h1>
				<h4>More text here please. We'll help you find the right RV for your travels. You're only a few questions and giggles away!</h4>
			</div>
			<div class="buttons"><span class="btn back">Back</span><span class="btn continue">Continue</span></div>
		</div>
	</div>

	<div class="scene" data-scene="1">
		<div class="background"></div>
		<div class="foreground"></div>
		<div class="question intro text" data-question="0">
			<div class="textWrap">
				<h1>Here's the next scene.</h1>
				<h4>More text here please. We'll help you find the right RV for your travels. You're only a few questions and giggles away!</h4>
			</div>
			<div class="buttons"><span class="btn">Get started</span></div>
		</div>
		<div class="question text" data-question="1">
			<div class="textWrap">
				<h2>Let's go, shall we?</h1>
				<h4>More text here please. We'll help you find the right RV for your travels. You're only a few questions and giggles away!</h4>
			</div>
			<div class="buttons"><span class="btn back">Back</span><span class="btn continue">Continue</span></div>
		</div>
		<div class="question intro text" data-question="0">
			<div class="textWrap">
				<h1>Here's the next scene.</h1>
				<h4>More text here please. We'll help you find the right RV for your travels. You're only a few questions and giggles away!</h4>
			</div>
			<div class="buttons"><span class="btn back">Back</span><span class="btn continue">Continue</span></div>
		</div>
		<div class="question text" data-question="1">
			<div class="textWrap">
				<h2>Let's go, shall we?</h1>
				<h4>More text here please. We'll help you find the right RV for your travels. You're only a few questions and giggles away!</h4>
			</div>
			<div class="buttons"><span class="btn back">Back</span><span class="btn continue">Continue</span></div>
		</div>
		<div class="question intro text" data-question="0">
			<div class="textWrap">
				<h1>Here's the next scene.</h1>
				<h4>More text here please. We'll help you find the right RV for your travels. You're only a few questions and giggles away!</h4>
			</div>
			<div class="buttons"><span class="btn back">Back</span><span class="btn continue">Continue</span></div>
		</div>
		<div class="question text" data-question="1">
			<div class="textWrap">
				<h2>Let's go, shall we?</h1>
				<h4>More text here please. We'll help you find the right RV for your travels. You're only a few questions and giggles away!</h4>
			</div>
			<div class="buttons"><span class="btn back">Back</span></div>
		</div>
	</div>

	<ul id="sceneList">
		<li>Intro</li>
		<li>How will you RV</li>
		<li>Something else</li>
	</ul>

	<div id="progressBar">
		<span class="slide"><span class="progress"></span></span>
	</div>

</div>

<?php include 'footer.php'; ?>