<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Species;

class SpeciesController extends Controller
{
    //   \DB::enableQueryLog(); 
    //   dd(\DB::getQueryLog());    

    /**
     * Verbindung mit Uni Rostock herstellen
     */
    public function connectToPortal()
    {
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://sso.loe.auf.uni-rostock.de/auth/realms/infinitenature.org/protocol/openid-connect/token",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "grant_type=password&username=api%40heuschrecken-portal.de&password=A23Ew!23r!&client_id=flora-cms&client_secret=860f2b40-20d7-4e75-9d94-9ead4f100175",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "Postman-Token: b6ece115-7aff-42f6-b7d4-344971026f51",
            "cache-control: no-cache"
          ),
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }


    /**
     * Letzte Funde aller Arten abfragen
     */
    public function getAllOccurences($limit)
    {   
        // Anzahl Einträge die abgefragt werden
        $nr = $limit;

        // Verbindung herstellen
        $theConnection = $this->connectToPortal();
        // die JSON Antwort umwandeln
        $jsonConnection = json_decode($theConnection);
        // Token holen
        $theToken = $jsonConnection->access_token;
      
        // Versuchen wir es mit CURL
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://service.infinitenature.org/api/v1/6/occurrences?offset=0&limit=".$nr."&sortField=DATE&sortOrder=DESC",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$theToken.''
            ),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
        return $response;
    }
    

    /**
     * Eine gezielte Art entsprechend ID abfragen
     */
    public function getLastOccurences($speciesid, $limit, Request $request)
    {   
        // ID in DB
        $theOrthopteraID = $request->orthopteraID;
        // Anzahl Einträge die abgefragt werden
        $nr = $limit;

        // Verbindung herstellen
        $theConnection = $this->connectToPortal();
        // die JSON Antwort umwandeln
        $jsonConnection = json_decode($theConnection);
        // Token holen
        $theToken = $jsonConnection->access_token;
      
        // Versuchen wir es mit CURL
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://service.infinitenature.org/api/v1/6/occurrences?taxon=".$theOrthopteraID."&offset=0&limit=".$nr."&sortField=DATE&sortOrder=DESC",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$theToken.''
            ),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
        return $response;
    }
    

    /**
     * Eine gezielte Art entsprechend ID abfragen
     */
    public function getSpeciesByURL($url)
    {
            //   \DB::enableQueryLog(); 
        return Species::join('lutSystematik as lutOrders', 'lutOrders.lutPKID', 'tblSpecies.orderID')
              ->join('lutSystematik as lutFamilies', 'lutFamilies.lutPKID', 'tblSpecies.familyID')
              ->join('lutSystematik as lutSubFamilies', 'lutSubFamilies.lutPKID', 'tblSpecies.subFamilyID')
              ->select(\DB::raw('tblSpecies.*, lutOrders.germanName as orderGerman, lutFamilies.germanName as familyGerman, lutFamilies.englishName as familyEnglish, lutFamilies.scientificName as familyScientific, lutSubFamilies.germanName as subFamilyGerman, lutSubFamilies.scientificName as subFamilyScientific, lutOrders.scientificName as orderScientific '))
              ->where('tblSpecies.germanName', 'LIKE', $url)   
              ->orWhere('tblSpecies.scientificName', 'LIKE', $url)   
              ->get();
            //   dd(\DB::getQueryLog());
    }
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Species::join('lutOrders', 'lutOrders.lutPKID', 'orderID')
        //     ->join('lutFamilies', 'tblSpecies.familyID', 'lutFamilies.lutPKID')
        //     ->select(\DB::raw('tblSpecies.*, lutOrders.germanName as orderGerman, lutFamilies.germanName as familyGerman, lutFamilies.englishName as familyEnglish, lutFamilies.scientificName as familyScientific, lutOrders.scientificName as orderScientific '))
        //     ->orderBy('familyID', 'ASC')
        //     ->orderBy('germanName', 'ASC')
        //     ->get();
        return Species::join('lutSystematik as lutOrders', 'lutOrders.lutPKID', 'tblSpecies.orderID')
            ->join('lutSystematik as lutFamilies', 'lutFamilies.lutPKID', 'tblSpecies.familyID')
            ->join('lutSystematik as lutSubFamilies', 'lutSubFamilies.lutPKID', 'tblSpecies.subFamilyID')
            ->select(\DB::raw('tblSpecies.*, lutOrders.germanName as orderGerman, lutFamilies.germanName as familyGerman, lutFamilies.englishName as familyEnglish, lutFamilies.scientificName as familyScientific, lutSubFamilies.germanName as subFamilyGerman, lutSubFamilies.scientificName as subFamilyScientific, lutOrders.scientificName as orderScientific '))
            ->where('tblSpecies.flagShow', '=', 1)
            ->orderBy('tblSpecies.familyID', 'ASC')
            ->orderBy('tblSpecies.scientificName', 'ASC')
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
     * Art speichern.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'orderID' => 'required|gt:0',
            'subOrderID' => 'required|gt:0',
            'familyID' => 'required|gt:0',
            'subFamilyID' => 'required|gt:0',
            'scientificName' => 'required',
        ]);       
        
        $theItem = new Species();
        $theItem->orderID = $request->orderID;
        $theItem->subOrderID = $request->subOrderID;
        $theItem->familyID = $request->familyID;
        $theItem->subFamilyID = $request->subFamilyID;
        $theItem->germanName = $request->germanName;
        $theItem->scientificName = $request->scientificName;
        $theItem->englishName = $request->englishName;
        $theItem->author = $request->author;
        $theItem->orthopteraID = $request->orthopteraID;

        return $theItem->save();
    }



    /**
     * Eine gezielte Art entsprechend ID abfragen
     */
    public function show($id)
    {
        return Species::join('lutSystematik as lutOrders', 'lutOrders.lutPKID', 'tblSpecies.orderID')
            ->join('lutSystematik as lutFamilies', 'lutFamilies.lutPKID', 'tblSpecies.familyID')
            ->join('lutSystematik as lutSubFamilies', 'lutSubFamilies.lutPKID', 'tblSpecies.subFamilyID')
            ->select(\DB::raw('tblSpecies.*, lutOrders.germanName as orderGerman, lutFamilies.germanName as familyGerman, lutFamilies.englishName as familyEnglish, lutFamilies.scientificName as familyScientific, lutSubFamilies.germanName as subFamilyGerman, lutSubFamilies.scientificName as subFamilyScientific, lutOrders.scientificName as orderScientific '))
            ->where('tblSpecies.speciesPKID', '=', $id)          
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
        $this->validate($request, [
            'orderID' => 'required|gt:0',
            'subOrderID' => 'required|gt:0',
            'familyID' => 'required|gt:0',
            'subFamilyID' => 'required|gt:0',
            'scientificName' => 'required',
        ]);       
        
        $theItem = Species::findOrFail($id);

        $theItem->orderID = $request->orderID;
        $theItem->subOrderID = $request->subOrderID;
        $theItem->familyID = $request->familyID;
        $theItem->subFamilyID = $request->subFamilyID;
        $theItem->germanName = $request->germanName;
        $theItem->scientificName = $request->scientificName;
        $theItem->englishName = $request->englishName;
        $theItem->author = $request->author;
        $theItem->orthopteraID = $request->orthopteraID;

        return $theItem->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Species::findOrFail($id)->delete();
    }
}
