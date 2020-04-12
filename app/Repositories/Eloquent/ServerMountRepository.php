<?php

namespace Pterodactyl\Repositories\Eloquent;

use Pterodactyl\Models\ServerMount;

class ServerMountRepository extends EloquentRepository
{
    /**
     * @inheritDoc
     */
    public function model() {
        return ServerMount::class;
    }
}
