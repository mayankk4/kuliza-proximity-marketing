<?php $this->load->view("/elements/header") ?>

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

var client_options = {
                  productName : "Sony VAIO",
                  productCategory : "Electronics",
                    productId : "2071",
                    productImg : "SONY VAIO IMAGE URL",
                    objectType : "product"
                };

var result = jq.ajax({
    url: base_url + '/client/buttons',
    type: 'GET',
    data : { 'params' : client_options, 'url' : url},
    dataType: "jsonp",
    success : function(data){
        // We dont parse json object sent when json-p is used because it already is in Object format.
 		console.log(data);
 		var js_append = "<script src='\/static\/js\/fb_sharing.js'><\/script><script src='\/static\/js\/jquery.ba-postmessage.min.js'><\/script>";
       jq('#echo-se').html(data.html + js_append);
    },
    error : function(xhr, textStatus, error){
        // alert(xhr);
        // alert(error);
        // alert(textStatus);
    }
}); 







      	});
	</script>
<?php $this->load->view("/elements/footer"); ?>
