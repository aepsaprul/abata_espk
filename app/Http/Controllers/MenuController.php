<?php

namespace App\Http\Controllers;

use App\Models\EspkMenuButton;
use App\Models\EspkMenuSub;
use App\Models\EspkMenuUtama;
use App\Models\EspkNavMain;
use App\Models\EspkNavSub;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $nav_main = EspkNavMain::get();
        $nav_sub = EspkNavSub::orderBy('main_id', 'asc')->get();

        return view('pages.admin.menu.index', ['nav_mains' => $nav_main, 'nav_subs' => $nav_sub]);
    }

    public function mainStore(Request $request)
    {
        $nav_main = new EspkNavMain;
        $nav_main->title = $request->title;
        $nav_main->link = $request->link;
        $nav_main->icon = $request->icon;
        $nav_main->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function subCreate()
    {
        $nav_main = EspkNavMain::get();

        return response()->json([
            'nav_mains' => $nav_main
        ]);
    }

    public function subStore(Request $request)
    {
        $nav_sub = new EspkNavSub;
        $nav_sub->title = $request->title;
        $nav_sub->link = $request->link;
        $nav_sub->main_id = $request->main_id;
        $nav_sub->save();

        return response()->json([
            'status' => 'Data menu sub berhasil ditambah'
        ]);
    }

    public function mainEdit($id)
    {
        $nav_main = EspkNavMain::find($id);

        return response()->json([
            'id' => $nav_main->id,
            'title' => $nav_main->title,
            'link' => $nav_main->link,
            'icon' => $nav_main->icon
        ]);
    }

    public function subEdit($id)
    {
        $nav_sub = EspkNavSub::find($id);
        $nav_main = EspkNavMain::get();

        return response()->json([
            'id' => $nav_sub->id,
            'title' => $nav_sub->title,
            'link' => $nav_sub->link,
            'main_id' => $nav_sub->main_id,
            'nav_mains' => $nav_main
        ]);
    }

    public function mainUpdate(Request $request)
    {
        $nav_main = EspkNavMain::find($request->id);
        $nav_main->title = $request->title;
        $nav_main->link = $request->link;
        $nav_main->icon = $request->icon;
        $nav_main->save();

        return response()->json([
            'id' => $request->id,
            'status' => 'true',
            'title' => $request->title,
            'link' => $request->link,
            'icon' => $request->icon
        ]);
    }

    public function subUpdate(Request $request)
    {
        $nav_sub = EspkNavSub::find($request->id);
        $nav_sub->title = $request->title;
        $nav_sub->link = $request->link;
        $nav_sub->main_id = $request->main_id;
        $nav_sub->save();

        $nav_main = EspkNavMain::find($request->main_id);


        return response()->json([
            'id' => $request->id,
            'status' => 'Data menu sub berhasil diperbaharui',
            'title' => $request->title,
            'link' => $request->link,
            'main_title' => $nav_main->title
        ]);
    }

    public function mainDeleteBtn($id)
    {
        $nav_main = EspkNavMain::find($id);

        return response()->json([
            'id' => $nav_main->id,
            'title' => $nav_main->title
        ]);
    }

    public function mainDelete(Request $request)
    {
        $nav_main = EspkNavMain::find($request->id);

        $nav_sub = EspkNavSub::where('main_id', $request->id)->first();

        if ($nav_sub) {
            $status = "false";
        } else {
            $nav_main->delete();

            $status = "true";
        }

        return response()->json([
            'status' => $status,
            'title' => $nav_main->title
        ]);
    }

    public function subDeleteBtn($id)
    {
        $nav_sub = EspkNavSub::find($id);

        return response()->json([
            'id' => $nav_sub->id,
            'title' => $nav_sub->title
        ]);
    }

    public function subDelete(Request $request)
    {
        $nav_sub = EspkNavSub::find($request->id);
        $nav_sub->delete();

        return response()->json([
            'status' => 'Data berhasil dihapus'
        ]);
    }
}
