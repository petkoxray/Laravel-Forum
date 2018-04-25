<?php

namespace App\Models\Traits;

use App\Models\Role;

trait RoleTrait
{

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Assigning role to the user
     *
     * @param Role $role
     * @return $this
     */
    public function assignRole(Role $role)
    {
        $this->roles()->attach($role->id);

        return $this;
    }

    /**
     * Determine if the user has (one of) the given role(s).
     *
     * @param array|string $roles
     * @return bool
     */
    public function hasRole($roles): bool
    {
        if (is_string($roles) && false !== strpos($roles, '|')) {
            $roles = $this->convertPipeToArray($roles);
        }

        if (is_string($roles)) {
            return $this->roles->contains('name', strtolower($roles));
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine if the model has any of the given role(s).
     *
     * @param array|string $roles
     * @return bool
     */
    public function hasAnyRole($roles): bool
    {
        return $this->hasRole($roles);
    }

    /**
     * Check if user is Admin
     */
    public function isAdmin(): bool
    {
        return $this->roles->contains('name', 'admin');
    }

    private function convertPipeToArray(string $pipeString)
    {
        $pipeString = trim($pipeString);

        if (strlen($pipeString) <= 2) {
            return $pipeString;
        }

        $quoteCharacter = substr($pipeString, 0, 1);
        $endCharacter = substr($quoteCharacter, -1, 1);

        if ($quoteCharacter !== $endCharacter) {
            return explode('|', $pipeString);
        }

        if (! in_array($quoteCharacter, ["'", '"'])) {
            return explode('|', $pipeString);
        }

        return explode('|', trim($pipeString, $quoteCharacter));
    }
}
