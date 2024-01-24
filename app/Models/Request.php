<?php

namespace App\Models;

use App\Http\Requests\FilterRequestsRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'status',
        'message',
        'comment',
        'updated_at'
    ];

    public function scopeFiltered(Builder $query, FilterRequestsRequest $filterBy = null)
    {

        if ($filterBy !== []) {
            $filter = $filterBy['filterBy'];

            return match ($filter) {
                "byDate" => $query->orderBy('created_at', 'ASC'),
                "byStatusResolved" => $query->where('status', '=', 'Resolved'),
                "byStatusActive" => $query->where('status', '=', 'Active'),
                default => $query,
            };
        }
    }
}
