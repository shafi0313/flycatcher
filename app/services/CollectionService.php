<?php

namespace App\services;

class CollectionService
{
    public function riderCollectedStatus($status)
    {
        switch ($status) {
            case 'collected':
                return '<div class="badge badge-primary badge-sm">Collected</div>';
            case 'transfer_request':
                return '<div class="badge badge-warning badge-sm">Request For Transfer</div>';
            case 'transferred':
                return '<div class="badge badge-success badge-sm">Transferred</div>';
        }
    }
}
