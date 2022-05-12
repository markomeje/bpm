<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * Permission resource.
     *
     * @var []
     */
    public static $resources = [
        'payments' => ['actions' => ['view' => 'View payments lists and statistics', 'delete' => 'Delete a payment record'], 'description' => 'All payments information and statistics'],
        'users' => ['actions' => ['delete' => 'Delete any a user', 'view'], 'description' => 'All users data and statistics'],
        'subscriptions' => ['actions' => ['view'], 'description' => 'All subscriptions information and statistics'],
        'units' => ['actions' => ['create', 'view', 'edit', 'delete'], 'description' => 'All units created and purchases'],
        'properties' => ['actions' => ['create', 'view', 'edit', 'delete'], 'description' => 'All properties listed'],
        'blogs' => ['actions' => ['create', 'view', 'edit', 'delete'], 'description' => 'All blog posts and statistics'],
        'countries' => ['actions' => ['create', 'view', 'edit', 'delete'], 'description' => 'All countries data'],
        'news' => ['actions' => ['create', 'view', 'edit', 'delete'], 'description' => 'All news posted and statistics'],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name', 
        'image', 
        'status',
        'category', 
        'quantity', 
        'description',
        'price',
        'reference',
    ];

    /**
     * Permission ACTIONS.
     *
     * @var []
     */
    public static $actions = [
        'view',
        'delete',
        'edit',
        'create',
    ];
}
