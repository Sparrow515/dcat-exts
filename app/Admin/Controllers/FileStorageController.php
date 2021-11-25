<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\FileStorage;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class FileStorageController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new FileStorage(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('url');
            $grid->column('note');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id): Show
    {
        return Show::make($id, new FileStorage(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('url');
            $show->field('note');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        return Form::make(new FileStorage(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('url');
            $form->text('note');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
