<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    /**
     * Exibe uma lista dos vídeos.
     * TODO: Refinar a lógica para mostrar apenas vídeos associados a conteúdos públicos.
     */
    public function index(): View
    {
        // Busca todos os vídeos, ordenados talvez pelos mais recentes
        // Cuidado: Isso pode expor vídeos de conteúdos não-públicos.
        // Uma abordagem melhor seria buscar códigos/soluções públicas e seus vídeos.
        $videos = Video::orderBy('created_at', 'desc')->paginate(15);

        // Retorna a view da listagem pública (precisará ser criada)
        return view('public.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
