<?php

namespace App\Interfaces;

use App\Models\Film;

interface FilmRepoistoryInterface
{
    public function index();
    public function getById($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
