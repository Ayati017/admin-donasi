<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <!--- Dasbor --->
		
            <li>
                <a  href="<?php echo base_url('admin/dasbor') ?>"><i class="fa fa-dashboard "></i> Dashboard</a>
            </li>

            <!------- Menu Panti sosial----->  
            <li>
                <a href="#"><i class="fa fa-home"></i> Panti Sosial<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url('admin/panti') ?>">Data Panti</a></li>
                    <li><a href="<?php echo base_url('admin/panti/tambah') ?>">Tambah</a></li>
                </ul>
            </li>

            <!------- Menu donasi-----> 
            <li>
                <a href="#"><i class="fa fa-money"></i> Donasi</a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url('admin/donasi') ?>">Data Donasi</a></li>
                </ul>
            </li>


            <!------- Menu User----->
			<?php 
			$akses_level = $this->session->userdata('akses_level');
			if($akses_level == "super admin"){
			?>
            <li>
                <a href="#"><i class="fa fa-user "></i> User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url('admin/user') ?>">Data User</a></li>
                </ul>
            </li>
			<?php 
			}
			?>
            </ul>
          </li>  
	
        </ul>
       
    </div>
    
</nav>  
<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2><?php echo $title ?></h2>   
                
               
            </div>
        </div>
         <!-- /. ROW  -->
         <hr />
       
    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <?php echo $title ?>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
