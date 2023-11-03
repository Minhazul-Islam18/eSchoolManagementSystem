<?php

namespace App\Livewire\Backend;

use App\Models\Menu;
use Livewire\Component;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MenuBuilder extends Component
{
    use LivewireAlert;
    #[Title('Menu Builder')]
    public $menu;
    public $menu_item_type;
    public $divider_title;
    public $menu_item_name;
    public $menu_item_url;
    public $menu_item_icon;
    public $where_to_open;
    public $editable_menu_item = null;
    public $openCEmodal = false;
    public $selectedType = null;
    public function storeItem()
    {
        Gate::authorize('app.menus.create');
        $this->validate([
            'menu_item_type' => 'required'
        ]);
        $this->menu->menuItems()->create([
            'type' => $this->menu_item_type,
            'title' => $this->menu_item_name ?? $this->divider_title,
            'url' => $this->menu_item_url,
            'icon' => $this->menu_item_icon,
            'target' => $this->where_to_open ? '_blank' : '_self',
        ]);
        $this->alert('success', 'Menu Item Created');
        $this->resetFields();
        $this->dispatch('reload');
    }
    public function editItem(MenuItem $menuItem)
    {
        Gate::authorize('app.menus.edit');
        $this->menu_item_type = $menuItem->type;
        $this->selectedType = $menuItem->type;
        $this->divider_title = $menuItem->type == 'divider' ? $menuItem->title : null;
        $this->menu_item_name =  $menuItem->type == 'item' ? $menuItem->title : null;
        $this->menu_item_url = $menuItem->url;
        $this->menu_item_icon = $menuItem->icon;
        $this->where_to_open = $menuItem->type == '_self' ? false : true;
        $this->editable_menu_item = $menuItem;
    }
    public function updateItem()
    {
        Gate::authorize('app.menus.edit');
        $this->validate([
            'menu_item_type' => 'required'
        ]);
        $this->editable_menu_item = MenuItem::findOrFail($this->editable_menu_item->id);
        $this->editable_menu_item->update([
            'type' => $this->menu_item_type,
            'title' => $this->menu_item_name ?? $this->divider_title,
            'url' => $this->menu_item_url,
            'icon' => $this->menu_item_icon,
            'target' => $this->where_to_open ? '_blank' : '_self',
        ]);
        $this->alert('success', 'Menu Item Updated');
        $this->resetFields();
        $this->dispatch('reload');
    }
    public function destroyItem(MenuItem $menuItem)
    {
        Gate::authorize('app.menus.destroy');
        $menuItem->delete();
    }
    public function updateOrder(Request $request, $id)
    {
        Gate::authorize('app.menus.edit');
        $menu = Menu::findOrFail($id);
        $this->menu = $menu;
        $menuItemsWithUpdatedOrder = json_decode($request->order);

        $this->storeAsUpdatedOrder($menuItemsWithUpdatedOrder, null);
    }
    public function storeAsUpdatedOrder(array $menuItems, $parentID)
    {
        Gate::authorize('app.menus.edit');
        foreach ($menuItems as $key => $item) {
            $menuItem = MenuItem::findOrFail($item->id);
            $menuItem->update([
                'order' => $key + 1,
                'parent_id' => $parentID
            ]);
            if (isset($item->children)) {
                $this->storeAsUpdatedOrder($item->children, $menuItem->id);
            }
            $this->alert('success', 'Re-Ordered');
        }
    }
    public function resetFields()
    {
        $this->menu_item_type = null;
        $this->selectedType = null;
        $this->divider_title = null;
        $this->menu_item_name =  null;
        $this->menu_item_url = null;
        $this->menu_item_icon = null;
        $this->where_to_open = null;
        $this->editable_menu_item = null;
        $this->dispatch('closeModal');
        $this->openCEmodal = false;
    }
    public function mount($id)
    {
        Gate::authorize('app.menus.index');
        Gate::authorize('app.menus.index');
        $menu = Menu::findOrFail($id);
        $this->menu = $menu;
    }
    public function render()
    {
        return view('livewire.backend.menu-builder');
    }
}
