<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TechniqueRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TechniqueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TechniqueCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Technique::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/technique');
        CRUD::setEntityNameStrings('technique', 'techniques');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name')->label('Technique Name')->type('text');
        CRUD::column('description')->label('Description')->type('textarea');
        CRUD::column('difficulty_level')->label('Difficulty')->type('text');
        CRUD::column('steps_to_practice')->label('Steps to Practice')->type('text');
        CRUD::column('image')->label('Image')->type('image');

        // $this->crud->addFilter([
        //     'name' => 'difficulty_level',
        //     'type' => 'dropdown',
        //     'label' => 'Difficulty',
        // ],
        // [
        //     'Beginner' => 'Beginner',
        //     'Intermediate' => 'Intermediate',
        //     'Advanced' => 'Advanced',
        // ], function ($value) {
        //     $this->crud->addClause('where', 'difficulty_level', $value);
        // });
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TechniqueRequest::class);

        CRUD::field('name')->label('Technique Name')->type('text');
        CRUD::field('description')->label('Description')->type('textarea');
        CRUD::field('difficulty_level')->label('Difficulty')->type('select_from_array')->options([
            'Beginner' => 'Beginner',
            'Intermediate' => 'Intermediate',
            'Advanced' => 'Advanced'
        ]);
        CRUD::field('steps_to_practice')->label('Steps to Practice')->type('textarea');
        CRUD::field('image')->label('Image')->type('upload')->upload(true)->disk('public');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
