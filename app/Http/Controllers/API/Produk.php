<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GudangBarangJadi;
use App\Models\KelompokProduk;
use App\Models\MProduk;
use App\Models\Produk as ModelsProduk;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class Produk extends Controller
{
    function get_data_produk()
    {
        $data = MProduk::all();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('kode', function($d) {
                return $d->kode != null ? $d->kode : '-';
            })
            ->addColumn('nama', function($d) {
                return $d->nama;
            })
            ->addColumn('aksi', function($d) {
                return '<button class="btn btn-outline-info btn-sm" id="btnDetail" data-id="'.$d->id.'"><i class="fas fa-eye"> Detail</i></button>
                <button class="btn btn-outline-success btn-sm" id="btnEdit" data-id="'.$d->id.'"><i class="fas fa-edit"> Edit</i></button>
                <button class="btn btn-outline-danger btn-sm" id="btnDelete" data-id="'.$d->id.'"><i class="fas fa-trash"> Delete</i></button>';
            })
            ->rawColumns(['aksi'])
            ->escapeColumns()
            ->make(true);
    }

    function create_data_produk(Request $request)
    {
        try {
            if (isset($request->id)) {
                $produk = MProduk::find($request->id);

                $produk->id = $produk->id;
                $produk->kode = $request->kode;
                $produk->nama = $request->nama;
            } else {
                $produk = new MProduk();
            
                $produk->kode = $request->kode;
                $produk->nama = $request->nama;
            }

            // if (isset($request->nama)) {
            //     return response()->json([
            //         'success' => true,
            //         'msg' => 'Nama Produk Sudah Terdaftar',
            //     ]);
            // } elseif (isset($request->kode)) {
            //     return response()->json([
            //         'success' => true,
            //         'msg' => 'Kode Produk Sudah Terdaftar',
            //     ]);
            // } else {
                if ($produk->save()) {
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
            // }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function show_data_produk(Request $request)
    {
        try {
            $produk = MProduk::find($request->id);

            if (isset($produk)) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditermukan',
                    'data' => $produk,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data tidak ditemukan',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function delete_data_produk(Request $request)
    {
        try {
            $produk = MProduk::find($request->id);
        
            if (isset($produk)) {
                $produk->delete();
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

    function detail_data_produk(Request $request)
    {
        try {
            $produk = ModelsProduk::where('produk_id', $request->id)->get();
            return datatables()->of($produk)
                ->addIndexColumn()
                ->addColumn('kode', function($d) {
                    return $d->kode == null ? '-' : $d->kode;
                })
                ->addColumn('kelompok_produk', function($d) {
                    return $d->kelompok_produk_id == null ? '-' : '<span class="badge badge-warning">'.$d->kelompokproduk->nama.'</span>';
                })
                ->addColumn('no_akd', function($d) {
                    return $d->no_akd == null ? '-' : $d->no_akd;
                })
                ->addColumn('nama', function($d) {
                    return $d->nama;
                })
                ->addColumn('merk', function($d) {
                    return $d->merk;
                })
                ->addColumn('parent', function($d) {
                    return $d->produk->nama;
                })
                ->addColumn('aksi', function($d) {
                    return '
                    <button class="btn btn-outline-secondary btn-sm" id="btnVarian" data-id="'.$d->id.'"><i class="fas fa-ellipsis-v"> Varian</i></button>
                    <button class="btn btn-outline-info btn-sm" id="btnDetail" data-id="'.$d->id.'"><i class="fas fa-eye"> Detail</i></button>
                    <button class="btn btn-outline-success btn-sm" id="btnEdit" data-id="'.$d->id.'"><i class="fas fa-edit"> Edit</i></button>
                    <button class="btn btn-outline-danger btn-sm" id="btnDelete" data-id="'.$d->id.'"><i class="fas fa-trash"> Delete</i></button>';
                })
                ->rawColumns(['aksi', 'kelompok_produk'])
                ->escapeColumns()
                ->make(true);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    // sub produk
    function create_data_produk_sub(Request $request)
    {
        try {
            if(isset($request->id)) {
                $produk = ModelsProduk::find($request->id);
                $produk->id = $request->id;
                $produk->produk_id = $request->produk_id;
                $produk->kelompok_produk_id = $request->kelompok_produk_id;
                $produk->no_akd = strtoupper($request->no_akd);
                $produk->merk = strtoupper($request->merk);
                $produk->nama = strtoupper($request->nama);
                $produk->coo = $request->coo;
                $produk->kode = strtoupper($request->kode);
                $produk->nama_coo = strtoupper($request->nama_coo);
                $produk->status = 1;
            } else {
                $produk = new ModelsProduk();

                $produk->produk_id = $request->produk_id;
                $produk->kelompok_produk_id = $request->kelompok_produk_id;
                $produk->no_akd = strtoupper($request->no_akd);
                $produk->merk = strtoupper($request->merk);
                $produk->nama = strtoupper($request->nama);
                $produk->coo = $request->coo;
                $produk->kode = strtoupper($request->kode);
                $produk->nama_coo = strtoupper($request->nama_coo);
                $produk->status = 1;
            }

            if ($produk->save()) {
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
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    function show_data_produk_sub(Request $request)
    {
        try {
            $produk = ModelsProduk::find($request->id);

            if (isset($produk)) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditermukan',
                    'data' => $produk,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data tidak ditemukan',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function delete_data_produk_sub(Request $request)
    {
        try {
            $produk = ModelsProduk::find($request->id);
        
            if (isset($produk)) {
                $produk->delete();
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

    // kelompok produk
    function get_data_kategori()
    {
        try {
            $data = KelompokProduk::all();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('jenis', function($d) {
                    return $d->jenis_id == null ? '-' : '<span class="badge badge-warning">'.$d->jenis->nama.'</span>';
                })
                ->addColumn('nama', function($d){
                    return $d->nama;
                })
                ->addColumn('aksi', function($d) {
                    return '
                    <button class="btn btn-outline-info btn-sm" id="btnDetail" data-id="'.$d->id.'"><i class="fas fa-eye"> Detail</i></button>
                    <button class="btn btn-outline-success btn-sm" id="btnEdit" data-id="'.$d->id.'"><i class="fas fa-edit"> Edit</i></button>
                    <button class="btn btn-outline-danger btn-sm" id="btnDelete" data-id="'.$d->id.'"><i class="fas fa-trash"> Delete</i></button>';
                })
                ->rawColumns(['aksi', 'jenis'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function create_data_kategori(Request $request)
    {
        try {
            if(isset($request->id)) {
                $data = KelompokProduk::find($request->id);
                $data->id = $request->id;
                $data->jenis_id = $request->jenis_id;
                $data->nama = $request->nama;
            } else {
                $data = new KelompokProduk();

                $data->jenis_id = $request->jenis_id;
                $data->nama = $request->nama;
            }

            if ($data->save()) {
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

    function show_data_kategori(Request $request)
    {
        try {
            $produk = KelompokProduk::find($request->id);
        
            if (isset($produk)) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditemukan',
                    'data' => $produk,
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

    function delete_data_kategori(Request $request)
    {
        try {
            $produk = KelompokProduk::find($request->id);
        
            if (isset($produk)) {
                $produk->delete();
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

    // varian
    function get_data_varian(Request $request)
    {
        try {
            $data = GudangBarangJadi::where('produk_id', $request->id)->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('produk', function($d) {
                    return $d->nama == null ? $d->produk->nama : $d->produk->nama.' <b>'.$d->nama.'</b>';
                })
                ->addColumn('stok', function($d) {
                    return $d->stok.' '.$d->satuan->nama;
                })
                ->addColumn('parent', function($d) {
                    return $d->produk->nama;
                })
                ->addColumn('aksi', function($d) {
                    return '
                    <button class="btn btn-outline-secondary btn-sm" id="btnVarian" data-id="'.$d->id.'"><i class="fas fa-ellipsis-v"> Varian</i></button>
                    <button class="btn btn-outline-info btn-sm" id="btnDetail" data-id="'.$d->id.'"><i class="fas fa-eye"> Detail</i></button>
                    <button class="btn btn-outline-success btn-sm" id="btnEdit" data-id="'.$d->id.'"><i class="fas fa-edit"> Edit</i></button>
                    <button class="btn btn-outline-danger btn-sm" id="btnDelete" data-id="'.$d->id.'"><i class="fas fa-trash"> Delete</i></button>';
                })
                ->rawColumns(['aksi', 'produk'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function create_data_varian(Request $request)
    {
        try {
            if (isset($request->id)) {
                $produk = GudangBarangJadi::find($request->id);

                $produk->id = $request->id;
                $produk->produk_id = $request->produk_id;
                $produk->nama = strtoupper($request->nama);
                $produk->stok = $request->stok;
                $produk->satuan_id = $request->satuan_id;
            } else {
                $produk = new GudangBarangJadi();

                $produk->produk_id = $request->produk_id;
                $produk->nama = strtoupper($request->nama);
                $produk->stok = $request->stok;
                $produk->satuan_id = $request->satuan_id;
            }

            if ($produk->save()) {
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

    function show_data_varian(Request $request)
    {
        try {
            $produk = GudangBarangJadi::find($request->id);
        
            if (isset($produk)) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Data berhasil ditemukan',
                    'data' => $produk,
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

    function delete_data_varian(Request $request)
    {
        try {
            $produk = GudangBarangJadi::find($request->id);
        
            if (isset($produk)) {
                $produk->delete();
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
