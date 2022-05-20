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
        'users' => ['actions' => ['delete' => 'Delete any registered user', 'view' => 'View users lists and statistics'], 'description' => 'All users'],
        'units' => ['actions' => ['create' => 'Create a unit', 'view' => 'View list of all units and statistics', 'edit' => 'Edit created units', 'delete' => 'Delete any unit.'], 'description' => 'All units created and purchases'],
        'properties' => ['actions' => ['view' => 'View all listed properties', 'delete' => 'Delete any listed property', 'edit' => 'Edit property details.'], 'description' => 'All properties'],
        'blogs' => ['actions' => ['create' => 'Create a blog post', 'view' => 'View all blog posts and statistics', 'edit' => 'Edit a blog post record', 'delete' => 'Delete a blog post'], 'description' => 'All blog posts'],
        'payments' => ['actions' => ['view' => 'View payments lists and statistics', 'delete' => 'Delete a payment record'], 'description' => 'All payments'],
        'countries' => ['actions' => ['view' => 'View countries lists and statistics', 'delete' => 'Delete a country.'], 'description' => 'All countries data'],
        'news' => ['actions' => ['create' => 'Create daily news', 'view' => 'View all news', 'edit' => 'Edit any news', 'delete' => 'Delete any news.'], 'description' => 'All news posted'],
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
        'edit',
        'create',
    ];
}
