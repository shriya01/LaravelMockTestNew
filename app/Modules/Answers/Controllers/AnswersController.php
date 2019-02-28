<?php

namespace App\Modules\Answers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Crypt,Validator;
use App\Models\Answers;

class AnswersController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAnswer($id)
    {  
        $data['id'] = $id;
        $id = Crypt::decrypt($id);
        $this->answerObj = new Answers;
        $data['answers'] = $this->answerObj->getAnswers($id)->toArray();
        return view("Answers::add",$data);
    }
}
