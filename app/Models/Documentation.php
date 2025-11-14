<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;
    
    // Explicitly state table name 
    protected $table = 'documentations'; 

   
    protected $fillable = [
        'event_id',
        'title',
          'file_path',
           ];

   
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}