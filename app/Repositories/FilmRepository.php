<?php

namespace App\Repositories;

use App\Models\Film;
use App\Interfaces\FilmRepoistoryInterface;

class FilmRepository implements FilmRepoistoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index()
    {
        return Film::all();
    }

    public function getById($id)
    {
        return Film::findOrFail($id);
    }

    public function store(array $data)
    {
        return Film::create($data);
    }

    public function update(array $data, $id)
    {
        return FIlm::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Film::destroy($id);
    }
}
