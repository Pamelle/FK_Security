<?php
    namespace App\Http\Controllers;

    use App\Models\UserJob; // <-- your model is
    use Illuminate\Http\Response; // Response Components
    use App\Traits\ApiResponser; // <-- use to standardized our code

    use Illuminate\Http\Request; // <-- handling http request in lumen
    use DB; // <-- if your not using lumen eloquent you can use DB

    Class UserJobController extends Controller {

        use ApiResponser;
            private $request;
            public function __construct(Request $request){
            $this->request = $request;
        }


        public function index()
        {
            $usersjob = UserJob::all();
            return $this->successResponse($usersjob);

        }

        public function show($jobid)
        {
            $userjob = UserJob::findOrFail($jobid);
            return $this->successResponse($usersjob);
        }
}