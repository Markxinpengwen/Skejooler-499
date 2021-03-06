<?php

/**
 * Author: Barrett Sharpe
 */

use Illuminate\Database\Seeder;

use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use Dwij\Laraadmin\Models\ModuleFieldTypes;
use Dwij\Laraadmin\Models\Menu;
use Dwij\Laraadmin\Models\LAConfigs;

//Used by LA
use App\Role;
use App\Permission;
use App\Models\Department;

include 'database\seeds\InstitutionsTableSeederLA.php';

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeder.
	 * @return void
	 */
	public function run()
	{
        //Skip Input: Bypass LaraAdmin Standard Seeder Code.
        $skip=false;
        echo "\nSkip Standard LA Seeder Code? (y/n):";
        $fp = fopen("php://stdin","r");
        $input = rtrim(fgets($fp, 1024));
		if($input=="y" || $input=="Y"){
		    $skip=true;
		    echo "Skipping LA Seeder Code.\n";
        }

		//Skip
        if(!$skip) {
            echo "DatabaseSeeder] Running Standard LaraAdmin Seeder Code...\n";

            /* ================ LaraAdmin Seeder Code ================ */

            // Generating Module Menus
            $modules = Module::all();
            $teamMenu = Menu::create([
                "name" => "Team",
                "url" => "#",
                "icon" => "fa-group",
                "type" => 'custom',
                "parent" => 0,
                "hierarchy" => 1
            ]);
            foreach ($modules as $module) {
                $parent = 0;
                if ($module->name != "Backups") {
                    if (in_array($module->name, ["Users", "Departments", "Employees", "Roles", "Permissions"])) {
                        $parent = $teamMenu->id;
                    }
                    Menu::create([
                        "name" => $module->name,
                        "url" => $module->name_db,
                        "icon" => $module->fa_icon,
                        "type" => 'module',
                        "parent" => $parent
                    ]);
                }
            }

            // Create Administration Department
            $dept = new Department;
            $dept->name = "Administration";
            $dept->tags = "[]";
            $dept->color = "#000";
            $dept->save();

            // Create Super Admin Role
            $role = new Role;
            $role->name = "SUPER_ADMIN";
            $role->display_name = "Super Admin";
            $role->description = "Full Access Role";
            $role->parent = 1;
            $role->dept = $dept->id;
            $role->save();

            // Set Full Access For Super Admin Role
            foreach ($modules as $module) {
                Module::setDefaultRoleAccess($module->id, $role->id, "full");
            }

            // Create Admin Panel Permission
            $perm = new Permission;
            $perm->name = "ADMIN_PANEL";
            $perm->display_name = "Admin Panel";
            $perm->description = "Admin Panel Permission";
            $perm->save();

            $role->attachPermission($perm);

            // Generate LaraAdmin Default Configurations

            $laconfig = new LAConfigs;
            $laconfig->key = "sitename";
            $laconfig->value = "Skejooler";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "sitename_part1";
            $laconfig->value = "Skejooler";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "sitename_part2";
            $laconfig->value = "";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "sitename_short";
            $laconfig->value = "SJ";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "site_description";
            $laconfig->value = "";
            $laconfig->save();

            // Display Configurations

            $laconfig = new LAConfigs;
            $laconfig->key = "sidebar_search";
            $laconfig->value = "1";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "show_messages";
            $laconfig->value = "1";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "show_notifications";
            $laconfig->value = "1";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "show_tasks";
            $laconfig->value = "1";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "show_rightsidebar";
            $laconfig->value = "1";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "skin";
            $laconfig->value = "skin-white";
            $laconfig->save();

            $laconfig = new LAConfigs;
            $laconfig->key = "layout";
            $laconfig->value = "fixed";
            $laconfig->save();

            // Admin Configurations

            $laconfig = new LAConfigs;
            $laconfig->key = "default_email";
            $laconfig->value = "test@example.com";
            $laconfig->save();

            $modules = Module::all();
            foreach ($modules as $module) {
                $module->is_gen = true;
                $module->save();
            }

        }//Skip

		echo "DatabaseSeeder] \t- Completed\n";
		
		/* ======*=====*===== Custom Seeder Code for Skejooler ====*====*====*==== */
		
		echo "DatabaseSeeder] Running Custom Seeder Code for Skejooler...\n";
		
		//Call Institution Seeder:
		echo "DatabaseSeeder] \tInstitution Seeder\n";
		$this->call(InstitutionsTableSeederLA::class);
		echo "DatabaseSeeder] \t\t- Complete\n";
		
		//Call Giant Seeder:
		echo "DatabaseSeeder] \tGiant Seeder\n";
		$this->call(GiantTableSeederLA::class);
		echo "DatabaseSeeder] \t\t- Complete\n";
		
		//Call (New Static) Request Seeder:
		echo "DatabaseSeeder] \tRequest Seeder\n";
		//$this->call(RequestsTableSeederLA::class);
		$this->call(StaticRequestsTableSeederLA::class);
		echo "DatabaseSeeder] \t\t- Complete\n";

		//End Run Mehtod
		echo "\nDatabaseSeeder] End of Database Seeding.\n";
	} //run

}
