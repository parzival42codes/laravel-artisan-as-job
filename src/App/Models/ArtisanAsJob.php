<?php

namespace parzival42codes\LaravelArtisanAsJob\App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtisanAsJob extends Model
{
    public const DBNAME = 'artisan_as_job';

    public const STATUS_QUEUE = 'queue';

    public const STATUS_START = 'start';

    public const STATUS_SUCCESS = 'success';

    public const STATUS_FAIL = 'fail';

    protected $table = self::DBNAME;

    protected $fillable = [
        'artisan_cmd', 'artisan_output', 'artisan_status',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}
