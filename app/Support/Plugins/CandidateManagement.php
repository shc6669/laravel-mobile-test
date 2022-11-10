<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class CandidateManagement extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Candidate Management'))
            ->route('candidate-management.index')
            ->icon('fas fa-address-card')
            ->active("admin/candidate-management*")
            ->permissions('candidate.list.show');
    }
}
