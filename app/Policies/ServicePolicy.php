<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Service $service)
    {
        return $user->id === $service->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Service $service)
    {
        return $user->id === $service->user_id || $user->role === 'admin';
    }
}