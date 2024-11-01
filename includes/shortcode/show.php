<?php	
	
	function d_show_deals_shortcode($segment) {

		if ( is_admin() )
		return;

		
		extract(shortcode_atts(array(
			'segment' => ''
		), $segment));
		
		$segmentDeals = esc_attr($segment);
		
		$endpoint = 'https://omgnlmjfo0.execute-api.us-east-1.amazonaws.com/prod/api/offer/';

		if($segmentDeals != '') {
			$deals_tpl_res   = ''.$endpoint.'segment/'.get_site_option( 'redcase_key' ).'/'.$segmentDeals.'';
		}else {
			$deals_tpl_res   = ''.$endpoint.'deals/'.get_site_option( 'redcase_key' ).'';
		}

		$replace = array("/"," ");

		echo '
		<div class="container" id="app">
			<div class="row mt-40 mb-40">
				<div id="fb-root"></div>
				
				<div class="row container mb-10">
					
					<div class="col-sm-6">
						<form class="form-inline">
							<div class="inner-addon left-addon">
									<i class="fa fa-search"></i>
									<input type="text" class="form-control search-deals" id="searchInput" onkeyup="search()" placeholder="Search deals ... ">
							</div>
						</form>
					</div>

					<div class="col-sm-6">
						<select name="cars" v-model="category" @change="selectCategory(category)" id="filter-options-category">
							<option id="option" :value="null">Select a category</option>
							<option id="option" :value="null">See all</option>
								<option v-for="category in categories" id="option" v-bind:value="category" @>
									{{category}}
								</option> 
						</select>
					</div>
					
					<div class="loading" v-if="loading">
						<img src="https://i.ya-webdesign.com/images/peach-svg-animated-6.gif" />
						<h2>Loading ...</h2>
					</div>
					
					<div class="row col-sm-12 mt-20 p-0" id="product-list">
					
					<div class="product filter_name col-sm-4" v-for="(result, index) in results.offers">
						
						<div class="column">
							
							<div class="post-module hover">
								<div class="thumbnail">
									<a class="view" data-toggle="modal" 
									:value="result._id" 
									:deal="result.dealName" 
									:data-target="`#modal${result._id}`">
										<img v-lazy="result.featureImage" class="card-img-top" :title="result.dealName" 
										:alt="result.dealName"
										>
									</a>
								</div>
							
								<div class="post-content">
									<div class="category"> category Title</div>
									<h1 class="title">{{result.by}}: {{ result.dealName }}</h1>
								</div>

							</div>

						</div>
						<!-- Finished Column -->

				    	<div class="modal animated" :id="`modal${result._id}`" 
				    	role="dialog"
				    	:aria-labelledby="`modal-${result._id}`" 
				    	aria-hidden="true">
						  <div class="row modal-dialog animated fadeInDown">
							<div class="row modal-content">  
							<div class="col-sm-12 col-lg-12">
							<button 
							type="button" 
							class="close desktop" 
							data-dismiss="modal" 
							aria-label="Close">
							<span
							aria-hidden="true">&times
							</span>
							</button>
						     <div class="modal-body" id="message-id">  
										
										<img v-lazy="result.imagePromo" class="card-img-top" :title="result.dealName" 
										:alt="result.dealName"
										>

						        <h4 class="modal-title">{{result.dealName}}</h4>
						        <p class="modal-title"><b>From:</b>{{result.by}}</p><br />
										<p v-html="result.description" class="modal-title"></p><br />
								
										<p><a target="_blank" :href="result.url || result.sheerIDCode" :id="`getoffer-${result._id}`"
										:value="result._id"
										:deal="result.dealName"
										class="btn btn-primary stopload click">
						        Get Offer 
						        </a>
						        <!--<button class="buttonload btn btn-primary">
											<i class="fa fa-spinner fa-spin"></i> Loading
										</button>-->
						        </p>
						      </div>
						    </div>
						  </div>
						  </div>
						</div>
					
					</div>
					<!-- Finished colum deals --> 
				</div>
				
				<paginate
				:page-count="Number(`${results.pages}`)"
				:page-range="3"
				:margin-pages="2"
				:click-handler="clickCallback"
				:container-class="`pagination`"
				:page-class="`page-item`">
				</paginate>

				</div>
				<!-- Finished row container mb-10 -->
			</div>
		</div>';

		echo '
			<script>
				SheerID.setBaseUrl("https://services-sandbox.sheerid.com/jsapi");
				SheerID.load("iframe", "1.2", { config : { lightbox: true, mobileRedirect: false, top: "25px", closeBtnRight: "25px" } });
			</script>
			
			<script>

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
			
			function search() {
			    var input = document.getElementById("searchInput");
			    var filter = input.value.toUpperCase();
			    
			    var ul = document.getElementById("product-list");
			    
				var li = ul.getElementsByClassName("product");
							    
			
			    for (i = 0; i < li.length; i++) {
					var a = li[i].getElementsByTagName("h1")[0];
					var b = li[i].getElementsByTagName("p")[0];
			        
			        if (a.innerHTML.toUpperCase().indexOf(filter) > -1 || b.innerHTML.toUpperCase().indexOf(filter) > -1) {
			            li[i].style.display = "";
			        } else {
			            li[i].style.display = "none";
					}
					
			    }
			    
			 }  

				$(".view").click(function()
				{
				var id = $(this).attr("value");
				$.post("https://omgnlmjfo0.execute-api.us-east-1.amazonaws.com/prod/api/offer/view-deals",
				{
					id: id
				},
				function(data, status){
					console.log("Status Views: " + status);
				});
				});

				$(".click").click(function()
				{
				var id = $(this).attr("value");
				$.post("https://omgnlmjfo0.execute-api.us-east-1.amazonaws.com/prod/api/offer/click-deals",
				{
					id: id
				},
				function(data, status){
					console.log("Status Click: " + status);
				});
				});

				$(".view").click(function() {
					var nameDeal = $(this).attr("deal");
					 gtag("event", nameDeal, {
						 "event_category" : "Deal View",
						 "event_label" : "'.get_bloginfo( "name" ).'"
					 });
				 });
				 
				 $(".click").click(function() {
					var nameDeal = $(this).attr("deal");
					 gtag("event", nameDeal, {
						 "event_category" : "Deal Click",
						 "event_label" : "'.get_bloginfo( "name" ).'"
					 });
				 });
			
			</script>

			<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134131635-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "UA-134131635-1");
		</script>

		<script>
			if ("loading" in HTMLImageElement.prototype) {
					const images = document.querySelectorAll("img.lazyload");
					images.forEach(img => {
							img.src = img.dataset.src;
					});
			} else {
					// Dynamically import the LazySizes library
				let script = document.createElement("script");
				script.async = true;
				script.src =
					"https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.8/lazysizes.min.js";
				document.body.appendChild(script);
			}
		</script>

		<script src="https://unpkg.com/vue"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="https://unpkg.com/vuejs-paginate@latest"></script>
		<script src="https://unpkg.com/vue-lazyload/vue-lazyload.js"></script>
		';
		echo "
		<script language='JavaScript'>
				 const url = '". $deals_tpl_res ."';
				 
					Vue.component('paginate', VuejsPaginate)

					// or with options
					Vue.use(VueLazyload, {
						preLoad: 1.3,
						loading: 'https://1.bp.blogspot.com/-yIhXlQfYN1E/WMksG192LLI/AAAAAAAAA9w/txsqdQfykVksDEFshayeN54c0Gu6C3AAwCLcB/s1600/glow.gif',
						attempt: 1
					})

					const vm = new Vue({
						el: '#app',   
						data: {
							results: [],
							loading: true,
							categories: [],
							category: null
						},
						methods: {
							clickCallback: function (pageNum) {
								this.loading = true
								this.results = []
								axios.get(url + '/?page=' + pageNum + '&search=' + this.category )
								.then(response => {
									this.results = response.data
									this.loading = false
								})
								return
							},
							selectCategory: function (value) {
								this.loading = true
								this.results = []
								axios.get(url + '/?search=' + value)
								.then(response => {
									this.results = response.data
									this.loading = false
								})
								return
							}
						},
						mounted() {
							axios.get(url)
								.then(response => {
									const offers = response.data.offers
									this.results = response.data	

									const list = offers.map(item => item.category.title)
									this.categories = [ ...new Set(list) ]
									
									this.loading = false
								})
						}
					});
		</script>";

};

