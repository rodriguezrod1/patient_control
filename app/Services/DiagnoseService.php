<?php

namespace App\Services;

use App\Models\Diagnose;
use Illuminate\Http\Request;

class DiagnoseService
{

    /**
     * List all Diagnoses.
     *
     * @return mixed
     */
    public function listAll()
    {
        return Diagnose::all();
    }


    /**
     * Create a new Diagnose.
     * @return Diagnose
     */
    public function create(Request $request): Diagnose
    {
        return Diagnose::create($request->all());
    }


    /**
     * Update a Diagnose's details.
     *
     * @param Diagnose $diagnose
     * @return Diagnose
     */
    public function update(Request $request, Diagnose $diagnose): Diagnose
    {
        $diagnose->update($request->all());
        return $diagnose;
    }
}
