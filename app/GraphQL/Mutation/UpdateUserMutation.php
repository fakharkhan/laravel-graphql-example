<?php

namespace App\GraphQL\Mutation;

use App\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()]
        ];
    }

    public function rules()
    {
        return [
            'id' => ['required']
        ];
    }

    public function resolve($root, $args)
    {

        $user = User::find($args['id']);

        if (!$user) {
            return null;
        }

        $user->update($args);

        return $user;
    }
}
