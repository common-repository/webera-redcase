<?php
	
function d_filter_deals_content($deals_data) {
		
	global $post;
    
    $deals_tpl_res   = wp_remote_get( 'https://api.mockaroo.com/api/f288a1c0?count=100&key=b60f1fe0' );
    $deals_res_data  = wp_remote_retrieve_body( $deals_tpl_res );
    

	$data = json_decode($deals_res_data);
	
	//wp_register_style( 'd_bootstrap', plugins_url('assets/css/style/style.css', DEALS_PLUGIN_URL ) );
    //wp_enqueue_style( 'd_bootstrap' );
    
    echo '<div class="row">';
			echo '<div class="container">';
				echo '<div id="root">';
				foreach( $data as $deal ) { 
		
					echo
				        '<div class="card">',
				            '<img ',
				                'class="card-img-top" ',
				                'title="', $deal->deal_name, '" ',
				                'src="', $deal->card_image, '" ',
				                'alt="', $deal->deal_name, '"',
				            '>',
				            '<div class="card-body">',
					            '<h5 class="card-title">',
					            	$deal->deal_name,
					            '</h5>',
					            '<p class="card-text">',
					            	$deal->description,
					            '</p>',
								'<a href="#" class="btn btn-primary">',
									'Saiba mais',
								'</a>',
				            '</div>',
				        '</div>';
				    
				}
				echo '</div>';
			echo '</div>';
		echo '</div>';

/*

	if(!empty($data)) {
		echo '<div class="row">';
			echo '<div class="container">';
				echo '<div id="root">';
				foreach( $data as $deal ) { 
		
					echo
				        '<div class="card">',
				            '<img ',
				                'class="card-img-top" ',
				                'title="', $deal->deal_name, '" ',
				                'src="', $deal->card_image, '" ',
				                'alt="', $deal->deal_name, '"',
				            '>',
				            '<div class="card-body">',
					            '<h5 class="card-title">',
					            	$deal->deal_name,
					            '</h5>',
					            '<p class="card-text">',
					            	$deal->description,
					            '</p>',
								'<a href="#" class="btn btn-primary">',
									'Saiba mais',
								'</a>',
				            '</div>',
				        '</div>';
				    
				}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
*/
	

}