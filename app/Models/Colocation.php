<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = [
        'name',
        'status',
        'description',
        'owner_id',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function expenses()
    {
        return $this->hasManyThrough(Expense::class, Category::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Expense::class, 'category_id', 'expense_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'memberships')
            ->withPivot('role', 'left_at');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
