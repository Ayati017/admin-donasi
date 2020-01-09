<?php 
//notifikasi
if ($this->session->flashdata('sukses')) {
	echo '<div class="alert alert-success"><i class="fa fa-check"></i> ';
	echo $this->session->flashdata('sukses');
	echo '</div>';
}
?>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama - Level</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php  $i = 1; foreach($user as $user) { ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $user->nama_donatur ?> - <?php echo $user->akses_level ?></td>
            <td><?php echo $user->email_donatur ?></td>
            <td><?php echo $user->alamat_donatur ?></td>
            <td><?php echo $user->telp_donatur ?></td>
            <td><?php echo $user->status?></td>

            <td>
            	<a href="<?php echo base_url('admin/user/edit/'.$user->id_donatur) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                <a href="<?php echo base_url('admin/user/aktif/'.$user->id_donatur) ?>" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Aktif</a>
                <a href="<?php echo base_url('admin/user/tidak/'.$user->id_donatur) ?>" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Tidak</a>

            	<?php include('delete.php'); ?>
            </td>
        </tr>
    <?php $i++; } ?>
    </tbody>
</table>
