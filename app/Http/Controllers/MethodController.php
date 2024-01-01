<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Method;

class MethodController extends Controller
{
    /**
     * Make a string web safe
     * @param String $url String to make 'friendly'
     * @return String
     */
    public function getFriendlyURL(Request $request) {

        $url = $request->params["url"];
  
          //replace accent characters, depends your language is needed
          $url = $this->replace_accents($url);
  
          // everything to lower and no spaces begin or end
          $url = strtolower(trim($url));
  
  
          // adding - for spaces and union characters
          $find = array(' ', '&', '\r\n', '\n', '+',',');
          $url = str_replace ($find, '-', $url);
  
          //delete and replace rest of special chars
          $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
          $repl = array('', '-', '');
          $url = preg_replace ($find, $repl, $url);
  
          //return the friendly url
          return $url;
      }
      
      
    /**
     * Bilder abfragen.
     */
    public function getPictureById($id)
    {
        return \DB::table('tblImages')->join('tblCopyrights', 'copyrightID', 'copyrightPKID')
            ->select(\DB::raw('tblImages.*, tblCopyrights.copyrightTitle'))
            ->where('imgPKID', '=', $id)
            ->get()
            ->first();
    }
    /**
     * Bilder abfragen.
     */
    public function getPictures()
    {
        return \DB::table('tblImages')->join('tblCopyrights', 'copyrightID', 'copyrightPKID')
            ->select(\DB::raw('tblImages.*, tblCopyrights.copyrightTitle'))
            ->get();
    }

    /**
     * Methodikeintrag aufgrund der URL abfragen
     */
    public function getMethodByURL($url)
    {
        $thePictures = $this->getPictures();
        $theItems = Method::select(\DB::raw('tblMethods.*, "" as theImg, "" as theImg_mi, "" as imgTitle, "" as imgPath, "" as imgFN, "" as copyrightTitle '))
            ->where('methodURL', 'LIKE', $url)
            ->get();

        if (count($theItems)>0) 
        {
            for ($i=0; $i<count($theItems); $i++) 
            {
                for ($j=0; $j<count($thePictures); $j++) 
                {
                    if ($theItems[$i]->imgID === $thePictures[$j]->imgPKID) 
                    {
                        $theItems[$i]->imgTitle = $thePictures[$j]->imgTitle; 
                        $theItems[$i]->imgPath = $thePictures[$j]->imgPath; 
                        $theItems[$i]->imgFN = $thePictures[$j]->imgFN; 
                        $theItems[$i]->copyrightTitle = $thePictures[$j]->copyrightTitle; 
                        $theImg = substr($thePictures[$j]->imgFN, 0, strlen($thePictures[$j]->imgFN)-4)."_sm.".substr($thePictures[$j]->imgFN,-3);
                        $theImg_mi = substr($thePictures[$j]->imgFN, 0, strlen($thePictures[$j]->imgFN)-4)."_mi.".substr($thePictures[$j]->imgFN,-3);
                        $theItems[$i]->theImg = "images/".$thePictures[$j]->imgPath."/".$theImg;
                        $theItems[$i]->theImg_mi = "images/".$thePictures[$j]->imgPath."/".$theImg_mi;
                    }
                }
            }
        }
        return $theItems;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thePictures = $this->getPictures();
        $theItems = Method::select(\DB::raw('tblMethods.*, "" as theImg, "" as theImg_mi, "" as imgTitle, "" as imgPath, "" as imgFN, "" as copyrightTitle '))
            ->orderBy('dateOfPublication', 'DESC')
            ->get();

        if (count($theItems)>0) 
        {
            for ($i=0; $i<count($theItems); $i++) 
            {
                for ($j=0; $j<count($thePictures); $j++) 
                {
                    if ($theItems[$i]->imgID === $thePictures[$j]->imgPKID) 
                    {
                        $theItems[$i]->imgTitle = $thePictures[$j]->imgTitle; 
                        $theItems[$i]->imgPath = $thePictures[$j]->imgPath; 
                        $theItems[$i]->imgFN = $thePictures[$j]->imgFN; 
                        $theItems[$i]->copyrightTitle = $thePictures[$j]->copyrightTitle; 
                        $theImg = substr($thePictures[$j]->imgFN, 0, strlen($thePictures[$j]->imgFN)-4)."_sm.".substr($thePictures[$j]->imgFN,-3);
                        $theImg_mi = substr($thePictures[$j]->imgFN, 0, strlen($thePictures[$j]->imgFN)-4)."_mi.".substr($thePictures[$j]->imgFN,-3);
                        $theItems[$i]->theImg = "images/".$thePictures[$j]->imgPath."/".$theImg;
                        $theItems[$i]->theImg_mi = "images/".$thePictures[$j]->imgPath."/".$theImg_mi;
                    }
                }
            }
        }
        return $theItems;
    }


