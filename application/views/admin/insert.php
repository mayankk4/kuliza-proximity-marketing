Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <?php echo anchor('/auth/logout/', 'Logout');
?>

<?php $this->load->view("/elements/header", array('heading' => $heading)) ?>

	<h1> Add new Product</h1>
	<p>Name        : <input type="text" id="name" /></p>
	<p>Owner       : <input type="text" id="owner" value="1" disabled="true" /></p>
	<p>Category       : <input type="text" id="category" value="Electronics" disabled="true" /></p>
	<p>Object Type       : <input type="text" id="objectType" value="product" disabled="true" /></p>
	<p>Product Id  : <input type="text" id="product_id" /></p>
	<p>Web Link     : <input type="text" id="url" value="http://" /></p>
	<p>Image URL   : <input type="text" id="imagex"  value="http://" /></p>
	<p>Description : <input type="text" id="description"></p>

	<input type="button" value="Create Product" id="create_product" />

<br>
<br>

	<h1> Add new Owner </h1>
	<p>Name        : <input type="text" id="name_owner" /></p>
	<input type="button" value="Create Owner" id="create_owner" />

	<script type='text/javascript'>

	    $(document).ready(function() {

            $("#create_product").click(function(){

            	var name = $("#name").val();
            	var owner_id = $("#owner").val();
            	var category = $("#category").val();
            	var objectType = $("#objectType").val();
            	var product_id = $("#product_id").val();
            	var description = $("#description").val();
            	var url = $("#url").val();
            	var image_url = $("#imagex").val();

	            $.ajax({
		            url: "/admin/create_product/",
		            type: "POST",
		        	data: { owner_id: owner_id, product_id: product_id, category: category, objectType: objectType, name: name , url: url, image_url: image_url, description: description },
		            success: function(data){
		            	if(data){
			            	window.location = "/admin/listall";
		            	}else{
			            	window.location = "/404";
		            	}
		            }
	            });//end ajax
            });// end update click


            $("#create_owner").click(function(){
            	var name = $("#name_owner").val();
	            $.ajax({
		            url: "/admin/create_owner/",
		            type: "POST",
		            data: {name : name},
		            success: function(data){
		            	if(data){
			            	window.location = "/admin/listall";
		            	}else{
			            	window.location = "/404";
		            	}
		            }
	            });//end ajax
            });// end update click

      	}); // doc ready ends

	</script>





<?php $this->load->view("/elements/footer"); ?>