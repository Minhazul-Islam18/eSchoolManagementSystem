<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = Menu::updateOrCreate(['name' => 'topbar-menu', 'description' => 'This is backend topbar-menu', 'is_deletable' => false]);

        // MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'divider', 'parent_id' => null, 'order' => 1, 'title' => 'Menus']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 2, 'title' => 'Dashboard', 'url' => "/app/dashboard", 'icon' => 'layout-dashboard']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 3, 'title' => 'Pages', 'url' => "/app/pages", 'icon' => 'layers']);

        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'divider', 'parent_id' => null, 'order' => 4, 'title' => 'Access Control']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 5, 'title' => 'Roles', 'url' => "/app/roles", 'icon' => 'badge-check']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 6, 'title' => 'Users', 'url' => "/app/users", 'icon' => 'users']);

        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'divider', 'parent_id' => null, 'order' => 7, 'title' => 'System']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 8, 'title' => 'Menus', 'url' => "/app/menus", 'icon' => 'menu-square']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 9, 'title' => 'Backups', 'url' => "/app/backups", 'icon' => 'folder-sync']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'type' => 'item', 'parent_id' => null, 'order' => 10, 'title' => 'Settings', 'url' => "/app/settings/general", 'icon' => 'cog']);
    }
}
