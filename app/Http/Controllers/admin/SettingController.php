<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Menu;
use App\Models\User;
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

    function get_data_role()
    {
        try {
            $role = Divisi::all();

            return datatables()->of($role)
                ->addIndexColumn()
                ->addColumn('nama', function($d) {
                    return $d->nama;
                })
                ->addColumn('aksi', function($d) {
                    return '
                    <button class="btn btn-outline-secondary btn-sm" id="btnUser" data-id="'.$d->id.'"><i class="fas fa-user"> User</i></button>
                    <button class="btn btn-outline-info btn-sm" id="btnDetail" data-id="'.$d->id.'"><i class="fas fa-eye"> Detail</i></button>
                    <button class="btn btn-outline-success btn-sm" id="btnEdit" data-id="'.$d->id.'"><i class="fas fa-edit"> Edit</i></button>
                    <button class="btn btn-outline-danger btn-sm" id="btnDelete" data-id="'.$d->id.'"><i class="fas fa-trash"> Delete</i></button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function create_data_role(Request $request)
    {
        try {
            if (isset($request->id)) {
                $role = Divisi::find($request->id);
                $role->id = $request->id;
                $role->nama = $request->nama;
                $role->kode = $request->kode;
            } else {
                $role = new Divisi();

                $role->nama = $request->nama;
                $role->kode = $request->kode;
            } 

            if ($role->save()) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditambahkan',
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data gagal ditambahkan',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function show_data_role(Request $request)
    {
        try {
            $data = Divisi::find($request->id);

            if (isset($data)) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditemukan',
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data gagal ditemukan',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function delete_data_role(Request $request)
    {
        try {
            $data = Divisi::find($request->id);

            if (isset($data)) {
                $data->delete();
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditemukan',
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data gagal ditemukan',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    // users
    function index_users()
    {
        return view('admin.setting.users');
    }

    function get_data_user(Request $request)
    {
        try {
            $user = User::where('divisi_id', $request->id)->get();

            return datatables()->of($user)
                ->addIndexColumn()
                ->addColumn('username', function($d) {
                    return $d->username;
                })
                ->addColumn('nama', function($d) {
                    return $d->nama;
                })
                ->addColumn('aksi', function($d) {
                    return '
                    <button class="btn btn-outline-info btn-sm" id="btnDetail" data-id="'.$d->id.'"><i class="fas fa-eye"> Detail</i></button>
                    <button class="btn btn-outline-success btn-sm" id="btnEdit" data-id="'.$d->id.'"><i class="fas fa-edit"> Edit</i></button>
                    <button class="btn btn-outline-danger btn-sm" id="btnDelete" data-id="'.$d->id.'"><i class="fas fa-trash"> Delete</i></button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function create_data_user(Request $request)
    {
        try {
            if (isset($request->id)) {
                $user = User::find($request->id);
                
                $user->id = $request->id;
                $user->divisi_id = $request->divisi_id;
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->nama = $request->nama;
                $user->email = $request->email;
            } else {
                $user = new User();
                $user->divisi_id = $request->divisi_id;
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->nama = $request->nama;
                $user->email = $request->email;
            }

            if ($user->save()) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditambahkan',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data gagal ditambahkan',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function show_data_user(Request $request)
    {
        try {
            $user = User::find($request->id);
            if (isset($user)) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditemukan',
                    'data' => $user,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data gagal ditemukan',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function delete_data_user(Request $request)
    {
        try {
            $user = User::find($request->id);

            if (isset($user)) {
                $user->delete();
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data gagal dihapus',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
