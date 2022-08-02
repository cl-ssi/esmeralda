<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'run',
        'dv',
        'name',
        'email',
        'password',
        'telephone',
        'function',
        'active',
        'laboratory_id',
        'establishment_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearch($query,$search)
    {
        return $query->where('name', 'LIKE', '%' . $search . '%');
    }

    public function scopeSearchByEstab($query,$establishment)
    {
        switch($establishment)
        {
            case "all":
                return $query;
                break;
            case "none":
                return $query->doesntHave('establishment');
                break;
            default:
                return $query->whereHas('establishment', function ($query) use($establishment){
                    $query->where('id', $establishment);
                });
                break;
        }

    }

    public function scopeAcceded($query,$acceded)
    {
        switch($acceded)
        {
            case 'yes':
                return $query->has('lastLogin');
                break;
            case 'no':
                return $query->doesntHave('lastLogin');
                break;
            default:
                return $query;
                break;
        }
    }

    public function scopeActive($query,$active)
    {
        switch($active)
        {
            case 'yes':
                return $query->where('active',true);
                break;
            case 'no':
                return $query->where('active',false);
                break;
            default:
                return $query;
                break;
        }
    }

    public function scopeSearchByPermission($query,$permission)
    {
        if($permission)
        {
            switch($permission)
            {
                case 'any':
                    return $query;
                    break;
                default:
                    return $query->permission($permission);
                    break;
            }
        }
    }

    public function logs() {
        return $this->morphMany('App\Log','model');
    }

    public function vitalSigns() {
        return $this->hasMany('App\SanitaryResidence\VitalSign');
    }

    public function laboratory() {
        return $this->belongsTo('App\Laboratory');
    }

    /**
    * The residence that belong to the user.
    */
    public function residences() {
        return $this->belongsToMany('App\SanitaryResidence\Residence');
    }

    /**
    * The establishment that belong to the user.
    */
    public function establishment() {
        return $this->belongsTo('App\Establishment');
    }
    
    /**
    * The establishments where has access the user.
    */
    public function establishments() {
        return $this->belongsToMany('App\Establishment');
    }

    public function suspectCases() {
        return $this->hasMany('App\SuspectCase');
    }

    public function communes() {
        $ids = array();
        foreach($this->establishments as $estab) {
            $ids[] = $estab->commune->id;
        }
        //print_r($ids);
        return array_values(array_unique($ids));
    }

    public function events() {
        return $this->hasMany('App\Tracing\Event');
    }

    public function bulkLoadRecord() {
      return $this->hasMany('\App\BulkLoadRecord');
    }

    public function logSessions() {
        return $this->hasMany('App\LogSession');
    }
    
    public function lastLogin() {
        return $this->hasOne('App\LogSession')->orderByDesc('created_at');
    }

    public function getLastSessionsAttribute() {
        return $this->hasMany('App\LogSession')->limit(30)->orderByDesc('created_at')->get();
    }

    public function laboratories() {
        return $this->belongsToMany(Laboratory::class)->withTimestamps();
    }
}
