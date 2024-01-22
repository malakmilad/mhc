<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\GroupMenuPermissions;
use App\Menu;


class QuestionController extends Controller
{

    public function index($menuid)
    {
        $allQuestions = Question::all();
        return View('admin.Questions.index', compact('allQuestions', 'menuid'));
    }

    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Questions.add', compact('allmenus', 'menuid'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $newQuestion = new Question();
        if (!empty($request->question))
        // $newQuestion->question = $data["question"];
        {
            $newQuestion->question = $request->question . "";
        }
        if (!empty($request->question_type)) {
            //  $newQuestion->question_type = $data["question_type"];
            $newQuestion->question_type = $request->question_type;
        }
        if (!empty($request->answer))
            // $newQuestion->answer = $data["answer"];
            $newQuestion->answer = $request->answer;
        if (!empty($request->active))
            $newQuestion->active = $request->active;
        $newQuestion->save();

        return redirect()->route('question.index', $data['menuid']);
    }
    public function update(Request $request, Question $Question)
    {
        $data = $request->all();

        $Question->question = $data['question'];
        $Question->question_type = $data['question_type'];
        if (!empty($data['answer']))
            $Question->answer = $data['answer'];
        if ($data['active'] == "on")
            $Question->active = 1;
        else
            $Question->active = 0;

        $Question->save();


        return redirect()->route('question.index', $data['menuid']);
    }
    public function edit(Question $question, $menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Questions.edit', compact('allmenus', 'question', 'menuid'));

    }

    public function destory(Question $question, $menuid)
    {

        Question::where('id', '=', $question->id)->delete();
        $question->delete();

        return redirect()->route('question.index', $menuid);

    }
}
