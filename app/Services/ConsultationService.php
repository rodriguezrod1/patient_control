<?php

namespace App\Services;

use App\Models\Consultation;
use Illuminate\Http\Request;


class ConsultationService
{

    /**
     * List all Consultation.
     *
     * @return mixed
     */
    public function listAll()
    {
        return  Consultation::with(['zone', 'user'])->get();
    }


    /**
     * List all consultation of zona.
     * @param int $id_zone
     * @return mixed
     */
    public function listAllByZoneId(int $id_zone)
    {
        return Consultation::with(['zone', 'user'])->where('zone_id', $id_zone)->get();
    }


    /**
     * Create a new Consultation.
     * @return Consultation
     */
    public function create(Request $request): Consultation
    {
        return Consultation::create($request->validated());
    }


    /**
     * Update a Consultation's details.
     *
     * @param Consultation $consultation
     * @return Consultation
     */
    public function update(Request $request, Consultation $consultation): Consultation
    {
        $consultation->update($request->validated());
        return $consultation;
    }


    /**
     * Delete a Consultation.
     *
     * @param Consultation $consultation
     * @return bool
     */
    public function delete(Consultation $consultation): bool
    {
        return $consultation->delete();
    }
}
