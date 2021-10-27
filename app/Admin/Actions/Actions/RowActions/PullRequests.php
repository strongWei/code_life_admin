<?php

namespace App\Admin\Actions\Actions\RowActions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class PullRequests extends RowAction
{
    public $name = 'Pull requests';

    // redirect to pull requests
    public function handle() {
        //get project's id
        //TODO: url incorrect
        return $this->response()->open("project/{$this->row->id}/pull_requests");
    }
}
