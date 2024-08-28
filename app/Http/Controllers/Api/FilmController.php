<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\{
    StoreFilmRequest,
    UpdateFilmRequest,
};
use App\Interfaces\FilmRepoistoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\FilmResource;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{
    private FilmRepoistoryInterface $filmRepositoryInterface;

    public function __construct(FilmRepoistoryInterface $filmRepositoryInterface)
    {
        $this->filmRepositoryInterface = $filmRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->filmRepositoryInterface->index();
        return ApiResponseClass::sendResponse(FilmResource::collection($data), '', 200);
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
    public function store(StoreFilmRequest $request)
    {
        $posterPath = $request->file('poster')->store('images');

        $data = [
            'title' => $request->title,
            'sinopsis' => $request->sinopsis,
            // 'poster' => 'storage/images/m7.jpg',
            'poster' => $posterPath,
            'year' => $request->year,
            'genre_id' => $request->genre_id,
        ];

        DB::beginTransaction();

        try {
            $film = $this->filmRepositoryInterface->store($data);

            DB::commit();
            return ApiResponseClass::sendResponse(new FilmResource($film), 'Film Create Successful', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = $this->filmRepositoryInterface->getById($id);
        return ApiResponseClass::sendResponse(new FilmResource($film), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, $id)
    {
        $posterPath = $request->file('poster')->store('storage/images');

        $updateData = [
            'title' => $request->title,
            'sinopsis' => $request->sinopsis,
            'poster' => $posterPath,
            'year' => $request->year,
            'genre_id' => $request->genre_id,
        ];

        DB::beginTransaction();
        try {
            $film = $this->filmRepositoryInterface->update($updateData, $id);

            DB::commit();
            return ApiResponseClass::sendResponse('Film Update Successful', '', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->filmRepositoryInterface->delete($id);
        return ApiResponseClass::sendResponse('Film Delete Successful', 204);
    }
}
