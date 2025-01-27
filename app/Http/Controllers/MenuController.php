<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\JenisMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get posts
         $menu = Menu::latest()->paginate(5);
         $jenismenu = JenisMenu::latest()->paginate(5);

         //return collection of posts as a resource
         return new PostResource(true, 'List Data Posts', $menu, $jenismenu);

        // $data = Menu::all();
        // $jenismenu = JenisMenu::all();
        // return view('menu.menu', compact('data','jenismenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'gambar' => 'required',
            'kode_menu' => 'required',
            'nama_menu' => 'required',
            'jenis_menu_id' => 'required',
            'deskripsi' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
        ]);
        $data = Menu::create($request->all());

        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('imageagenda/', $request->file('gambar')->getClientOriginalName());
            $data->gambar = $request->file('gambar')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Menu::find($id);
        
        $data->update($request->all());
        
        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('imageagenda/', $request->file('gambar')->getClientOriginalName());
            $data->gambar = $request->file('gambar')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Menu::find($id);
        $data->delete();
        return redirect()->route('menu.index');
    }
}
