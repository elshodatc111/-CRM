<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model{

    use HasFactory;

    protected $fillable = [
        'group_name',
        'group_price',
        'about',
        'status',
        'created_by',
    ];

    protected $casts = [
        'group_price' => 'decimal:2',
        'status' => 'string',
    ];

    public function creator(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by');
    }

    public function children(): HasMany{
        return $this->hasMany(GroupChild::class, 'group_id');
    }
    
    public function davomads(): HasMany{
        return $this->hasMany(GroupDavomad::class, 'group_id');
    }
    
}
