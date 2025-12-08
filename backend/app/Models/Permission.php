<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\PermissionFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @method static Builder|static global()
 * @method static Builder|static system()
 * @method static Builder|static module()
 */
final class Permission extends Model
{
    /** @use HasFactory<PermissionFactory> */
    use HasFactory, HasUlids;

    public $timestamps = false;

    /**
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'id' => 'string',
            'name' => 'string',
        ];
    }

    #[Scope]
    protected function global(Builder $query): void
    {
        $query->where('scope', 'global');
    }

    #[Scope]
    protected function system(Builder $query): void
    {
        $query->where('scope', 'system');
    }

    #[Scope]
    protected function module(Builder $query): void
    {
        $query->where('scope', 'module');
    }
}
