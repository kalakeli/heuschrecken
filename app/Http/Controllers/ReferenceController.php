<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class ReferenceController extends Controller
{
    /**
     * Ordnungen
     */
    public function getOrders()
    {
        return \DB::table('lutSystematik') 
            ->select(\DB::raw('lutSystematik.*, lutSystematik.lutPKID as orderID'))
            ->where('groupID', '=', 3)->orderBy('scientificName', 'ASC')->get();
    }
    /**
     * Unterordnungen
     */
    public function getSubOrders()
    {
        return \DB::table('lutSystematik')
            ->select(\DB::raw('lutSystematik.*, lutSystematik.lutPKID as subOrderID'))
            ->where('groupID', '=', 4)->orderBy('scientificName', 'ASC')->get();
    }
    /**
     * Familien
     */
    public function getFamilies()
    {
        return \DB::table('lutSystematik')
            ->select(\DB::raw('lutSystematik.*, lutSystematik.lutPKID as familyID'))
            ->where('groupID', '=', 5)->orderBy('scientificName', 'ASC')->get();
    }
    /**
     * Unterfamilien
     */
    public function getSubFamilies()
    {
        return \DB::table('lutSystematik')
            ->select(\DB::raw('lutSystematik.*, lutSystematik.lutPKID as subFamilyID'))
            ->where('groupID', '=', 6)->orderBy('scientificName', 'ASC')->get();
    }


}
