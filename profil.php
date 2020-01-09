<?php 
//niotifikasi kalau ada input error
echo validation_errors('<div class="alert alert-danger"><i class="fa fa-warning"> </i>','</div>');

//notifikasi
if ($this->session->flashdata('sukses')) {
	echo '<div class="alert alert-success"><i class="fa fa-check"></i> ';
	echo $this->session->flashdata('sukses');
	echo '</div>';
}

//open form
echo form_open(base_url('admin/dasbor/profil'));
?>

<div class="col-md-6">
	<div class="form-group">
		<label>Username</label>
		<input type="text" name="username" class="form-control" placeholder="Username" 
		value="<?php echo $admin->username ?>" required>
	</div>

	<div class="form-group">
		<label>Password <span class="text-danger"><small>(Password minimal 6 karakter atau biarkan kosong)</small></span></label>
		<input type="password" name="password_admin" class="form-control" placeholder="Password" 
		value="<?php echo set_value('password_admin')?>">
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email_admin" class="form-control" placeholder="Email" 
		value="<?php echo $admin->email_admin?>" required>
	</div>
</div>

<div class="col-md-6">
	<div class="form-group">
		<label>Level Hak Akses</label>
		<select name="akses_level" class="form-control">
			<option value="<?php echo $admin->akses_level ?>"><?php echo $admin->akses_level ?></option>
		</select>
	</div>

	<div class="form-group">
		<input type="submit" name="submit" class="btn btn-success btn-md" value="Simpan data">
		<input type="reset" name="reset" class="btn btn-default btn-md" value="Reset">
	</div>
</div>