Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <?php echo anchor('/auth/logout/', 'Logout');?>

<?php $this->load->view("/elements/header") ?>

	
	<p>Name        : <input type="text" id="name" /></p>
	<p>Owner       : <input type="text" id="owner" /></p>
	<p>Product Id  : <input type="text" id="product_id" /></p>
	<p>Category    : <input type="text" id="category" /></p>
	<p>Object Type : <input type="text" id="objectType" /></p>
	<p>Website     : <input type="text" id="url" /></p>
	<p>Image       : <input type="text" id="imagex" /></p>
	<p>Description : <input type="text" id="description"></p>


	<input type="button" value="UPDATE" id="update" />

	<script type='text/javascript'>

	    $(document).ready(function() {

	    	var prod_id = <?php echo $current_id ?>;

            $.ajax({
	            url: "/product/get_product_details/"+prod_id,
	            type: "GET",
	            cache: false,
	            success: function(data){

                    json_data = JSON.parse(data);
                    $("#name").val(json_data[0].name);
                    $("#owner").val(json_data[0].owner_id);
                    $("#category").val(json_data[0].category);
                    $("#objectType").val(json_data[0].objectType);
                    $("#product_id").val(json_data[0].product_id);
                    $("#description").val(json_data[0].description);
                    $("#url").val(json_data[0].url);
                    $("#imagex").val(json_data[0].image_url);

                }
            });

            $("#update").click(function(){

            	var name = $("#name").val();
            	var owner_id = $("#owner").val();
            	var objectType = $("#objectType").val();
            	var category = $("#category").val();
            	var product_id = $("#product_id").val();
            	var description = $("#description").val();
            	var url = $("#url").val();
            	var image_url = $("#imagex").val();

	            $.ajax({
		            url: "/admin/update_product/",
		            type: "POST",
		        	data: { id: prod_id, owner_id: owner_id, objectType: objectType, category: category, product_id: product_id, name: name , url: url, image_url: image_url, description: description },
		            success: function(data){
		            	if(data){
			            	window.location = "/product/view/" + encode64(prod_id);
		            	}else{
			            	window.location = "/404";
		            	}
		            }
	            });//end ajax
            });// end update click

      	}); // doc ready ends

	</script>


<?php $this->load->view("/elements/footer"); ?>
