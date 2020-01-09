<!DOCTYPE html>
<html>
<head>
	<title>Form Login</title>
</head>
<body>
	
  <?php if (validation_errors()) : ?>
      
        <?php echo validation_errors(); ?>
     
  <?php endif; ?>
  <?php if ($this->session->flashdata('succses')) : ?>
      
        <?php echo $this->session->flashdata('succses'); ?>
     
  <?php endif; ?>
	<?php echo form_open(); ?>
	<table>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?php echo form_input('nama'); ?></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><?php echo form_input('password'); ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo form_input('email'); ?></td>
		</tr>
		<tr>
			<td>Submit</td>
			<td></td>
			<td><?php echo form_submit('submit'); ?></td>
		</tr>

	</table>

	<?php echo form_close(); ?>
	
</body>
</html>