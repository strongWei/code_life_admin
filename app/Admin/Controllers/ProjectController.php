<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Actions\RowActions\PullRequests;
use App\Models\Project;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Project';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Project());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('detail', __('Detail'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        //actions
        $grid->actions(function ($actions){
            $actions->add(new PullRequests());
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Project::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('detail', __('Detail'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Project());

        $form->text('name', __('Name'))
            ->creationRules(['required', "unique:projects", 'max:40'])
            ->updateRules(['required', "unique:projects,name,{{id}}", 'max:40']);
        $form->text('detail', __('Detail'))
            ->rules(['max:255']);

        return $form;
    }
}
