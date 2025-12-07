<?php 

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface 
{
    public function getUserById($id);
    public function getAllUsers();
    public function createUser(array $data);
    public function updateUser($id, array $data);
    public function deleteUser($id);
}