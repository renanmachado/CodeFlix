<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * CodeFlix\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $verified
 * @property string|null $verification_token
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereVerificationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\User whereVerified($value)
 */
class User extends Authenticatable implements TableInterface
{
    use Notifiable;

    const ROLE_ADMIN=1;
    const ROLE_CLIENT=2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
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
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Nome', 'E-mail'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'E-mail':
                return $this->email;
        }
    }

    /**
     * Generate password
     *
     * @param string $password
     */
    public static function generatePassword($password = null)
    {
        return !$password ? bcrypt(str_random(8)) : bcrypt($password);
    }
}
