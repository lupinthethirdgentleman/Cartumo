<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\AffiliateProfile;

class UserAffiliatePayment extends Model
{
	public function getProfile($user_id) {
		return AffiliateProfile::where('user_id', $user_id)->first();
	}
}
