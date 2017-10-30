<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 29/10/17
 * Time: 2:31 PM
 */

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SimplifiiDatabaseService
{
    public static function locationsMarkedOnSingleDAy($day)
    {
        $date = Carbon::parse($day);
        $start_of_day = $date->copy()->startOfDay();
        $end_of_day = $date->copy()->endOfDay();

        $cards = DB::table('cards')
            ->where('entity', 'Location')
            ->where('created_at', '>=', $start_of_day)
            ->where('created_at', '<=', $end_of_day)
            ->get();

        return $cards;
    }

    public static function locationMarkedBetween($from, $to)
    {
        if (!is_null($from)) {
            $fromDate = Carbon::parse($from);
        } else {
            $fromDate = Carbon::now()->subCentury();
        }

        if (!is_null($to)) {
            $toDate = Carbon::parse($to);
        } else {
            $toDate = Carbon::now();
        }

        $cards = DB::table('cards')
            ->where('entity', 'Location')
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate)
            ->count();

        return $cards;

    }

}