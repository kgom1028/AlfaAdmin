<div class="sidebar-menu">
		<header class="logo-env" >

            <!-- logo -->
			<div class="logo" style="">
				<a href="<?php echo base_url();?>">
					<img src="uploads/logo.png"  style="max-height:60px;"/>
				</a>
			</div>

			<!-- logo collapse icon -->
			<div class="sidebar-collapse" style="">
				<a href="#" class="sidebar-collapse-icon with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>

			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>

		<div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


           <!-- DASHBOARD -->
           <li class="<?php if($page_name == 'dashboard')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/dashboard">
					<i class="entypo-home"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
           </li>

           <li class="<?php if($page_name == 'manager_country')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/manage_country">
					<i class="entypo-location"></i>
					<span><?php echo get_phrase('Countries');?></span>
				</a>
           </li>
           <li class="<?php if($page_name == 'manager_transfer_rate')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/manage_transfer_rate">
					<i class="entypo-location"></i>
					<span><?php echo get_phrase('Transfer_Rate');?></span>
				</a>
           </li>
           <li class="<?php if($page_name == 'manager_user')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/manage_user">
					<i class="entypo-location"></i>
					<span><?php echo get_phrase('Users');?></span>
				</a>
           </li>

           <li class="<?php if($page_name == 'manager_contact')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/manage_contact">
					<i class="entypo-lock"></i>
					<span><?php echo get_phrase('contact');?></span>
				</a>
           </li>
    			<!-- ACCOUNT -->
           <li class="<?php if($page_name == 'manage_profile')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/manage_profile">
					<i class="entypo-lock"></i>
					<span><?php echo get_phrase('my_profile');?></span>
				</a>
           </li>

		</ul>

</div>
