<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommonProblem;

class CommonProblemController extends Controller
{
    public function index(Request $request)
    {
        return view('commonproblem.index', [
            'layout_page' => 'commonproblem'
        ]);

    }

    public function listAjax(Request $request) {

        $search = $request->search;

        $query = CommonProblem::select('common_problem.*')
            ->orderBy('common_problem.created_at', 'ASC');
        if( !empty($search) ) {
            $query->where( function($q) use ($search) {
                $q->where('common_problem.name', 'LIKE', '%'.$search.'%');
            });
        }

        $problems = $query->get();

        if( count($problems) > 0 ) {
            foreach($problems as $key => $problem) {
                $problems[$key]->created = date('d-m-Y H:i', strtotime($problem->created_at) );
            }
        }

        return response()->json([
            'status'=>1,
            'problems'=>$problems,
        ]);
    }

    public function add(Request $request) {

        return view('commonproblem.add', [
            'layout_page' => 'commonproblem'
        ]);
    }
    public function edit(Request $request) {
        if( empty($request->id) ) {
            abort(404);
        }

        $commonproblem = CommonProblem::find($request->id);

        return view('commonproblem.edit', [
            'layout_page' => 'commonproblem',
            'commonproblem' => $commonproblem
        ]);

    }

    public function addSave(Request $request) {

        $commonproblem = new CommonProblem;
        $commonproblem->problem = $request->problem;

        $validate['problem'] = ['required', 'string', 'min:10'];

        $request->validate($validate);

        $commonproblem->save();
        return response()->json([
            'status' => '1',
            'mgs' => 'Add Problem Success'
        ]);
    }

    public function editSave(Request $request) {

        $commonproblem = CommonProblem::find($request->id);
        $commonproblem->problem = $request->problem;

        $validate['problem'] = ['required', 'string', 'min:10'];

        $request->validate($validate);

        $commonproblem->save();

        return response()->json([
            'status' => '1',
            'mgs' => 'Edit Problem Success'
        ]);
    }
}
