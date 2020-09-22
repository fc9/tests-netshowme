<?php

namespace App\Models;

use App\Events\ContactCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'attachment',
        'ip'
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ContactCreated::class
    ];

    /**
     * @param string $date
     * @return string
     */
    public function getCreatedAtAttribute(string $date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y à\s H:i');
    }

    /**
     * @param string $date
     * @return string
     */
    public function getUpdatedAtAttribute(string $date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y à\s H:i');
    }
}
