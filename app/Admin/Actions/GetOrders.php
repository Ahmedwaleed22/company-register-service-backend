<?php

namespace App\Admin\Actions;

use Illuminate\Database\Eloquent\Model;
use OpenAdmin\Admin\Actions\RowAction;

class GetOrders extends RowAction
{
    public $name = 'Get Orders';

    public $icon = 'icon-truck-moving';

    public function href() {
        return '/admin/orders?a8a446bdc2e8d8bd092021b021ba73c3=' . $this->getKey();
    }

}