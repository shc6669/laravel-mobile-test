<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class MasterData extends Plugin
{
    public function sidebar()
    {
        $skills = Item::create(__('Skills'))
            ->route('skills.index')
            ->active('admin/master-data/skills*')
            ->permissions('master-data.manage');

        $qualifications = Item::create(__('Education Qualifications'))
            ->route('qualifications.index')
            ->active('admin/master-data/qualifications*')
            ->permissions('master-data.manage');

        return Item::create(__('Master Data'))
            ->href('#master-data-dropdown')
            ->icon('fas fa-database')
            ->permissions(['master-data.manage'])
            ->addChildren([
                $skills,
                $qualifications
            ]);
    }
}
