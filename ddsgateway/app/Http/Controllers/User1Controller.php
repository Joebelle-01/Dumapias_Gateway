<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponder;
use App\Services\User1Service;
use Illuminate\Http\Response;

class User1Controller extends Controller
{
    use ApiResponder;

    public $user1Service;

    public function __construct(User1Service $user1Service)
    {
        $this->user1Service = $user1Service;
    }

    public function index()
    {
        try {
            $users = $this->user1Service->obtainUsers1();
            return $this->successResponse($users);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    public function add(Request $request)
    {
        return $this->successResponse($this->user1Service->createUser1($request->all()), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return $this->successResponse($this->user1Service->obtainUser1($id));
    }

    public function update(Request $request, $id)
    {
        return $this->successResponse($this->user1Service->editUser1($request->all(), $id));
    }

    public function delete($id)
    {
        return $this->successResponse($this->user1Service->deleteUser1($id));
    }
}