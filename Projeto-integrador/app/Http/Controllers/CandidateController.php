<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateVacancies;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{

    public function index(){
        
        $vacancies  = Vacancy::orderBy('created_at', 'desc')->get();
        return view("candidate_portal",["vacancies"=>$vacancies]);
    }

    public function create(Request $request){
        
        $candidate = new Candidate();
        if ($request->hasFile("curriculum")){
            $curriculum = $request->file("curriculum");
            $curriculum_name = time()."_".$curriculum->getClientOriginalName();
            $curriculum->move(public_path("assets/curriculum"),$curriculum_name);
            $curr = $curriculum_name;
            
        }

        $candidate->pdf_candidate = $curr;
        $candidate->name = $request->input('name');
        $candidate->email = $request->input('email');
        
        $candidate->save();

        $vacanciesList = Vacancy::all();

        $candidate_vacancies = new CandidateVacancies();


        $candidate_vacancies->candidate_id = $candidate->id;
        $candidate_vacancies->vacancy_id = $request->vaga_id;
        $candidate_vacancies->save();
      

        $vacancies  = Vacancy::paginate(10);
        session()->flash('CANDIDATADO COM SUCESSO! ');
        return back()->with('sucess','CANDIDATADO COM SUCESSO! ');
        #return view("candidate_portal",["vacancies"=>$vacancies])->with('sucess','CANDIDATADO COM SUCESSO! ');
    }

}
