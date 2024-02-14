<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\currentUserId;
use App\Contracts\FeedbackRepositoryInterface;

class FeedbackController extends Controller
{
    private $repository;

    public function __construct(FeedbackRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try{
            $data = $request->input();
            $feedbacks = $this->repository->index($data);

            return response()->success("Feedbacks fetched successfully", compact('feedbacks'));
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $data = $request->input();
            $data['user_id'] = $data['user_id'] ??  Auth::id();

            $this->repository->storeValidation($data)->validate();
            $feedback = $this->repository->store($data);
            DB::commit();

            return response()->success("Feedback stored successfully", compact("feedback"));
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
            $feedback = $this->repository->update($data, $id);
            DB::commit();

            return response()->success("Feedback updated successfully", compact("feedback"));
        } catch(\Exception $e){
            DB::rollBack();
            DB::commit();
            return $this->handleException($e);
        }
    }

    public function get($id)
    {
        try{
            $feedback = $this->repository->getSingle($id);

            return response()->success("Feedback fetched successfully", compact("feedback"));
        } catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try{
            $this->repository->delete($id);

            return response()->success("Feedback deleted successfully");
        } catch(\Exception $e){
            return $this->handleException($e);
        }
    }
}
