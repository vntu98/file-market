<?php

namespace App;

use App\Traits\HasApprovals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes, HasApprovals;

    const APPROVAL_PROPERTIES = [
        'title',
        'overview_short',
        'overview'
    ];

    protected $guarded = [];

    protected $casts = [
        'finished' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($file) {
            $file->identifier = uniqid(true);
        });
    }

    public function getRouteKeyName()
    {
        return 'identifier';
    }

    public function visible()
    {
        if ($this->user->isAdmin()) {
            return true;
        }

        if (auth()->user()->isTheSameAs($this->user->id)) {
            return true;
        }

        return $this->live && $this->approved;
    }

    public function isTheSameAs(User $user)
    {
        return $this->id === $user->id;
    }

    public function approve()
    {
        $this->approveAllUploads();
        $this->updateToBeVisible();
    }

    public function approveAllUploads()
    {
        $this->uploads()->update([
            'approved' => true
        ]);
    }

    public function updateToBeVisible()
    {
        $this->update([
            'live' => true,
            'approved' => true
        ]);
    }

    public function mergeApprovalProperties()
    {
        $this->update(array_only($this->approvals->first()->toArray(), self::APPROVAL_PROPERTIES));
    }

    public function deleteAllApprovals()
    {
        $this->approvals()->delete();
    }

    public function deleteUnapprovedUploads()
    {
        $this->uploads()->unapproved()->delete();
    }

    public function scopeFinished(Builder $query)
    {
        return $query->where('finished', true);
    }

    public function isFree()
    {
        return $this->price === 0;
    }

    public function approvals()
    {
        return $this->hasMany(FileApproval::class);
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    public function needsApproval(array $approvalProperties)
    {
        if ($this->currentPropertiesDifferToGiven($approvalProperties)) {
            return true;
        }

        if ($this->uploads->unapproved()->count()) {
            return true;
        }

        return false;
    }

    protected function currentPropertiesDifferToGiven(array $properties)
    {
        return array_only($this->toArray(), self::APPROVAL_PROPERTIES) != $properties;
    }

    public function createApproval(array $approvalProperties)
    {
        $this->approvals()->create($approvalProperties);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
