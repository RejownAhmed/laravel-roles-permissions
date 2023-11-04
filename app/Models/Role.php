<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ["name", "label"];

    public function permissions() {
        return $this->belongsToMany(Permission::class);

    }

    public function givePermissionTo(string|Permission $permission)
    {
        if (is_string($permission)) {
            $permission = Permission::whereName($permission)->firstOrFail();
            return $this->permissions()->attach($permission->id);

        } else if ($permission instanceof Permission) {
            return $this->permissions()->attach($permission->id);

        }
    }

    public function revokePermission(string|Permission $permission)
    {
        if (is_string($permission)) {
            $permission = Permission::whereName($permission)->firstOrFail();
            return $this->permissions()->detach($permission->id);

        } else if ($permission instanceof Permission) {
            return $this->permissions()->detach($permission->id);

        }
    }
}
