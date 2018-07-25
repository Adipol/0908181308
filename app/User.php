<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id'
    ];

    public function setNameAttribute($valor)
    {
        $this->attributes['name']= strtolower($valor);
    }

    public function setEmailAttribute($valor)
    {
        $this->attributes['email']= strtolower($valor);
    }

    public function getNameAttribute($valor)
    {
        return ucfirst($valor);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function navigation(){
		return auth()->check()? auth()->user()->rol->abbreviation : 'guest';
	} 
	
    public function warehouses()
    {
        return $this->belongsToMany('App\Warehouse','user_warehouses','user_id','warehouse_id');
    }

    public function rol()
    {
        return $this->belongsTo('App\Rol','rol_id');
    }
    
    public function associates()
    {
        return $this->hasmany('App\Associate');
    }

    public function getIsAdminAttribute(){
		return $this->rol_id==1;
    }
    
	public function getIsSolAttribute(){
		return $this->rol_id==2;
    }
    
	public function getIsSupAttribute(){
		return $this->rol_id==3;
    }
    
    public function getIsEncAttribute(){
		return $this->rol_id==4;
    }
    
    public function sendPasswordResetNotification($token){
		$this->notify(new ResetPasswordNotification($token));
	}
}
