<?php $this->load->view("/elements/header") ?>


	<link rel="stylesheet" type="text/css" href="http://demo.echo.kuliza.com/css/buttons.css" />

	<div id="echo-se"> </div>

	<input type="button" value="ACTION 1" class="action" />
	<input type="button" value="ACTION 2" class="action" />
	<input type="button" value="ACTION 3" class="action" />
	<input type="button" value="ACTION 4" class="action" />
	
	<p>Name : <span id="name"></span></p>
	<p>Product Id: <span id="product_id"> </span></p>

	<p>Owner Id : <span id="owner"> </span></p>
	<p>Owner Name: <span id="owner_name"> </span></p>

	<p>Website : <a href="#" id="url" target="_blank">LINK</a></p>
	<p>Image :</p>
	<img src="" id="imagex" />

	<p>Description : <span id="description"> </span></p>

	<script type='text/javascript'>

		var jq = jQuery.noConflict();

		var base_url = "http://demo.echo.kuliza.com";
		var url = "http://magento.shoppul.se/index.php/apparel/shoes/womens/anashria-womens-premier-leather-sandal.html";

		var client_options = {
                  name : "Sonssy VAIO",
                  category : "Electronics",
                    id : "2071",
                    img : "SONY VAIO IMAGE URL",
                    objectType : "product"
                };
	</script>



	<script type='text/javascript'>

	    jq(document).ready(function() {

	    	var product_id = "";
	    	var owner_id = "";
	    	var owner_name = "";

            jq.ajax({
	            url: "/product/get_product_details/<?php echo $id ?>",
	            type: "GET",
	            cache: false,
	            success: function(data){

                    json_data = JSON.parse(data);

		            jq.ajax({
			            url: "/product/get_owner_details/"+json_data[0].owner_id,
			            type: "GET",
			            cache: false,
			            success: function(data1){
		                    json_data2 = JSON.parse(data1);
		                    jq("#owner_name").html(json_data2[0].name);
		
		                    jq("#name").html(json_data[0].name);
		                    jq("#owner").html(json_data[0].owner_id);
		                    jq("#product_id").html(json_data[0].product_id);
		                    jq("#description").html(json_data[0].description);
		                    jq("#url").attr('href',json_data[0].url);
		                    jq("#imagex").attr('src',json_data[0].image_url);

	                        product_id = json_data[0].product_id;
		                    owner_id = json_data[0].owner_id;       
		        	    	owner_name = json_data2[0].name; 
		                }
		            });

                }
            });

            // jq(".action").click(function(){
            // 	alert("Calling echo API for product " + product_id + " for owner " + owner_name + " with action " + this.value);
            // });

////////////// g u p t a //////////////


	var url_this = "http://magento.shoppul.se/index.php/apparel/shoes/womens/anashria-womens-premier-leather-sandal.html";

	var result = jq.ajax({
	    url: base_url + '/client/buttons',
	    type: 'GET',
	    data : { 'params' : client_options, 'url' : url_this},
	    dataType: "jsonp",
	    success : function(data){
	        // We dont parse json object sent when json-p is used because it already is in Object format.
	 		// console.log(data);
	 		var js_append = '<script src="\/static\/js/fb_sharing.js"><\/script>';
	 	 	js_append = js_append  + '<script src="\/static\/js\/jquery.ba-postmessage.min.js"><\/script>';
	 	 	// console.log(js_append);
	       jq('#echo-se').html(data.html + js_append);
	    },
	    error : function(xhr, textStatus, error){
	        // alert(xhr);
	        // alert(error);
	        // alert(textStatus);
	    }
	});


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

});
</script>
<?php $this->load->view("/elements/footer"); ?>
