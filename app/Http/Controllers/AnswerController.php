<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\GroupMenuPermissions;
use App\Menu;
use App\Sheet;
use App\Question;
use App\TimeTable;
use Carbon\Carbon;

class AnswerController extends Controller
{

    public function index($menuid)
    {

        $allAnswers = Answer::all();
        $clients = Sheet::all();
        $questions = Question::where('active', '=', 1)->get();

        return View('admin.Answers.index', compact('allAnswers', 'menuid', 'clients', 'questions'));
    }

    public function answersearch(Request $request)
    {
        $allinfo = $request->all();
        $menuid = $allinfo['menuid'];

        $builder = Answer::where('deleted_at', NULL);

        /*   if (\Auth::user()->type == 1) {
         $builder = TimeTable::where('timeid', 0);
         }
         elseif (\Auth::user()->type == 0) {
         $builder = TimeTable::select("time_tables.*")->join('users', 'users.id', '=', 'time_tables.employee')
         ->where('timeid', 0)->where(function ($q) {
         $q->where('employee', '=', \Auth::user()->id)->orWhere("users.managerid", \Auth::user()->id)
         ->orWhere("user_id", \Auth::user()->id);
         });
         }*/
        if (!empty($allinfo['customer_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('answers.customer_id', '=', $allinfo['customer_id']);
            });
        }
        if (!empty($allinfo['question_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('answers.question_id', '=', $allinfo['question_id']);
            });
        }


        $allAnswers = $builder->orderBy('answers.id', 'DESC')->get();
        $clients = Sheet::all();
        $questions = Question::where('active', '=', 1)->get();

        return View('admin.Answers.index', compact('allAnswers', 'menuid', 'clients', 'questions'));


    }

    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        $clients = Sheet::all();
        $questions = Question::where('active', '=', 1)->get();
        $operations = TimeTable::all();
        /* foreach ($clients as $client) {
         $operations=TimeTable::where('sheet_id','=',$client->id)
         }*/
        return View('admin.Answers.add', compact('allmenus', 'menuid', 'clients', 'questions', 'operations'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $questions = Question::where('active', '=', 1)->get();
        // $validate_array = ['answer' => 'required: answers'];
        /*   $validate_array = ['name' => 'required'];
         for ($i = 1; $i < count($questions) + 1; $i++) {
         $validate_array['answer_' . $i] = 'required';
         }
         //  dd($validate_array);
         $this->validate($request, $validate_array);*/
        //dd($validate_array);
        for ($i = 1; $i < count($questions) + 1; $i++) {
            $newAnswer = new Answer();
            /*   $this->validate(
             $request,
             ['answer' => 'required|unique: answers']
             );*/
            $newAnswer->customer_id = $data['customer_id'];
            $newAnswer->operation_id = $data['operation_id'];
            $newAnswer->question_id = Question::where('question', $data['question_id' . $i])->first()->id;
            $newAnswer->answer = $data['answer_' . $i];
            $newAnswer->notes = $data['notes'];

            // $validate_array['answer_' . $i] = 'required'; //$data['answer' . $i]; //
            //  dd($validate_array);
            //$this->validate($request, $validate_array);
            $newAnswer->save();
        }
        //  return redirect()->route('Answer.index', $data['menuid']);
        return redirect()->route('home');

    }
    /**
     * Question Name
     * Count of answers
     *  Answer Rate
     * @param Request $request
     * @param Answer $Answer
     * @return mixed
     */

    public function report($menuid)
    {
        $currentTime = Carbon::now();

        //  $builder = Answer::join('questions', 'questions.id', '=', 'answers.question_id');
        $builder = \DB::table('answers')->select('answers.question_id', 'questions.question', 'questions.question_type')
            ->join('questions', 'questions.id', '=', 'answers.question_id');
        //  $allanswers = $builder->groupBy('answers.question_id')->get();
        $allanswersgrouped = $builder->groupBy('answers.question_id')->groupBy('questions.question')->groupBy('questions.question_type')->get();

        // dd($allanswersgrouped);
        //   $count = 0;
        $truefalsevalue = 0;
        $truefalsecount = 0;
        $ratingcount = 0;
        $ratingvalue = 0;
        $dynmicdate = $currentTime->toDateTimeString();
        //   $allanswers = Answer::join('questions', 'questions.id', '=', 'answers.question_id')->orderBy('answers.id')->get();

        foreach ($allanswersgrouped as $answerg) {
            $truefalsevalue = 0;
            $truefalsecount = 0;
            $ratingcount = 0;
            $ratingvalue = 0;
            $allanswers = \DB::table('answers')->select('answers.*', 'questions.question', 'questions.question_type')
                ->join('questions', 'questions.id', '=', 'answers.question_id')->where('questions.id', '=', $answerg->question_id)
                ->orderBy('answers.id')->get();

            $question = $answerg->question;
            foreach ($allanswers as $answer) {
                // if ($answerg->question_type == "True/False Question" && $answer->answer == 1)
                //    $truecount++;
                if ($answerg->question_type == "True/False Question") {
                    $truefalsevalue += $answer->answer;
                    $answerg->truefalsevalue = $truefalsevalue;
                    $truefalsecount++;
                    $answerg->truefalsecount = $truefalsecount;
                }
                if ($answerg->question_type == "Rating") {
                    $ratingcount++;
                    $answerg->ratingcount = $ratingcount;
                    $ratingvalue += $answer->answer;
                    $answerg->ratingvalue = $ratingvalue;
                }

            }

        }
        return View('admin.Answers.report', compact('menuid', 'allanswersgrouped'));
    }
    public function update(Request $request, Answer $Answer)
    {
        $data = $request->all();

        $Answer->name = $data['name'];

        // $Answer->notes = $data['notes'];

        $Answer->save();


        return redirect()->route('Answer.index', $data['menuid']);
    }
    public function edit(Answer $Answer, $menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Answers.edit', compact('allmenus', 'Answer', 'menuid'));

    }

    public function destory(Answer $answer, $menuid)
    {
        Answer::where('id', '=', $answer->id)->delete();
        $answer->delete();

        return redirect()->route('answer.index', $menuid);

    }
}
