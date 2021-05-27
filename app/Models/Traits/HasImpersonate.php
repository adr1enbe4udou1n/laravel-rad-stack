<?php

namespace App\Models\Traits;

use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * @property null|RoleEnum $role
 */
trait HasImpersonate
{
    public function canImpersonate()
    {
        return $this->role && $this->role->equals(RoleEnum::super_admin(), RoleEnum::admin());
    }

    public function canBeImpersonated()
    {
        return $this->id !== Auth::id() && (! $this->role || ! $this->role->equals(RoleEnum::super_admin()));
    }

    public function setImpersonating($id)
    {
        Session::put('impersonate', $id);
    }

    public function stopImpersonating()
    {
        Session::forget('impersonate');
    }

    public function isImpersonating()
    {
        return Session::has('impersonate');
    }
}
