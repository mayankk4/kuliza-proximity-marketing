Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <?php echo anchor('/auth/logout/', 'Logout');?>

<?php $this->load->view("/elements/header") ?>

	
	<p>Name        : <input type="text" id="name" /></p>

	<input type="button" value="UPDATE" id="update" />

	<script type='text/javascript'>

	    $(document).ready(function() {

	    	var owner_id = <?php echo $current_id ?>;

            $.ajax({
	            url: "/product/get_owner_details/"+owner_id,
	            type: "GET",
	            cache: false,
	            success: function(data){
                    json_data = JSON.parse(data);
                    $("#name").val(json_data[0].name);
                }
            });


            $("#update").click(function(){
            	var name = $("#name").val();
	            $.ajax({
		            url: "/admin/update_owner/",
		            type: "POST",
		            data: {id: owner_id, name : name},
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
