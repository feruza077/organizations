<?php

namespace App\Repositories;

use App\Models\Organization;

class OrganizationRepository
{

    public function inBuilding($buildingId)
    {
        return Organization::select('id', 'name', 'phone_numbers', 'building_id')
            ->where('building_id', $buildingId)
            ->paginate();
    }

    public function byActivity($activityId)
    {
        return Organization::select('organizations.id', 'name', 'phone_numbers')
            ->join('organization_activities', 'organizations.id', '=',  'organization_activities.organization_id')
            ->where('organization_activities.activity_id', $activityId)
            ->paginate();
    }

    public function inRadius(array $request)
    {
        return Organization::select('organizations.*')->whereRaw(
            'ST_DWithin(coordinates, ST_SetSRID(ST_MakePoint(?, ?), 4326), ?)',
            [$request['longitude'], $request['latitude'], $request['radius']]
        )
            ->join('buildings', 'organizations.building_id', '=', 'buildings.id')
            ->paginate();
    }

    public function inBoundingBox(array $request)
    {
        return Organization::select('organizations.*', 'buildings.address')->whereRaw(
            'ST_Within(coordinates::geometry, ST_MakeEnvelope(?, ?, ?, ?, 4326))',
            [$request['minLongitude'], $request['minLatitude'], $request['maxLongitude'], $request['maxLatitude']]
        )
            ->join('buildings', 'organizations.building_id', '=', 'buildings.id')
            ->paginate();
    }

    public function show($organizationId)
    {
        return Organization::with(['building', 'activities:id,name,parent_id'])->findOrFail($organizationId);
    }

    public function search($request)
    {
        $query = Organization::select('id', 'name', 'phone_numbers');
        if ($request->filled('name')) {
            $query->where('name', 'ilike', "%$request->name%");
        }
        if ($request->filled('activity')) {
            $activityIds = ActivityRepository::getChildIds($request->activity);
            $query->join('organization_activities', 'organizations.id', '=',  'organization_activities.organization_id')
                ->whereIn('organization_activities.activity_id', $activityIds);
        }
        return $query->paginate();
    }
}
