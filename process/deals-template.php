<?php 
	
foreach( DATA_PH as $product ) {
		echo '<li>';
			echo '<a href="' . esc_url( $product->link ) . '">' . $product->deal_name . '</a>';
		echo '</li>';
	}
?>		

<!-- <a class="btn btn-primary" href="#" role="button">LEARN_MORE</a> -->
