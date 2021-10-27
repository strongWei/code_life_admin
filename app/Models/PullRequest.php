<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PullRequest extends Model
{
    use HasFactory;

    protected $appends = [
        'status_text',
        'priority_text'
    ];

    public function getStatusTextAttribute(){
        switch ($this->status) {
            case 0:
                return 'Open';
            case 1:
                return 'Closed';
        }
    }

    public function getPriorityTextAttribute(){
        switch ($this->priority) {
            case 0:
                return 'Low';
            case 1:
                return 'Normal';
            case 2:
                return 'Important';
            case 3:
                return 'Critical';
        }
    }
}
