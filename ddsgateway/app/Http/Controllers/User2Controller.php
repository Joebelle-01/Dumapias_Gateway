<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\User2Service;

class User2Controller extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the User2 Microservice
     * @var User2Service
     */
    public $user2Service;

    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct(User2Service $user2Service)
    {
        $this->user2Service = $user2Service;
    }

    /**
     * Return the list of users from Site 2
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->user2Service->obtainUsers2());
    }

    /**
     * Create new user in Site 2
     * @return Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        return $this->successResponse(
            $this->user2Service->createUser2($request->all()), 
            Response::HTTP_CREATED
        );
    }

    /**
     * Show single user from Site 2
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->user2Service->obtainUser2($id));
    }

    /**
     * Update user in Site 2
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->successResponse(
            $this->user2Service->editUser2($request->all(), $id)
        );
    }

    /**
     * Delete user from Site 2
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->successResponse($this->user2Service->deleteUser2($id));
    }
}