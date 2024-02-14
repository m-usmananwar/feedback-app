<?php
namespace App\Contracts;

interface CommentRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function update(array $data, $id);
    public function getSingle($id);
    public function delete($id);
    public function storeValidation($data);
    public function updateValidation($data);
}
