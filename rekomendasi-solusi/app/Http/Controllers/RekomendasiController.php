<?php

namespace App\Http\Controllers;

use App\Models\KasusIt;
use App\Services\SolutionRecommender;
use App\Services\TextPreprocessor;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index()
    {
        return view('rekomendasi', ['hasil' => null, 'input' => '']);
    }

    public function cari(Request $request, SolutionRecommender $recommender)
    {
        $request->validate(['kasus' => 'required|string|min:5']);

        return view('rekomendasi', [
            'hasil' => $recommender->recommend($request->kasus, 3),
            'input' => $request->kasus,
        ]);
    }

    public function create()
    {
        return view('kasus-create');
    }

    public function store(Request $request, TextPreprocessor $pre)
    {
        $data = $request->validate([
            'user_id' => 'required|string|max:50',
            'kasus'   => 'required|string',
            'solusi'  => 'required|string',
        ]);

        $data['kasus_olahan'] = $pre->process($data['kasus']);
        KasusIt::create($data);

        return redirect('/')->with('sukses', 'Kasus berhasil disimpan ke basis pengetahuan.');
    }
}