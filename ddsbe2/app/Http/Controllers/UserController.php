<?php

namespace App\Http\Controllers;

//use App\User;
use App\Models\User;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class UserController extends Controller
{
    use ApiResponser;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getUsers()
    {


        $users = User::all();

        return response()->json($users, 200);
        return $this->successResponse($users);
    }
    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->successResponse($users);
    }

    public function add(Request $request)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20'
        ];

        $this->validate($request, $rules);
        // $userjob = UserJob::findOrFail($request->jobid);
        $user = User::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one user
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {


        $user = User::where('id', $id)->first();
        if ($user) {
            return $this->successResponse($user);
        } {
            return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
        ];

        $this->validate($request, $rules);
        //$userjob = UserJob::findOrFail($request->jobid);
        $user = User::findOrFail($id);
        $user = User::where('ID', $id)->first();
        if ($user) {
            $user->fill($request->all());

            // if no changes happen
            if ($user->isClean()) {
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $user->save();
            return $this->successResponse($user);
        } {
            return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
    }


    public function delete($id)
    {
        $check = app('db')->select("select * from tbluser where ID = '$id'");
        if (empty($check)) {
        } else {
            $query = app('db')->select("delete from tbluser where ID = '$id'");
        }
        return $this->successResponse("Successfully Deleted!");
    }
}
