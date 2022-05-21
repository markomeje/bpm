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
        'users' => ['actions' => ['delete' => 'Delete any registered user', 'view' => 'View users lists and statistics'], 'description' => 'All users list and statistics'],
        'subscriptions' => ['actions' => ['view' => 'View subscptions statistics and records'], 'description' => 'All subscriptions information and statistics'],
        'units' => ['actions' => ['create' => 'Create a unit to be sold', 'view' => 'View list of all units and statistics', 'update' => 'Update created units', 'delete' => 'Delete any unit.'], 'description' => 'All units created and purchases'],
        'properties' => ['actions' => ['view' => 'View all listed properties', 'delete' => 'Delete any listed property'], 'description' => 'All properties listed', 'update' => 'Update property details.'],
        'blogs' => ['actions' => ['create' => 'Create a blog post', 'view' => 'View all blog posts and statistics', 'update' => 'Update a blog post record', 'delete' => 'Delete a blog post'], 'description' => 'All blog posts and statistics'],
        'countries' => ['actions' => ['view' => 'View countries lists and statistics', 'delete' => 'Delete a country.'], 'description' => 'All countries data'],
        'news' => ['actions' => ['create' => 'Create daily news', 'view' => 'View all news', 'update' => 'Update any news', 'delete' => 'Delete any news.'], 'description' => 'All news posted and statistics'],
        'contents' => ['actions' => ['update' => 'Update page content'], 'description' => 'All frontend contents'],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'resource', 
        'description',
        'permission',
        'permitted_by'
    ];

    /**
     * Permission ACTIONS.
     *
     * @var []
     */
    public static $actions = [
        'view',
        'delete',
        'update',
        'create',
    ];
}
