<?php $this->load->view("/elements/header") ?>

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

	    $(document).ready(function() {

	    	var product_id = "";
	    	var owner_id = "";
	    	var owner_name = "";

            $.ajax({
	            url: "/product/get_product_details/<?php echo $id ?>",
	            type: "GET",
	            cache: false,
	            success: function(data){

                    json_data = JSON.parse(data);

		            $.ajax({
			            url: "/product/get_owner_details/"+json_data[0].owner_id,
			            type: "GET",
			            cache: false,
			            success: function(data1){
		                    json_data2 = JSON.parse(data1);
		                    $("#owner_name").html(json_data2[0].name);
		
		                    $("#name").html(json_data[0].name);
		                    $("#owner").html(json_data[0].owner_id);
		                    $("#product_id").html(json_data[0].product_id);
		                    $("#description").html(json_data[0].description);
		                    $("#url").attr('href',json_data[0].url);
		                    $("#imagex").attr('src',json_data[0].image_url);

	                        product_id = json_data[0].product_id;
		                    owner_id = json_data[0].owner_id;       
		        	    	owner_name = json_data2[0].name; 
		                }
		            });

                }
            });

            $(".action").click(function(){
            	alert("Calling echo API for product " + product_id + " for owner " + owner_name + " with action " + this.value);
            });

      	});
	</script>


<?php $this->load->view("/elements/footer"); ?>
