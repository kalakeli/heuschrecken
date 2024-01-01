<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Copyright;

class ImageController extends Controller
{
    /**
     * Get banner images.
     */
    public function getBannerImages()
    {
        return Image::join('tblCopyrights', 'copyrightID', 'copyrightPKID')
            ->join('tblSpecies', 'speciesID', 'speciesPKID')
            ->join('lutGenders', 'genderID', 'lutPKID')
            ->select(\DB::raw('tblImages.*, tblCopyrights.copyrightTitle, lutGenders.valueHTML as genderHTML, lutGenders.valueName as gender, tblSpecies.*'))
            ->where('tblImages.flagSlider', '=', 1)
            ->orderBy('tblSpecies.germanName', 'ASC')
            ->get();
    }
    /**
     * Artbilder.
     */
    public function index()
    {
        return Image::join('tblCopyrights', 'copyrightID', 'copyrightPKID')
            ->join('tblSpecies', 'speciesID', 'speciesPKID')
            ->join('lutGenders', 'genderID', 'lutPKID')
            ->select(\DB::raw('tblImages.*, tblCopyrights.copyrightTitle, lutGenders.valueHTML as genderHTML, lutGenders.valueName as gender, tblSpecies.*'))
            ->orderBy('tblSpecies.germanName', 'ASC')
            ->get();
    }
    /**
     * Andere Bilder.
     */
    public function getNonSpeciesImages()
    {
        return Image::join('tblCopyrights', 'copyrightID', 'copyrightPKID')
            ->select(\DB::raw('tblImages.*, tblCopyrights.copyrightTitle'))
            ->where('tblImages.speciesID', '=', NULL)
            ->orderBy('tblImages.created_at', 'DESC')
            ->get();
    }

    /**
     * Bildergalerie einer Art - ohne Banner, damit sie alle gleiche Dimensionen haben.
     */
    public function getSpeciesImages($id)
    {
        return Image::join('tblCopyrights', 'copyrightID', 'copyrightPKID')
            ->join('tblSpecies', 'speciesID', 'speciesPKID')        
            ->leftJoin('lutGenders', 'genderID', 'lutPKID')
            ->select(\DB::raw('tblImages.*, tblCopyrights.copyrightTitle, lutGenders.valueHTML as genderHTML, lutGenders.valueName as gender, lutGenders.valueNameDesc as genderDesc, tblSpecies.*'))
            ->where('tblImages.speciesID', '=', $id)
            ->where('tblImages.flagSlider', '=', 0)
            ->orderBy('tblImages.created_at', 'DESC')
            ->get();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Image::join('tblCopyrights', 'copyrightID', 'copyrightPKID')
            ->select(\DB::raw('tblImages.*, tblCopyrights.copyrightTitle'))
            ->where('tblImages.imgPKID', '=', $id)
            ->orderBy('tblImages.created_at', 'DESC')
            ->get();
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $theItem = Image::findOrFail($id);

        $suffix = substr($theItem->imgFN, -3);
        if ($theItem->flagSlider==1) 
        {
            $img_slider = "images/".$theItem->imgPath."/".substr($theItem->imgFN, 0, strlen($theItem->imgFN)-4).".".$suffix;
            if (file_exists($img_slider)) {
                unlink($img_slider);
            }
        }
        $img_sm = "images/".$theItem->imgPath."/".substr($theItem->imgFN, 0, strlen($theItem->imgFN)-4)."_sm.".$suffix;
        $img_mi = "images/".$theItem->imgPath."/".substr($theItem->imgFN, 0, strlen($theItem->imgFN)-4)."_mi.".$suffix;
        $img_lg = "images/".$theItem->imgPath."/".substr($theItem->imgFN, 0, strlen($theItem->imgFN)-4)."_lg.".$suffix;
        $img_xl = "images/".$theItem->imgPath."/".substr($theItem->imgFN, 0, strlen($theItem->imgFN)-4)."_xl.".$suffix;
        
        if (file_exists($img_sm)) {
            unlink($img_sm);
        } 
        if (file_exists($img_mi)) {
            unlink($img_mi);
        } 
        if (file_exists($img_lg)) {
            unlink($img_lg);
        } 
        if (file_exists($img_xl)) {
            unlink($img_xl);
        } 

        $theItem->delete();
    }
}
