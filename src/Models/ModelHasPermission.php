<?php

namespace Mayar\RolePermission\Models;
use Mayar\RolePermission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelHasPermission extends Model
{
    use HasFactory;

    /**
     * Table name for clarity.
     */
    protected $table = 'model_has_permissions';

    /**
     * Fillable columns.
     */
    protected $fillable = ['permission_id', 'model_type', 'model_id'];

    /**
     * Relationship: Permission associated with the model.
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    /**
     * Relationship: The polymorphic model (e.g., User, Admin).
     */
    public function model()
    {
        return $this->morphTo();
    }
}
