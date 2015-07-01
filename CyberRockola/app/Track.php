<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */


    protected $table = 'track';
    protected $fillable = array('name','dir_track');
    protected $guarded  = array('id');
    public    $timestamps = false;


    /**
     * Mutators
     *
     * @param $date
     */
   /** public function setPublishedAtAttribute($date)
    {
        //$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
        $this->attributes['published_at'] = Carbon::parse($date);
    }**/


    /**
     * Scope example
     *
     * @param $query
     */
    //
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now())->get();
    }


    /**
     * Scope example
     *
     * @param $query
     */
    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>', Carbon::now())->get();
    }


}
