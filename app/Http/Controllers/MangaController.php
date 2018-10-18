<?php
namespace App\Http\Controllers;

use App\Http\Repositories\MangaRepository;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public $mangaRepository;

    public function __construct(MangaRepository $mangaRepository)
    {
        $this->mangaRepository = $mangaRepository;
    }

    public function getMangas()
    {
        return $this->mangaRepository->getMangas();
    }

    public function getManga($id)
    {
        return $this->mangaRepository->getManga($id);
    }

    public function postManga(Request $request)
    {
        return $this->mangaRepository->postManga($request);
    }

    public function patchManga(Request $request,$id)
    {
        return $this->mangaRepository->patchManga($request,$id);
    }
}
