<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','price','category','description','stock','image'];
    


    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function scopeFilter($query, array $filters){
        if($filters['id'] ?? false){
            $ids = explode(',',$filters['id']);
            //Le pasa el query y los filtros, entonces con where pone que filtrara por tags, los registros que tengan la siguiente coincidencia, y es lo que tenga antes, lo que tenga despues pero que tenga la tag.
            $query->whereIn('id',$ids);
        }
        /* if($filters['search'] ?? false){
            $query->where('title','like','%'. $filters['search'].'%')
                ->orWhere('description','like','%'. $filters['search'].'%')
                ->orWhere('tags','like','%'. $filters['search'].'%');
        } */
    }
}
