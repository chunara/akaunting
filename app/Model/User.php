<?php

namespace App\Model;


use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

    public static $snakeAttributes = false;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

}
