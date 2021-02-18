<?php

namespace Filament\Models;

use Illuminate\Database\Eloquent\Model;

class FilamentRoleUser extends Model
{
    public $table = 'filament_role_user';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(FilamentUser::class, 'user_id');
    }
}
