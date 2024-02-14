<?php
namespace App\Repositories;

use App\Contracts\FeedbackRepositoryInterface;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;

class FeedbackRepository extends BaseRepository implements FeedbackRepositoryInterface
{
    public function __construct(Feedback $model)
    {
        parent::__construct($model);
    }

    public function storeValidation($data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'exists:users,id'],
            'title' => 'required',
            'category' => 'required',
            'description' => 'required'
        ]);
    }

    public function updateValidation($data)
    {
        return $this->storeValidation($data);
    }
}

