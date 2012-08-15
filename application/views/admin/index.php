Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <?php echo anchor('/auth/logout/', 'Logout');
?>

<?php $this->load->view("/elements/header", array('heading' => $heading)) ?>

		<p><a href="/admin/listall">List all products</a> </p>
		<p><a href="/admin/insert">Insert a new product</a> </p>

<?php $this->load->view("/elements/footer"); ?>