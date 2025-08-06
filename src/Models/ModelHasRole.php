<?php

namespace Mayar\RolePermission\Models;
use Mayar\RolePermission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelHasRole extends Model
{
    use HasFactory;

    /**
     * Table name for clarity.
     */
    protected $table = 'model_has_roles';

    /**
     * Fillable columns.
     */
    protected $fillable = ['role_id', 'model_type', 'model_id'];

    /**
     * Relationship: Role associated with the model.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Relationship: The polymorphic model (e.g., User, Admin).
     */
    public function model()
    {
        return $this->morphTo();
    }
}
