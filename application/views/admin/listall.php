Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <?php echo anchor('/auth/logout/', 'Logout');
?>

<?php $this->load->view("/elements/header", array('heading' => $heading)) ?>

	<p><a href="/admin/listall">List all products</a> | <a href="/admin/insert">Create new</a> </p>

	<script type="text/javascript">
	    	function deleteme(id){
	            $.ajax({
		            url: "/admin/delete_product/",
		            type: "POST",
		            data: {id: id},
		            cache: false,
		            success: function(data){
						location.reload();
					}
		    	});
        	}
	</script>

    	<h1> Products </h1>

    	<table id ="products">
			<tr>
	    		<th>Id</th>
	    		<th>Product-id</th>
	    		<th>QR Code</th>
	    		<th>Owner-id</th>
	    		<th>Name</th>
	    		<th>URL</th>
	    		<th>Image URL</th>
	    		<th>Description</th>
	    		<th>Edit</th>
	    		<th>Delete</th>
	    	</tr>
    	</table>

<br>
<br>
<br>

    	<h1> Owners </h1>

    	<table id ="owners">
			<tr>
	    		<th>id</th>
	    		<th>Name</th>
	    		<th>Edit</th>
	    	</tr>
    	</table>

	<script type='text/javascript'>

	    $(document).ready(function() {

            $.ajax({
	            url: "/admin/get_all_owners_products/",
	            type: "GET",
	            cache: false,
	            success: function(data){

                    json_data = JSON.parse(data);

					$.each(json_data.products, function(i,item) {

						// Populate the details
						 var r = new Array(), j = -1;
						     r[++j] = '<tr><td>';
						     r[++j] = item.id;
						     r[++j] = '</td><td>';
						     r[++j] = item.product_id;
						     r[++j] = '</td><td>';
						     r[++j] = '<a href="/product/view/' + encode64(item.id) + '" target="_blank">QR Code</a>';
						     r[++j] = '</td><td>';
						     r[++j] = item.owner_id;
						     r[++j] = '</td><td>';
						     r[++j] = item.name;
						     r[++j] = '</td><td>';
						     r[++j] = '<a href="' + item.url + '">Link to product URL</a>';
						     r[++j] = '</td><td>';
						     r[++j] = '<a href="' + item.image_url + '">Link to image</a>';
						     r[++j] = '</td><td>';
						     r[++j] = item.description;
						     r[++j] = '</td><td>';
						     r[++j] = '<a href="/admin/edit_product/' + item.id + '">Edit</a>';
						     r[++j] = '</td><td>';
						     r[++j] = '<input type="button" class="delete" value="delete" onclick="deleteme('+ item.id  +')" />';
						     r[++j] = '</td></tr>';

					     // faster than string append
						 $(r.join('')).appendTo('#products');

					});

					$.each(json_data.owners, function(i,item) {

						// Populate the details
						 var r = new Array(), j = -1;
						     r[++j] = '<tr><td>';
						     r[++j] = item.id;
						     r[++j] = '</td><td>';
						     r[++j] = item.name;
						     r[++j] = '</td><td>';
						     r[++j] = '<a href="/admin/edit_owner/' + item.id + '">Edit</a>';
						     r[++j] = '</td></tr>';

					     // faster than string append
						 $(r.join('')).appendTo('#owners');

					});

	            }
	        });   // end ajax call






	    }); // end document ready

	</script>
<?php $this->load->view("/elements/footer"); ?>