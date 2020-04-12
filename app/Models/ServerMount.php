<?php

namespace Pterodactyl\Models;

/**
 * @property int $id
 * @property int $server_id
 * @property string $source
 * @property string $target
 * @property boolean $readonly
 * @property string $type
 *
 * @property \Pterodactyl\Models\Server $server
 */
class ServerMount extends Model
{
    /**
     * The resource name for this model when it is transformed into an
     * API representation using fractal.
     */
    const RESOURCE_NAME = 'server_mounts';

    /**
     * Toggles timestamps for the model.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'server_mounts';

    /**
     * Fields that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'server_id', 'source', 'target', 'readonly', 'type'];

    /**
     * Cast values to correct type.
     *
     * @var array
     */
    protected $casts = [
        'server_id' => 'int',
        'readonly' => 'boolean',
    ];

    /**
     * @var array
     */
    public static $validationRules = [
        'server_id' => 'required|numeric|exists:servers,id',
        'source' => 'required',
        'target' => 'required',
        'readonly' => 'required|boolean',
        'type' => 'required|in:bind,volume,tmpfs',
    ];

    /**
     * Gets the server associated with a server transfer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
