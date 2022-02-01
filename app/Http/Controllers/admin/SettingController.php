<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function index_menu()
    {
        $data = Menu::all();
        return view('admin.setting.menu', compact('data'));
    }

    function store_menu(Request $request)
    {
        $menu = new Menu();
        $menu->nama = $request->nama;
        $menu->icons = $request->icons;
        $menu->url = $request->url;
        $menu->ordering = $request->ordering;
        $menu->save();

        // return redirect()->route('menu.index')->with(['msg' => 'Data Berhasil Disimpan']);
        return response()->json(['msg' => 'Data Berhasil Disimpan']);
    }

    function update_menu(Request $request)
    {

    }

    function delete_menu($id)
    {
        return Menu::find($id)->delete($id);
    }

    // submenu
    function index_submenu()
    {
        return view('admin.setting.submenu');
    }

    // roles
    function index_role()
    {
        return view('admin.setting.role');
    }
}
