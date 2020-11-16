<?php

namespace App\Http\Controllers;

use App\components\Recusive;
use App\Models\Menu;
use App\Traits\DeleteItemModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    use DeleteItemModelTrait;
    private $menu;

    function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    function getMenu($parentId)
    {
        $data = $this->menu->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->recursive($parentId);
        return $htmlOption;
    }

    function index()
    {
        $menus = $this->menu->latest()->simplePaginate(10);
        return view("admin.menu.index", compact('menus'));
    }

    function create()
    {
        $htmlOption = $this->getMenu($parentId = '');
        return view("admin.menu.create", compact('htmlOption'));
    }

    function createSubmit(Request $request)
    {
        $data = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ];
        $this->menu->create($data);
        return redirect()->route('menus.index');
    }

    function edit($id)
    {
        $menu = $this->menu->find($id);
        $htmlOption = $this->getMenu($menu->parent_id);
        return view('admin.menu.edit', compact('menu', 'htmlOption'));
    }

    function update(Request $request, $id)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate([
            'name' => ['required'],
            'parent_id' => ['required'],
            'slug' => ['required']
        ]);
        $this->menu->find($id)->update($data);
        return redirect()->route('menus.index');
    }

    function delete($id)
    {
        return $this->deleteItemTrait($id, $this->menu);
    }
}
