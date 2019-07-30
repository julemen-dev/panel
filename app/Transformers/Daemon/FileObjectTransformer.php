<?php

namespace Pterodactyl\Transformers\Daemon;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class FileObjectTransformer extends BaseDaemonTransformer
{
    /**
     * An array of files we allow editing in the Panel.
     *
     * @var array
     */
    private $editable = [];

    /**
     * FileObjectTransformer constructor.
     */
    public function __construct()
    {
        $this->editable = config('pterodactyl.files.editable', []);
    }

    /**
     * Transform a file object response from the daemon into a standardized response.
     *
     * @param array $item
     * @return array
     */
    public function transform(array $item)
    {
        return [
            'name' => Arr::get($item, 'name'),
            'mode' => Arr::get($item, 'mode'),
            'size' => Arr::get($item, 'size'),
            'is_file' => Arr::get($item, 'file', true),
            'is_symlink' => Arr::get($item, 'symlink', false),
            'is_editable' => in_array(Arr::get($item, 'mime', ''), $this->editable),
            'mimetype' => Arr::get($item, 'mime'),
            'created_at' => Carbon::parse(explode(' ', Arr::get($item, 'created', ''))[0] ?? '')->toIso8601String(),
            'modified_at' => Carbon::parse(explode(' ', Arr::get($item, 'modified', ''))[0] ?? '')->toIso8601String(),
        ];
    }

    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return 'file_object';
    }
}