<?php

    function redcase_query_vars($aVars) {
        $aVars[] = "name"; // represents the name of the product category as shown in the URL
        return $aVars;
    }

    function add_rewrite_rules($aRules) {
        $aNewRules = array('deal/([^/]+)/?$' => 'index.php?pagename=deal&name=$matches[1]');
        $aRules = $aNewRules + $aRules;
        return $aRules;
    }

    function d_show_single_deal_shortcode () {
        if ( is_admin() )
        return;
        
        $queryURL = parse_url( html_entity_decode( esc_url( add_query_arg( $arr_params ) ) ) );
        parse_str( $queryURL['query'], $getVar );
        $variable = $getVar['title'];
		
        $endpoint = 'https://omgnlmjfo0.execute-api.us-east-1.amazonaws.com/prod/api/offer/';
        
        $deals_tpl_res   = wp_remote_get(''.$endpoint.'deal/'.$variable.'');
		
	    $deals_res_data  = wp_remote_retrieve_body($deals_tpl_res);  
	
		$data = json_decode($deals_res_data);
		
        $new = array();

		$replace = array("/"," ");
		
		foreach($data as $value) {
		    $new[serialize($value->category->title)] = $value->category->title;
		}
		
        $array = array_values($new);
				
			echo '<div class="row mb-40">';
			
			echo '<div id="fb-root"></div>';
			
			echo '<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.2";
				fjs.parentNode.insertBefore(js, fjs);
			  }(document, "script", "facebook-jssdk"));</script>';
  
			echo '<div class="row col-sm-12 p-0" id="product-list">';
				foreach( $data as $deal ) {
					echo
                    '<div class="col-sm-12 col-lg-12">',
                      '<img ',
                        'class="lazy card-img" style="width: 50%;float:left;margin-right:20px;"',
                        'title="', $deal->dealName, '" ',
                        'src="', 'https://1.bp.blogspot.com/-yIhXlQfYN1E/WMksG192LLI/AAAAAAAAA9w/txsqdQfykVksDEFshayeN54c0Gu6C3AAwCLcB/s1600/glow.gif', '" ',
                        'data-src="', $deal->imagePromo, '" ',
                        'data-srcset="', $deal->imagePromo, '" ',
                        'alt="', $deal->dealName, '"',
                        '>',
                        '<h4 class="modal-title" style="margin: 0 0 10px;">'. $deal->dealName .'</h4>',
                        '<p class="modal-title" style="margin: 0 0 10px;"><b>From:</b> '. $deal->by .'</p>',
                        '<p class="modal-title" style="margin: 0 0 10px;">'. $deal->description .'</p><br />',
                        '<!--<div data-network="twitter" data-url="https://mercadodedescontos.com.br" data-title="'. $deal->dealName .' '. $deal->description .'" class="st-custom-button twitter">Twitter </div>
                        <div data-network="facebook" data-url="https://mercadodedescontos.com.br" data-title="'. $deal->dealName .'" data-description="'. $deal->description .'" data-image="'. $deal->imagePromo .'" class="st-custom-button facebook">Facebook </div> -->',
                        $deal->sharingType == 'code' ? '<p><a data-sheerid-iframe="true" href="'.$deal->sheerIDCode.'/"' : '<p><a target="_blank" href="'.$deal->url.'"',
                        $deal->sharingType == 'code' ? 'id="getoffer-' . $deal->_id . '" ' : '',
                                ' value="'. $deal->_id .'"',
                                ' deal="'. $deal->dealName .'"',
                                'class="btn btn-primary stopload click">',
                        'Get Offer', 
                        '</a>
                        <button class="buttonload btn btn-primary">
                          <i class="fa fa-spinner fa-spin"></i> Loading
                        </button>
                        </p>';
				    	
					echo '
					<script>
					
						$(".buttonload").hide()
						
						$(".stopload").show()
													
						$("#getoffer-'. $deal->_id .'").click(function() {
                            var element = document.getElementById("modal'. $deal->_id .'");
                            
                            $(".buttonload").show()
							$(".stopload").hide()
							
							setTimeout(function () {
								$(".buttonload").hide()
							    $(".stopload").show()
		                 	}, 1000);
	
						});
						
					</script>';
					echo '</div>';  
				    
				}
			echo '</div>';
			echo '</div>';
			
			echo '
			<script>
				SheerID.setBaseUrl("https://services-sandbox.sheerid.com/jsapi");
				SheerID.load("iframe", "1.2", { config : { lightbox: true, mobileRedirect: false, top: "25px", closeBtnRight: "25px" } });
            </script>';
            
            echo '<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134131635-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "UA-134131635-1");
		</script>';
			
			echo '<script>

			$.getScript("//platform-api.sharethis.com/js/sharethis.js#product=custom-share-buttons");
			
			(function(document) {
				var shareButtons = document.querySelectorAll(".st-custom-button[data-network]");
				for(var i = 0; i < shareButtons.length; i++) {
				   var shareButton = shareButtons[i];
				   
				   shareButton.addEventListener("click", function(e) {
					  var elm = e.target;
					  var network = elm.dataset.network;
					  
					  console.log("share click: " + network);
				   });
				}
			 })(document);

                var id = $(this).attr("value");
                $.post("https://9ofi64209i.execute-api.us-east-1.amazonaws.com/dev/api/offer/view-deals",
                {
                    id: id
                },
                function(data, status){
                    console.log("Status Views: " + status);
                });

				var nameDeal = $(this).attr("deal");
					 gtag("event", nameDeal, {
						 "event_category" : "Deal View",
						 "event_label" : "'.get_bloginfo( "name" ).'"
				 });
			
			</script>';	
	}
	