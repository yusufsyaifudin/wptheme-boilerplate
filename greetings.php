<?php 

/**
 * Show this greetings message when in homepage only
 *
 * @package Wordpress
 */

if ( is_front_page() && is_home() ): ?>
	
	<div class="jumbotron">
		<div class="container">
			<h1>Hello, world!</h1>
			<p>This is my great Website</p>
		</div>
	</div>

<?php endif; ?>