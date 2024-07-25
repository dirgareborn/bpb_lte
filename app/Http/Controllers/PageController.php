<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use App\Models\Employee;
use App\Models\Category;
use App\Models\Job;
class PageController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        // dd($categories);
        return view('welcome', compact('categories'));
    }

    public function visimisi()
    {

        $visimisi = Profile::first();
        // dd($visimisi);
        $page_title       = 'Hubungi Kami';
        $page_description = 'Deskripsi';

        return view('pages.web.visi-misi', compact(['page_title', 'page_description', 'visimisi']));
    }
    public function kontak()
    {

        $kontak = Profile::first();
        // dd($visimisi);
        $page_title       = 'Hubungi Kami';
        $page_description = 'Deskripsi';

        return view('pages.web.contact', compact(['page_title', 'page_description', 'kontak']));
    }
    
    public function team()
    {

        $teams = Employee::with('jobs')->where('status',1)->orderBy('job_id', 'ASC')->get();
        $page_title       = 'Team BPB';
        $page_description = 'Deskripsi';

        return view('pages.web.team', compact(['page_title', 'page_description', 'teams']));
    }

    public function strukturOrganisasi()
    {

        $strukturorganisasi = Profile::first();
        // dd($visimisi);
        $page_title       = 'Struktur Organisasi';
        $page_description = 'Staff BLU UNM sesuai SK
Rektor Universitas Negeri
Makassar Nomor
08/UN36/HK/2021 tanggal
11 Januari 2021 dan
Struktur BPB BLU UNM
sesuai SK Rektor Universitas
Negeri Makassar nomor
309/UN.36/HK/2022
tanggal 23 Februari 2022';

        return view('pages.web.struktur-organisasi', compact(['page_title', 'page_description', 'strukturorganisasi']));
    }
}
