<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $table = 'user_profiles';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name','middle_name','last_name', 'nationality', 'country', 'birth_date', 'birth_place','id_type','id_number','id_expiration','id_link','contact_no','contact_no','pa_baranggay','pa_city','pa_state','pa_zipcode','pa_province','current_address','ca_baranggay','ca_city','ca_state','ca_zipcode','ca_province'
    ];

}
