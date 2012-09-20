<!doctype html>
<html>
	<head>
		<title>Proximity Marketing</title>
		<meta name ="description" content=""/>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<meta name = "keywords" content=""/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Bitter:400,700,400italic' rel='stylesheet' type='text/css'>
		<link href="/static/css/product-style.css" rel="stylesheet"/>
		
		<script type="text/javascript" src="/static/js//jquery.js"></script>
		<script type="text/javascript" src="/static/js/jquery-ui-1.8.21.custom.min.js"></script>
		<script type="text/javascript" src="/static/js/jquery.ba-postmessage.min.js"></script>
		<script type="text/javascript" src="/static/js/fb_sharing.js"></script>
	</head>

	<body>
		<div class="bodyWrapper">
			<div class="productImageWrapper">
				<div class="productImageDiv sectionWrapper">
					<!-- VIDEO EMBED -->
					<iframe width="560" height="315" src="http://www.youtube.com/embed/OAgcoW98Yfc?rel=0" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>

			<div class="productInfoWrapper">
				<div class="prductInfoDiv sectionWrapper">
					<h1 class="productName pageHeading boldText" id="name"></h1>
					<div class="productInfo">Product Id <span id="product_id" class="boldText"></span></div>
					<div class="productInfo">Owner <span id="owner" class="boldText"></span></div>
					<div class="productSize"><a href="#" id="url" target="_blank">Go to WebSite</a></div>
					<div class="productPrice" id="description"> </div>
				</div>
			</div>

		</div>
		<div class="widgetWrapper">
			<div class="toggleWrapper sectionWrapper">
				<div class="toggleDiv">
					<a href="" class="toggleToExpand">Expand</a>
				</div>
			</div>

			<div class="buttonWrapperDiv sectionWrapper">
				<h3 class="buttonHeading">What's on your mind?</h3>
				<ul class="buttonsList">
					<li>
						<a href="javascript:ZS.isLoggedIn('Love')" class="widgetButton buttonCompact border-rad echo-buttons echo-button-Love" id="echo-button-26">
							<img src="/static/img/love.png">
							<span class="buttonText">Love</span>
						</a>
					</li>

					<li>
						<a href="javascript:ZS.isLoggedIn('WillWatch')" class="widgetButton buttonCompact border-rad">
							<img src="/static/img/own.png">
							<span class="buttonText">Will Watch</span>
						</a>
					</li>
					<li class="echo-loader-li">
						<div class="echo-loader"></div>
					</li>
				</ul>
			</div>

		</div>

	</body>
	<script type="text/javascript">

		////////// VARIABLES //////////

		var jq = jQuery.noConflict();
		var base_url = "http://demo.echo.kuliza.com";

		var product_url = "http://magento.shoppul.se/index.php/movies/dvd/the-dark-knight-rises.html";

    	var product_id = "168";
    	var url = "http://magento.shoppul.se/index.php/movies/dvd/the-dark-knight-rises.html";

        var client_options = {                  
        	name : "The Dark Knight Rises Movie DVD",                  
        	category : "Movies",                    
        	id : "168",                    
        	img : "http://magento.shoppul.se/media/catalog/product/cache/1/image/265x/9df78eab33525d08d6e5fb8d27136e95/d/a/dark_knight_rises_poster.jpg",                    
        	objectType : "product"
        };


        jq("#owner").html("magento.shoppul.se");

        jq("#name").html("The Dark Knight Rises");
        jq("#product_id").html("168");
        jq("#description").html("Warner Bros. Pictures' and Legendary Pictures' is the epic conclusion to filmmaker Christopher Nolan's Batman trilogy, Leading an all-star international cast, Oscar(R) winner Christian Bale again plays the dual role of Bruce Wayne/Batman.");
        jq("#url").attr('href',"http://magento.shoppul.se/index.php/movies/dvd/the-dark-knight-rises.html");


	/////////////// sharma ////////////////
		jq(function(){
			function changeHeight(){
				var widgetHeight = jq('.widgetWrapper').height()+40;
				jq('.bodyWrapper').css('padding-bottom',widgetHeight);
			}
				
			jq('.toggleToExpand').click(function(){
				jq('.widgetWrapper').toggleClass('expandWidget','slow',function(){
					changeHeight();	
				});
				return false;
			})
			
			changeHeight();	
		});

		/////////////// mayank //////////////////

		// setting values for the video

	    jq(document).ready(function() {


	/////////////// gupta ///////////////

		jq.receiveMessage(
		  function(e){
		    var obj = JSON.parse('{"' + decodeURI(e.data.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
		    if(obj.type == 'is_logged_in'){
		        ZS.is_logged_in = obj.status;
		        ZS.shareOn("post-action");
		    } else {
		        //code to disable the button
		        //action = obj.action;
		        //post_status = obj.status;
		        var action = obj.action;
		        var post_status = obj.status;
		        if(post_status == false || post_status == 'false'){
		            // alert('post was not published');
		        } else {
		            jq('.echo-loader-li').hide();
		            jq('.echo-button-'+action).addClass('echo-buttons-disabled');
					jq('.echo-button-'+action).attr('href', '#');
		        }  
		        //in both the cases close this popup
		        //$('.closeButton').click();
		    }
		  },
		  'http://demo.echo.kuliza.com'
		);

	}); // end ready

	</script>

</html>