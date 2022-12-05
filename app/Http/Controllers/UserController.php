<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CityInterest;
use App\Models\InterestCount;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = '';
        $city = $_REQUEST['city'];
        $users = DB::select("SELECT i.interests,l.city
        FROM interests i
        INNER JOIN users u ON i.user_id=u.id
        INNER JOIN location l ON i.user_id=l.user_id
        WHERE l.city LIKE '%$city%'");

       $interests = '';
       $j = 0;
       foreach($users as $i => $i_value) {
            $interests = $interests.$i_value->interests;
        }
        $interests_array = explode(';',$interests);
        $myhashmap = array();
        for($i=0;$i<count($interests_array)-1;$i++){

            if(@$myhashmap[$interests_array[$i]] != null) {
                $count = $myhashmap[$interests_array[$i]];
                unset($myhashmap[$interests_array[$i]]);
                $myhashmap[$interests_array[$i]] = $count+1;
            }
            else {
                $myhashmap[$interests_array[$i]] = 1;
            }
        }
        $interestCountArray = array();
        $j=0;
        for($i=0;$i<count($myhashmap);$i++){
            $interestCount = new InterestCount();
            $interestCount->interest = array_keys($myhashmap)[$i];
            $interestCount->count = $myhashmap[array_keys($myhashmap)[$i]];
            $interestCountArray[$j++] = $interestCount;
        }
        $cityInterest = new CityInterest();
        $cityInterest->city = $city;
        $cityInterest->interestCount = $interestCountArray;

        return json_encode($cityInterest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }
}
