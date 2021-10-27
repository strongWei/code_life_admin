<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\PullRequest;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PullRequestController extends Controller
{
    use HasResourceActions;

    //need to add `Content` identity,　otherwise caught error "Too few arguments"
    /**
     * @param $project_id
     * @param Content $content
     * @return Content
     */
    public function index($project_id,  Content $content): Content
    {
        return $content
            ->title($this->title($project_id))
            ->body($this->grid($project_id));
    }

    /**
     * Create interface.
     *
     * @param $project_id
     * @param Content $content
     *
     * @return Content
     */
    public function create($project_id, Content $content)
    {
        return $content
            ->title($this->title($project_id))
            ->body($this->form($project_id));
    }

    /**
     * Show interface.
     *
     * @param $project_id
     * @param mixed $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($project_id, $id, Content $content)
    {
        return $content
            ->title($this->title($project_id))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param $project_id
     * @param mixed $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($project_id, $id, Content $content)
    {
        return $content
            ->title($this->title($project_id))
            ->body($this->form($project_id)->edit($id));
    }

    public function store($project_id)
    {
        return $this->form($project_id)->store();
    }

    public function update($project_id, $id)
    {
        return $this->form($project_id)->update($id);
    }

    public function destroy($project_id, $id)
    {
        return $this->form($project_id)->destroy($id);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($project_id)
    {
        $grid = new Grid(new PullRequest());
        $grid->model()->where('project_id', $project_id)->orderBy('status')
            ->orderByDesc('priority');

        $grid->column('id', __('Id'));
//        $grid->column('project_id', __('Project id'));
        $grid->column('content', __('Content'));
        $grid->column('status_text', __('Status'))
            ->label([
                'Open' => 'default',
                'Closed' => 'success',
            ]);
        $grid->column('priority_text', __('Priority'))
            ->label([
                'Low' => 'default',
                'Normal' => 'info',
                'Important' => 'warning',
                'Critical' => 'danger',
            ]);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $project_id
     * @return Show
     */
    protected function detail($project_id)
    {
        $show = new Show(PullRequest::findOrFail($project_id));

        $show->field('id', __('Id'));
        $show->field('project_id', __('Project id'));
        $show->field('content', __('Content'));
        $show->field('status_text', __('Status'));
        $show->field('priority_text', __('Priority'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($project_id)
    {
        $form = new Form(new PullRequest());

        $form->text('content', __('Content'))
            ->rules([
                'required',
                'max:400',
            ]);
        $form->radio('status', __('Status'))
            ->options([
            0 => 'Open',
            1 => 'Closed',
            ])
            ->default(0);
        $form->radio('priority', __('Priority'))
            ->options([
                0 => 'Low',
                1 => 'Normal',
                2 => 'Important',
                3 => 'Critical',
            ])
            ->default(1);
        $form->hidden('project_id')->value($project_id);

        return $form;
    }

    private function title($project_id)
    {
        $project = Project::findOrFail($project_id);
        return "Pull requests | $project->name";
    }
}
