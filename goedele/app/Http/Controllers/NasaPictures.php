<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NasaPictures extends Controller
{

    function getPictureOfTheDay($day=NULL){
        $picture = $this->queryDBforPicture($day);
        $title = "NASA picture of the day " . $day ;
        if($picture){
            return view('pages/nasaPictureOfDay', compact('title', 'picture'));
        }
        return $this->backupPage();
    }

    function showLastNPicturesOfTheDay(Request $request){
        $amount=30;
        if($queryamount = $request->query('amount')) {
            if ( strval($queryamount) === strval(intval($queryamount)) ) {
                $amount=$queryamount;
            }
        }
        $pictures = [];
        for ($i = 0; $i < $amount; $i++) {
            $day = date('Y-m-d', strtotime('-' . $i . ' days'));
            $picture = $this->queryDBforPicture($day);
            if($picture){
                $pictures[] = $picture;
            }
        }
       $title = "Last " . $amount .  " NASA pictures of the day" ;
       if($request->query('sorted')){
            $sorted = $request->query('sorted');
            if(array_key_exists($sorted,$pictures[0])){
                $sortColumn = array_column($pictures, $sorted);
                array_multisort($sortColumn, SORT_DESC, $pictures);
            }
       }
       return view('pages/nasaPicturesOverview', compact('title', 'pictures'));
    }
    
    public function addLikes($id, $amount=1, $oncePerSession=TRUE){
        
        //get current number of likes (not from html because could be changed since loading page)
        $likes = DB::table('nasa_picture')
        ->select('likes')
        ->where('id', $id)
        ->get()
        ->first();

        // // make sure user can only like an image once per session
        if (Session::has('hasLiked')) {
            $likedImages = Session::get('hasLiked');
            if(in_array($id, $likedImages)){
                if($oncePerSession){
                    $amount = -1 * $amount; // subtract like(s)
                    unset($likedImages[array_search($id, $likedImages)]);
                }
            } else {
                $likedImages[] = $id;
            }
        }
        else{
            $likedImages=[];
        }

        $likes = $likes->likes + $amount;
        // set likes to current plus amount
        DB::table('nasa_picture')
        ->select('likes')
        ->where('id', $id)
        ->update(['likes' => $likes]);

        Session::put('hasLiked', $likedImages);
        if(in_array($id, $likedImages)){
            $likes = "<b>" . $likes ."</b>";
        }

        // return data for ajax
        return response()->json(['likes'=> $likes ]);
    }

    protected function queryDBforPicture($day=NULL){
        if(!$day){
            $day = date("Y-m-d");
        }
        $result = DB::table('nasa_picture')
            ->where('date', $day)
            ->get()
            ->first();
        if(empty($result)){
            $result = $this->queryNasaAPI($day);
            if(array_key_exists('date', $result) && $result['date']!==''){
                $this->putInDB($result);
                // pull from db again to get all info, including likes & id
                $result = DB::table('nasa_picture')
                ->where('date', $day)
                ->get()
                ->first();
            } else {
                return NULL;
            }
        }

        return (array)$result;
    }

    protected function queryNasaAPI($day=NULL){
        if(!$day){
            $day = date("Y-m-d");
        }
        $nasa_request = \Config::get('app.nasa_api.base_request');
        $nasa_request = $nasa_request . '&date=' . $day;

        $result = json_decode(Http::get($nasa_request), true);
        return $result;
    }

    protected function putInDB($content){
        // copyright , date, explanation, hdurl, url, media_type, service_version, title
        $data=[
            "date"=>array_key_exists('date', $content)?$content['date']:"",
            "copyright"=>array_key_exists('copyright', $content)?$content['copyright']:"",
            "explanation"=>array_key_exists('explanation', $content)?$content['explanation']:"",
            "hdurl"=>array_key_exists('hdurl', $content)?$content['hdurl']:"",
            "url"=>array_key_exists('url', $content)?$content['url']:"",
            "media_type"=>array_key_exists('media_type', $content)?$content['media_type']:"",
            "service_version"=>array_key_exists('service_version', $content)?$content['service_version']:"",
            "title"=>array_key_exists('title', $content)?$content['title']:"",
            "likes"=>0,
        ];
        DB::table('nasa_picture')->insert($data);
    }

    protected function backupPage(){
        $explanation = "We're so very sorry. The NASA picture you are looking for does not seem to exist. Please enjoy this random cat instead.";
        return view('pages/randomCat', compact('explanation'));
    }
    

}
