<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Snack;
use App\Repositories\SnackRepository;

class SnackController extends Controller {

    protected $snacks;

    /**
     * force auth and inject repo
     * @param SnackRepository $snacks injectable repo
     */
    public function __construct(SnackRepository $snacks) {
        $this->middleware('auth');
        $this->snacks = $snacks;
    }

    /**
     * show the basic view
     * @return NULL renders HTML to browser
     */
    public function index() {
        return view('snackList');
    }

    /**
     * Get a list of snacks for a user
     * @param Request $request  Request instance
     * @return string   outputs JSON to browser
     */
    public function getSnackData(Request $request) {
        if ($request->ajax()) {
            $snacks = $this->snacks->userSnacks($request->user());
            return response()->json($snacks);
        }
    }

    /**
     * Save a snack for the user
     * @param Request $request Request instance
     * @return string outputs JSON of snacklist
     */
    public function save(Request $request) {
        if ($request->ajax()) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'quantity' => 'required|numeric'
            ]);

            $newSnack = $this->snacks->addSnack($request);
            
            if($newSnack){
                return $this->getSnackData($request);
            }
            
        }
    }
    
    public function details(Request $request){
        if($request->ajax()){
            $snack = $this->snacks->snackDetails($request->user(),$request->snack);
            return response()->json($snack);
        }
    }

}
