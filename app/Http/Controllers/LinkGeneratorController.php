<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LinkGeneratorController extends Controller
{
    public function create(){
        return view('pages.link-generate.create');
    }

    public function index(Request$request){
        if($request->ajax()){
            $urls = Url::query();
            return DataTables::of($urls)
                ->addColumn('action', function ($row){
                    $html = "<ul><a href='".url('url-link/delete')."'>Delete</a></ul>";
                    return $html;
                })
                ->make();
        }
        return view('pages.link-generate.list');
    }

    public function store(Request $request){
        $this->validate($request, [
            'urls' => 'required | url'
        ]);
        $urls = $request->urls;
        $parse_url = parse_url($urls);
        DB::beginTransaction();
        $domain_info = Domain::firstOrCreate([
            'domain_name' => $parse_url['host']
        ]);
        if($domain_info){
            $new_url = new Url();
            $new_url->domain_id = $domain_info->id;
            $new_url->full_url = $urls;
            $new_url->save();
            DB::commit();
         }
         DB::rollBack();
        return redirect()->route('url-link.list');
    }
}
