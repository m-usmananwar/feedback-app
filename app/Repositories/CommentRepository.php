<?php
namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Validation\Rule;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function storeValidation($data)
    {
        return Validator::make($data , [
            'commentable_type' => ['required', 'string', Rule::in($this->model::$commentableTypes)],
            'commentable_id' => 'required',
            'user_id' => ['required', 'exists:users,id'],
            'content' => 'required'
        ]);
    }

    public function updateValidation($data)
    {
        return $this->storeValidation($data);
    }
}
