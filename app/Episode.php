<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Episode
 *
 * @property string $id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereSeasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereSeasonNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereSeriesNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Episode extends Model
{
    use UsesUuid;
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'season_id', 'season_number', 'series_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];


    /**
     * Get the season for the episode.
     */
    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    /**
     * Get the sentences for the episode.
     */
    public function sentences()
    {
        return $this->belongsToMany('App\Sentence','episode_sentence')->withTimestamps();
    }
}
