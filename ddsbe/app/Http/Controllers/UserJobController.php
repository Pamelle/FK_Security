<?php
    namespace App\Http\Controllers;

    use App\Models\UserJob;
    use App\Models\User; // <-- your model is
    use Illuminate\Http\Response; // Response Components
    use App\Traits\ApiResponser; // <-- use to standardized our code

    use Illuminate\Http\Request; // <-- handling http request in lumen
    use DB; // <-- if your not using lumen eloquent you can use DB

class UserJobController extends Controller
{
      use ApiResponser;
    //
private $request;

    function __construct(Request $request){
        $this->request = $request;
    }

    public function index(){
        $table = UserJob::all();
       return $this->successResponse($table);
    }

    public function create(Request $request){

        $validate = User::findOrFail($request->user_id);

        $user = UserJob::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }
    public function show($id){
       $userjob = UserJob::findOrFail($id);
       return $this->successResponse($userjob);
    }
    public function update(Request $request, $id){
        
       
        $user = UserJob::findOrFail($id);

        $user = UserJob::where('id', $id)->first();
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

    public function destroy($id){
       $check = app('db')->select("select * from tbluserjob where id = '$id'");
        if (empty($check)) {
            return ['message' => 'No ID Found!','data' => $id];
        } else {
            $query = app('db')->select("delete from tbluserjob where id = '$id'");
            return ['message' => 'Successfully deleted!','id' => $check];
        }

    }


    
}
