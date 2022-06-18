<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => 'menu12', 
			'label' => 'Tenancy', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'availability_domains', 
			'label' => 'Availability Domains', 
			'icon' => ''
		),
		
		array(
			'path' => 'compartments', 
			'label' => 'Compartments', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'menu11', 
			'label' => 'Compute', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'compute', 
			'label' => 'List', 
			'icon' => ''
		),
		
		array(
			'path' => 'compute_boot_volumes', 
			'label' => 'Boot Volumes', 
			'icon' => ''
		),
		
		array(
			'path' => 'compute_boot_volume_backups', 
			'label' => 'Boot Volume Backups', 
			'icon' => ''
		),
		
		array(
			'path' => 'compute_block_volumes', 
			'label' => 'Block Volumes', 
			'icon' => ''
		),
		
		array(
			'path' => 'compute_block_volume_backups', 
			'label' => 'Block Volume Backups', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'menu7', 
			'label' => 'DB', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'db', 
			'label' => 'List', 
			'icon' => ''
		),
		
		array(
			'path' => 'db_backup', 
			'label' => 'Db Backup', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'menu6', 
			'label' => 'Settings', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'user', 
			'label' => 'Users', 
			'icon' => ''
		)
	)
		)
	);
		
	
	
			public static $report_receiver = array(
		array(
			"value" => "0", 
			"label" => "no", 
		),
		array(
			"value" => "1", 
			"label" => "yes", 
		),);
		
}