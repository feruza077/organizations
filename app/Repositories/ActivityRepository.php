<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ActivityRepository
{
    public static function getChildIds($activityName)
    {

        $activities = DB::select("
        WITH RECURSIVE activity_hierarchy AS (
            SELECT id
            FROM activities
            WHERE name = :activityName
    
            UNION ALL
    
            SELECT a.id
            FROM activities a
            INNER JOIN activity_hierarchy ah ON a.parent_id = ah.id
        )
        SELECT id FROM activity_hierarchy
    ", ['activityName' => $activityName]);

        return collect($activities)->pluck('id')->toArray();
    }
}
