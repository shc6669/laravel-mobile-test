<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class Users extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Users'))
            ->route('users.index')
            ->icon('fas fa-users')
            ->active("admin/users*")
            ->permissions('users.manage');
    }
}
