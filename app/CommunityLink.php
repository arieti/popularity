<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CommunityLinkAlreadySubmitted;

class CommunityLink extends Model
{
	protected $fillable = [
		'channel_id', 'title', 'link'
	];

    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public static function from(User $user)
    {
    	$link = new static;

    	$link->user_id = $user->id;

        if($user->isTrusted()){
            $link->approve();
        }

    	return $link;
    }

    public function contribute($attributes)
    {
        if($existing = $this->hasAlreadyBeenSubmitted($attributes['link'])){
            $existing->touch();

            throw new CommunityLinkAlreadySubmitted;
        }

    	return $this->fill($attributes)->save();
    }

    public function scopeForChannel($builder, $channel)
    {
        if($channel->exists){
            return $builder->where('channel_id', $channel->id);
        }

        return $builder;
    }

    public function approve()
    {
        $this->approved = true;
        return $this;
    }

    public function channel()
    {
    	return $this->belongsTo(Channel::class);
    }

    /**
     * Determine if the link has already been submitted.
     * @param  string $link
     * @return boolean
     */
    protected function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();
    }
}
