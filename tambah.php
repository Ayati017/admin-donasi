<?php 
//niotifikasi kalau ada input error
echo validation_errors('<div class="alert alert-danger"><i class="fa fa-warning"> </i>','</div>');

//kalau ada error upload, maka tampilkan
if (isset($error)) {
	echo '<div class="alert alert-warning">';
	echo $error;
	echo '</div>';
}

//open form
echo form_open_multipart(base_url('admin/panti/tambah'));
?>
<div class="col-md-12">
	<div class="form-group ">
		<label>Nama panti sosial</label>
		<input type="text" name="nama_panti" class="form-control" placeholder="Nama panti sosial" 
		value="<?php echo set_value('nama_panti')?>" required>
		<input type="hidden" name="edit" class="form-control" placeholder="Nama panti sosial" 
		value="No" required>
	</div>
</div>

<div class="col-md-4">

	<div class="form-group">
		<label>No Rekening Panti</label>
		<input type="no" name="norek_panti" class="form-control" placeholder="No rekening" 
		value="<?php echo set_value('norek_panti')?>" required>
	</div>

	<div class="form-group">
		<label>Nama Bank</label>
		<input type="text" name="bank_panti" class="form-control" placeholder="Nama bank" 
		value="<?php echo set_value('bank_panti')?>" required>
	</div>
	<div class="form-group">
		<label>Nama Pemilik Rekening</label>
		<input type="text" name="namarek_panti" class="form-control" placeholder="Nama pemilik" 
		value="<?php echo set_value('namarek_panti')?>" required>
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control" placeholder="Email" 
		value="<?php echo set_value('email')?>">
	</div>

	<div class="form-group">
		<label>No Telp</label>
		<input type="text" name="telp_panti" class="form-control" placeholder="No Telp" 
		value="<?php echo set_value('telp_panti')?>">
	</div>
</div>

<div class="col-md-4">
	<div class="form-group form-group-lg">
		<label>Alamat</label>
		<input type="text" name="alamat_panti" class="form-control" placeholder="Alamat" 
		value="<?php echo set_value('alamat_panti')?>" required>
	</div>

	<div class="form-group">
		<label>Latitude</label>
		<input type="text" name="lat" class="form-control" placeholder="Latitude" 
		value="<?php echo set_value('lat')?>">
	</div>

	<div class="form-group">
		<label>Longitude</label>
		<input type="text" name="lng" class="form-control" placeholder="Longitude" 
		value="<?php echo set_value('lng')?>">
	</div>

	<div class="form-group">
		<label>Status</label>
		<select name="status" class="form-control">
			<option value="verified">Verified</option>
			<option value="unverified">Unverified</option>
		</select>
	</div>
</div>

<div class="col-md-4">
	<div class="form-group">
		<label>Foto panti </label>
		<input type="file" name="foto" class="form-control" placeholder="foto" 
		value="<?php echo set_value('foto')?>">
	</div>
	
	<div class="form-group">
		<label>Keterangan</label>
		<input type="text" name="keterangan_panti" class="form-control" placeholder="Keterangan" 
		value="<?php echo set_value('keterangan_panti')?>">
	</div>

	<div class="form-group">
		<label>Nama Kegiatan</label>
		<input type="text" name="nama_kegiatan_panti" class="form-control" placeholder="Nama Kegiatan" 
		value="<?php echo set_value('nama_kegiatan_panti')?>">
	</div>
	
	<div class="form-group">
		<label>Foto kegiatan </label>
		<input type="file" name="foto_kegiatan_panti" class="form-control" placeholder="Foto Kegiatan" 
		value="<?php echo set_value('foto_kegiatan_panti')?>">
	</div>

	<div class="form-group">
		<label>Deskripsi kegiatan</label>
		<input type="text" name="deskripsi_kegiatan_panti" class="form-control" placeholder="Deskripsi kegiatan" 
		value="<?php echo set_value('deskripsi_kegiatan_panti')?>">
	</div>
</div>

<div class="col-md-12 text-center">
	<div class="form-group">
		<input type="submit" name="submit" class="btn btn-success btn-md" value="Simpan data">
		<input type="reset" name="reset" class="btn btn-default btn-md" value="Reset">
	</div>
</div>