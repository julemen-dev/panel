<?php

namespace Pterodactyl\Http\Requests\Admin\Servers;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class StoreServerMountRequest extends AdminFormRequest
{
    /**
     * Validation rules for database creation.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'source' => 'required',
            'target' => 'required',
            'readonly' => 'required|boolean',
            'type' => 'required|in:bind,volume,tmpfs',
        ];
    }
}
