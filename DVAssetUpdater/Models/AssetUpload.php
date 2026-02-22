<?php

namespace Modules\DVAssetUpdater\Models;

use Illuminate\Database\Eloquent\Model;

class AssetUpload extends Model
{
    protected $table = 'asset_uploads';

    protected $fillable = [
        'user_id',
        'target_key',
        'original_name',
        'stored_name',
        'relative_path',
        'mime',
        'size',
        'sha1',
    ];
}
