<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $repository;

    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try{
            $data = $request->input();
            $comments = $this->repository->index($data);

            return response()->success("Comments fetched successfully", compact('comments'));
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $data = $request->input();
            $data['user_id'] = $data['user_id'] ?? Auth::id();

            $this->repository->storeValidation($data)->validate();
            $comment = $this->repository->store($data);
            DB::commit();

            return response()->success("Comment stored successfully", compact("comment"));
        } catch(\Exception $e){
            DB::rollBack();
            DB::commit();
            return $this->handleException($e);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $data = $request->input();
            $data['user_id'] = $data['user_id'] ?? Auth::id();

            $this->repository->updateValidation($data)->validate();
            $comment = $this->repository->update($data, $id);
            DB::commit();

            return response()->success("Comment updated successfully", compact("comment"));
        } catch(\Exception $e){
            DB::rollBack();
            DB::commit();
            return $this->handleException($e);
        }
    }

    public function get($id)
    {
        try{
            $comment = $this->repository->getSingle($id);

            return response()->success("Comment fetched successfully", compact("comment"));
        } catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try{
            $this->repository->delete($id);

            return response()->success("Comment deleted successfully");
        } catch(\Exception $e){
            return $this->handleException($e);
        }
    }
}
