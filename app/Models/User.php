<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeRelativeFilter(Builder $query, $inputName): Builder
    {
        if (request()->has($inputName)) {
            $query->where($inputName, 'like', "%" . request()->input($inputName) . "%");
        }
        return $query;
    }

    public function scopeExactFilter(Builder $query, $inputName): Builder
    {
        if (request()->has($inputName)) {
            $query->where($inputName, request()->input($inputName));
        }
        return $query;
    }

    public function scopeBooleanFilter(Builder $query, $inputName): Builder
    {
        if (request()->has($inputName)) {
            $query->where($inputName, request()->input($inputName) ? 1 : 0);
        }
        return $query;
    }
}
