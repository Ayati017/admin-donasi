<?php 
//niotifikasi kalau ada input error
echo validation_errors('<div class="alert alert-danger"><i class="fa fa-warning"> </i>','</div>');

//open form
echo form_open(base_url('admin/user/edit/'.$user->id_donatur));
?>

<div class="col-md-6">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama_donatur" class="form-control" placeholder="Nama" 
		value="<?php echo $user->nama_donatur ?>" required>
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email_donatur" class="form-control" placeholder="Email" 
		value="<?php echo $user->email_donatur?>" required>
	</div>

	<div class="form-group">
		<label>Password <span class="text-danger"><small>(Password minimal 6 karakter atau biarkan kosong)</small></span></label>
		<input type="password" name="password" class="form-control" placeholder="Password" 
		value="<?php echo set_value('password')?>">
	</div>
	<div class="form-group">
		<label>No Telpon</label>
		<input type="text" name="telp_donatur" class="form-control" placeholder="No Telp" 
		value="<?php echo $user->telp_donatur?>" required>
	</div>

	<div class="form-group">
		<label>Alamat</label>
		<input type="text" name="alamat_donatur" class="form-control" placeholder="" 
		value="<?php echo $user->alamat_donatur?>" required>
	</div>
</div>

<div class="col-md-6">
	<div class="form-group">
		<label>Level Hak Akses</label>
		<select name="akses_level" class="form-control">
			<option value="Admin">Admin</option>
			<option value="User">User</option>
		</select>
	</div>

	<div class="form-group">
		<label>Status</label>
		<select name="status" class="form-control">
			<option value="verified">verified</option>
			<option value="unverified">unverified</option>
		</select>
	</div>

	<div class="form-group">
		<input type="submit" name="submit" class="btn btn-success btn-md" value="Simpan data">
		<input type="reset" name="reset" class="btn btn-default btn-md" value="Reset">
	</div>
</div>