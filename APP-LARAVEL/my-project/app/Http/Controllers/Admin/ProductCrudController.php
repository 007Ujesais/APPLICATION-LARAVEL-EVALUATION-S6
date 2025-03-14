<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductCrudController extends CrudController
{
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Nom']);
        CRUD::addColumn(['name' => 'model', 'type' => 'text', 'label' => 'Modèle']);
        CRUD::addColumn(['name' => 'price', 'type' => 'number', 'label' => 'Prix']);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        CRUD::addField(['name' => 'name', 'type' => 'text', 'label' => 'Nom']);
        CRUD::addField(['name' => 'model', 'type' => 'text', 'label' => 'Modèle']);
        CRUD::addField(['name' => 'price', 'type' => 'number', 'label' => 'Prix']);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
