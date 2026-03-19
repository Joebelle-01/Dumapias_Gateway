<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\User1Service;

class User1Controller extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the User1 Microservice
     * @var User1Service
     */
    public $user1Service;

    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct(User1Service $user1Service)
    {
        $this->user1Service = $user1Service;
    }

    /**
     * Return the list of users from Site 1
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->user1Service->obtainUsers1());
    }

    /**
     * Create new user in Site 1
     * @return Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        return $this->successResponse(
            $this->user1Service->createUser1($request->all()), 
            Response::HTTP_CREATED
        );
    }

    /**
     * Show single user from Site 1
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->user1Service->obtainUser1($id));
    }

    /**
     * Update user in Site 1
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->successResponse(
            $this->user1Service->editUser1($request->all(), $id)
        );
    }

    /**
     * Delete user from Site 1
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->successResponse($this->user1Service->deleteUser1($id));
    }
}