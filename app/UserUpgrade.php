<?php

namespace App;

use App\User;
use App\UserUpgrade;

use Illuminate\Database\Eloquent\Model;

class UserUpgrade extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function upgrade() {
        return $this->belongsTo('App\FeatureUpgrad');
    }


    public static function isUpgradeAvailable($user_id, $upgrade_id) {

        $userUpgrades = UserUpgrade::where('user_id', $user_id)->get();

        foreach ( $userUpgrades as $upgrade ) {

            if ( $upgrade->upgrade_id == $upgrade_id ) {
                return (($upgrade->payment_status) && ($upgrade->status));
            }
        }
        
        return FALSE;       
    } 


    /*public static function isFunnelUploadAvailable($user_id) {

        $userUpgrade = UserUpgrade::where('user_id', $user_id)->first();

        return (($userUpgrade->payment_status) && ($userUpgrade->status));
    }*/ 
}
