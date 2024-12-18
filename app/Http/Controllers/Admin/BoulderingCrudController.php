<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Bouldering;

class BoulderingCrudController extends CrudController
{
    public function setup()
    {
        CRUD::setModel(Bouldering::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bouldering');
        CRUD::setEntityNameStrings('bouldering', 'bouldering');

        CRUD::addField([
            'name' => 'name',
            'label' => 'Boulder Name',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Boulder Name',
        ]);
    }
}
