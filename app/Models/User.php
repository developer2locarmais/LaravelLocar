<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use DateTimeInterface;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password','theme'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setTheme(string $theme)
    {
        $this->theme = $theme;
        $this->save();
    }

    public function theme():array
    {
        $classes = [
            'default' => [
                'body' => '',
                'navbar' => ' navbar-light ',
                'logo'  =>'escuro.png',
                'sidebar' => 'sidebar-dark-primary ',
            ],
            'light' => [
                'body' => '',
                'navbar' => ' navbar-white ',
                'logo'  =>'colorido.png',
                'sidebar' => ' sidebar-light-lightblue '
            ],
            'dark' => [
                'body' => ' dark-mode ',
                'navbar' => ' navbar-dark ',
                'logo'  =>'escuro.png',
                'sidebar' => ' sidebar-dark-secondary '
            ]
        ];
        return $classes[$this->theme] ?? [
                'body' => '',
                'navbar' => ' navbar-light ',
                'sidebar' => ' sidebar-dark-primary ',
                'logo'  =>'escuro.png',
            ];
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