    /**
      * Replace accents in names to fit url guidelines
      */
      function replace_accents($var) {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
        $b = array('A', 'A', 'A', 'A', 'Ae', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'Oe', 'O', 'U', 'U', 'U', 'U', 'Y', 'ss', 'a', 'a', 'a', 'a', 'ae', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'oe', 'o', 'u', 'u', 'u', 'ue', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'Ue', 'ue', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');

        $newURL = str_replace($a, $b, $var);
        return $newURL;
    }

    /**
     * Neuen Methodikeintrag hinzufügen
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'methodTitle' => 'required',
            'methodUrl' => 'required',
            'methodTeaser' => 'required',
            'methodText' => 'required',
        ]);       
        
        $theItem = new Method();
        $theItem->flagActive = $request->flagActive;
        $theItem->imgID = $request->imgID;
        $theItem->imgText = $request->imgText;
        $theItem->methodTitle = $request->methodTitle;
        $theItem->methodTeaser = $request->methodTeaser;
        $theItem->methodText = $request->methodText;
        $theItem->methodUrl = $request->methodUrl;
        $theItem->dateOfPublication = $request->dateOfPublication;

        return $theItem->save();
    }

    /**
     * Methodikeintrag abfragen.
     */
    public function show(string $id)
    {

        $theItem = Method::select(\DB::raw('tblMethods.*, "" as theImg, "" as imgTitle, "" as imgPath, "" as imgFN, "" as copyrightTitle '))
            ->where('methodPKID', '=', $id)
            ->get()
            ->first();

        if ($theItem) 
        {
            if ($theItem->imgID>0) {
                $thePicture = $this->getPictureById($theItem->imgID);
                if ($thePicture) 
                {
                    $theItem->imgTitle = $thePicture->imgTitle; 
                    $theItem->imgPath = $thePicture->imgPath; 
                    $theItem->imgFN = $thePicture->imgFN; 
                    $theItem->copyrightTitle = $thePicture->copyrightTitle; 
                    $theImg = substr($thePicture->imgFN, 0, strlen($thePicture->imgFN)-4)."_mi.".substr($thePicture->imgFN,-3);
                    $theItem->theImg = "images/".$thePicture->imgPath."/".$theImg;                    
                }
            }
        }

        return $theItem;
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
        $theItem = Method::findOrFail($id);
        $params = $request->params['form'];
        $theItem->flagActive = $params['flagActive'];
        $theItem->imgID = intval($params['imgID']);
        $theItem->imgText = $params['imgText'];
        $theItem->methodTitle = $params['methodTitle'];
        $theItem->methodTeaser = $params['methodTeaser'];
        $theItem->methodURL = $params['methodURL'];
        $theItem->methodText = html_entity_decode($params['methodText']);
        $theItem->updated_at = Carbon::now();
        return $theItem->save();
    }

    /**
     * Eintrag löschen.
     */
    public function destroy(string $id)
    {
        return Method::findOrFail($id)->delete();
    }
}
