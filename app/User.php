<?php

namespace App;

use App\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
		'middle_name',
		'last_name',
		'email',
		'birthday',
		'gender',
		'ethnicity',
		'interested_in',
		'civil_status',
		'country',
        'state',
		'bio',
        'profile_pic',
		'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id');
    }

    public function conversations(){
        return $this->belongsToMany('App\Conversation');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'user_id');
    }

	public function friendsOfMine()
	{
		return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
	}

	public function friendOf()
	{
		return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
	}

	public function friends()
	{
		return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
	}

	public function friendRequests()
	{
		return $this->friendsOfMine()->wherePivot('accepted', false)->get();
	}

	public function friendRequestsPending()
	{
		return $this->friendOf()->wherePivot('accepted', false)->get();
	}

	public function hasfriendRequestPending(User $user)
	{
		return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
	}

	public function hasFriendRequestReceived(User $user)
	{
		return (bool) $this->friendRequests()->where('id', $user->id)->count();
	}

	public function addFriend(User $user)
	{
		$this->friendOf()->attach($user->id);
	}

	public function acceptFriendRequest(User $user)
	{
		$this->friendRequests()->where('id', $user->id)->first()->pivot->update([
			'accepted' => true
		]);
	}

	public function isFriendsWith(User $user)
	{
		return (bool) $this->friends()->where('id', $user->id)->count();
	}

    public function hasLikedPost(Post $post)
    {
        return (bool) $post->likes
            ->where('user_id', $this->id)
            ->count();
    }
}
