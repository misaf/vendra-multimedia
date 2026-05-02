<?php

declare(strict_types=1);

namespace Misaf\VendraMultimedia\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Misaf\VendraMultimedia\Enums\MultimediaPolicyEnum;
use Misaf\VendraMultimedia\Models\Multimedia;
use Misaf\VendraUser\Models\User;

final class MultimediaPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can(MultimediaPolicyEnum::CREATE);
    }

    public function delete(User $user, Multimedia $multimedia): bool
    {
        return $user->can(MultimediaPolicyEnum::DELETE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(MultimediaPolicyEnum::DELETE_ANY);
    }

    public function forceDelete(User $user, Multimedia $multimedia): bool
    {
        return $user->can(MultimediaPolicyEnum::FORCE_DELETE);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can(MultimediaPolicyEnum::FORCE_DELETE_ANY);
    }

    public function replicate(User $user, Multimedia $multimedia): bool
    {
        return $user->can(MultimediaPolicyEnum::REPLICATE);
    }

    public function restore(User $user, Multimedia $multimedia): bool
    {
        return $user->can(MultimediaPolicyEnum::RESTORE);
    }

    public function restoreAny(User $user): bool
    {
        return $user->can(MultimediaPolicyEnum::RESTORE_ANY);
    }

    public function update(User $user, Multimedia $multimedia): bool
    {
        return $user->can(MultimediaPolicyEnum::UPDATE);
    }

    public function view(User $user, Multimedia $multimedia): bool
    {
        return $user->can(MultimediaPolicyEnum::VIEW);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(MultimediaPolicyEnum::VIEW_ANY);
    }
}
