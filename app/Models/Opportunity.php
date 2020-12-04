<?php

namespace App\Models;

use App\Http\Resources\Lookup\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','category_id','country_id','deadline','organizer','created_by'];
    // for format datetime deadline
    protected $casts = [
        'deadline' => 'datetime'
    ];

    // for relasi dari from Oppdetail
    public function  detail()
    {
        return $this->hasOne(OpportunityDetail::class);
    }

    // mengambil list field dari Category
    public function category()
    {
        return $this->belongsTo(\App\Models\Lookup\Category::class);

    }
    public function country()
    {
        return $this->belongsTo(\App\Models\Lookup\Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

}
