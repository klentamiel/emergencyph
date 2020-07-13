<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReports extends Model
{
    //
    protected $table = 'user_reports';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'location','report_type','status', 'message', 'response_by', 'picture'
    ];
}
