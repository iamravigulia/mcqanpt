<?php

namespace edgewizz\mcqanpt\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Edgewizz\Edgecontent\Models\ProblemSetQues;
use Edgewizz\Mcqanpt\Models\McqanptAns;
use Edgewizz\Mcqanpt\Models\McqanptQues;
use Illuminate\Http\Request;

class McqanptController extends Controller
{
    public function store(Request $request)
    {
        $pmQ = new McqanptQues();
        $pmQ->question = $request->question;
        $pmQ->format_title = $request->format_title;
        $pmQ->difficulty_level_id = $request->difficulty_level_id;
        $pmQ->hint = $request->hint;
        $pmQ->save();
        /* answer1 */
        if ($request->answer_media_1) {
            $answer_1 = new McqanptAns();
            $answer_1->question_id = $pmQ->id;
            $answer_1->answer = $request->answer_1;
            $media = new Media();
            $request->answer_media_1->storeAs('public/answers', time() . $request->answer_media_1->getClientOriginalName());
            $media->url = 'answers/' . time() . $request->answer_media_1->getClientOriginalName();
            $media->save();
            $answer_1->media_id = $media->id;
            if ($request->ans_correct_1) {
                $answer_1->arrange = 1;
            }
            $answer_1->eng_word = $request->eng_word1;
            $answer_1->save();
        }
        /* //answer1 */
        /* answer2 */
        if ($request->answer_media_2) {
            $answer_2 = new McqanptAns();
            $answer_2->question_id = $pmQ->id;
            $answer_2->answer = $request->answer_2;
            $media = new Media();
            $request->answer_media_2->storeAs('public/answers', time() . $request->answer_media_2->getClientOriginalName());
            $media->url = 'answers/' . time() . $request->answer_media_2->getClientOriginalName();
            $media->save();
            $answer_2->media_id = $media->id;
            if ($request->ans_correct_2) {
                $answer_2->arrange = 1;
            }
            $answer_2->eng_word = $request->eng_word2;
            $answer_2->save();
        }
        /* //answer2 */
        /* answer3 */
        if ($request->answer_media_3) {
            $answer_3 = new McqanptAns();
            $answer_3->question_id = $pmQ->id;
            $answer_3->answer = $request->answer_3;
            $media = new Media();
            $request->answer_media_3->storeAs('public/answers', time() . $request->answer_media_3->getClientOriginalName());
            $media->url = 'answers/' . time() . $request->answer_media_3->getClientOriginalName();
            $media->save();
            $answer_3->media_id = $media->id;
            if ($request->ans_correct_3) {
                $answer_3->arrange = 1;
            }
            $answer_3->eng_word = $request->eng_word3;
            $answer_3->save();
        }
        /* //answer3 */
        /* answer4 */
        if ($request->answer_media_4) {
            $answer_4 = new McqanptAns();
            $answer_4->question_id = $pmQ->id;
            $answer_4->answer = $request->answer_4;
            $media = new Media();
            $request->answer_media_4->storeAs('public/answers', time() . $request->answer_media_4->getClientOriginalName());
            $media->url = 'answers/' . time() . $request->answer_media_4->getClientOriginalName();
            $media->save();
            $answer_4->media_id = $media->id;
            if ($request->ans_correct_4) {
                $answer_4->arrange = 1;
            }
            $answer_4->eng_word = $request->eng_word4;
            $answer_4->save();
        }
        /* //answer4 */
        /* answer5 */
        if ($request->answer_media_5) {
            $answer_5 = new McqanptAns();
            $answer_5->question_id = $pmQ->id;
            $answer_5->answer = $request->answer_5;
            $media = new Media();
            $request->answer_media_5->storeAs('public/answers', time() . $request->answer_media_5->getClientOriginalName());
            $media->url = 'answers/' . time() . $request->answer_media_5->getClientOriginalName();
            $media->save();
            $answer_5->media_id = $media->id;
            if ($request->ans_correct_5) {
                $answer_5->arrange = 1;
            }
            $answer_5->eng_word = $request->eng_word5;
            $answer_5->save();
        }
        /* //answer5 */
        /* answer6 */
        if ($request->answer_media_6) {
            $answer_6 = new McqanptAns();
            $answer_6->question_id = $pmQ->id;
            $answer_6->answer = $request->answer_6;
            $media = new Media();
            $request->answer_media_6->storeAs('public/answers', time() . $request->answer_media_6->getClientOriginalName());
            $media->url = 'answers/' . time() . $request->answer_media_6->getClientOriginalName();
            $media->save();
            $answer_6->media_id = $media->id;
            if ($request->ans_correct_6) {
                $answer_6->arrange = 1;
            }
            $answer_6->eng_word = $request->eng_word6;
            $answer_6->save();
        }
        /* //answer6 */
        if($request->problem_set_id && $request->format_type_id){
            $pbq = new ProblemSetQues();
            $pbq->problem_set_id = $request->problem_set_id;
            $pbq->question_id = $pmQ->id;
            $pbq->format_type_id = $request->format_type_id;
            $pbq->save();
        }
        return back();
    }
    public function imagecsv($question_image, $images){
        foreach($images as $valueImage){
            $uploadImage = explode(".", $valueImage->getClientOriginalName());
            if($uploadImage[0] == $question_image){
                // dd($valueImage);
                $media = new Media();
                $valueImage->storeAs('public/question_images', time() . $valueImage->getClientOriginalName());
                $media->url = 'question_images/' . time() . $valueImage->getClientOriginalName();
                $media->save();
                return $media->id;
            }
        }
    }
    public function csv_upload(Request $request){
        $file = $request->file('file');
        $images = $request->file('images');
        $audio = $request->file('audio');
        // dd($images);
        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        // Valid File Extensions
        $valid_extension = array("csv");
        // 2MB in Bytes
        $maxFileSize = 2097152;
        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads';
                // Upload file
                $file->move($location, $filename);
                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);
                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    $insertData = array(
                        "question"      => $importData[1],
                        "answer1"       => $importData[2],
                        "image1"        => $importData[3],
                        "arrange1"      => $importData[4],
                        "eng_word1"     => $importData[5],

                        "answer2"       => $importData[6],
                        "image2"        => $importData[7],
                        "arrange2"      => $importData[8],
                        "eng_word2"     => $importData[9],

                        "answer3"       => $importData[10],
                        "image3"        => $importData[11],
                        "arrange3"      => $importData[12],
                        "eng_word3"     => $importData[13],

                        "answer4"       => $importData[14],
                        "image4"        => $importData[15],
                        "arrange4"      => $importData[16],
                        "eng_word4"     => $importData[17],

                        "level"         => $importData[18],
                        "comment"       => $importData[19],

                    );
                    // var_dump($insertData['answer1']);
                    /*  */
                    if ($insertData['question']) {
                        $fill_Q = new McqanptQues();
                        $fill_Q->question = $insertData['question'];
                        if($request->format_title){
                            $fill_Q->format_title = $request->format_title;
                        }
                        if ($insertData['comment']) {
                            $fill_Q->hint = $insertData['comment'];
                        }
                        if(!empty($insertData['level'])){
                            if($insertData['level'] == 'easy'){
                                $fill_Q->difficulty_level_id = 1;
                            }else if($insertData['level'] == 'medium'){
                                $fill_Q->difficulty_level_id = 2;
                            }else if($insertData['level'] == 'hard'){
                                $fill_Q->difficulty_level_id = 3;
                            }
                        }
                        $fill_Q->save();
                        if($request->problem_set_id && $request->format_type_id){
                            $pbq = new ProblemSetQues();
                            $pbq->problem_set_id = $request->problem_set_id;
                            $pbq->question_id = $fill_Q->id;
                            $pbq->format_type_id = $request->format_type_id;
                            $pbq->save();
                        }

                        for ($x = 1; $x <= 4; $x++) {
                            $f_answer  = $insertData['answer'.$x];
                            $f_arrange  = $insertData['arrange'.$x];
                            $f_eng_word  = $insertData['eng_word'.$x];
                            $f_image  = $insertData['image'.$x];
                            
                            if ($f_answer == '-') {
                            } else {
                                $f_Ans1 = new McqanptAns();
                                $f_Ans1->question_id = $fill_Q->id;
                                $f_Ans1->answer = $f_answer;
                                if (!empty($f_image) && $f_image != '') {
                                    $media_id = $this->imagecsv($f_image, $images);
                                    $f_Ans1->media_id = $media_id;
                                }
                                $f_Ans1->arrange = $f_arrange;
                                if ($f_eng_word == '-') {
                                } else {
                                    $f_Ans1->eng_word = $f_eng_word;
                                }
                                $f_Ans1->save();
                            }
                        }
                        
                        /* if ($insertData['answer2'] == '-') {
                        } else {
                            $f_Ans2 = new McqanptAns();
                            $f_Ans2->question_id = $fill_Q->id;
                            $f_Ans2->answer = $insertData['answer2'];
                            if (!empty($insertData['image2']) && $insertData['image2'] != '') {
                                $media_id = $this->imagecsv($insertData['image2'], $images);
                                $f_Ans2->media_id = $media_id;
                            }
                            // $m = new Media();
                            // $m->url = $insertData['image2'];
                            // $m->save();
                            // $f_Ans2->media_id = $m->id;
                            $f_Ans2->arrange = $insertData['arrange2'];
                            $f_Ans2->save();
                        }
                        if ($insertData['answer3'] == '-') {
                        } else {
                            $f_Ans3 = new McqanptAns();
                            $f_Ans3->question_id = $fill_Q->id;
                            $f_Ans3->answer = $insertData['answer3'];
                            if (!empty($insertData['image3']) && $insertData['image3'] != '') {
                                $media_id = $this->imagecsv($insertData['image3'], $images);
                                $f_Ans3->media_id = $media_id;
                            }
                            // $m = new Media();
                            // $m->url = $insertData['image3'];
                            // $m->save();
                            // $f_Ans3->media_id = $m->id;
                            $f_Ans3->arrange = $insertData['arrange3'];
                            $f_Ans3->save();
                        }
                        if ($insertData['answer4'] == '-') {
                        } else {
                            $f_Ans4 = new McqanptAns();
                            $f_Ans4->question_id = $fill_Q->id;
                            $f_Ans4->answer = $insertData['answer4'];
                            if (!empty($insertData['image4']) && $insertData['image4'] != '') {
                                $media_id = $this->imagecsv($insertData['image4'], $images);
                                $f_Ans4->media_id = $media_id;
                            }
                            // $m = new Media();
                            // $m->url = $insertData['image4'];
                            // $m->save();
                            // $f_Ans4->media_id = $m->id;
                            $f_Ans4->arrange = $insertData['arrange4'];
                            $f_Ans4->save();
                        } */
                    }
                    /*  */
                }
                // Session::flash('message', 'Import Successful.');
            } else {
                // Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            // Session::flash('message', 'Invalid File Extension.');
        }
        return back();
    }

    public function update($id, Request $request){
        $q = McqanptQues::where('id', $id)->first();
        // dd($q);
        if($request->format_title){
            $q->format_title = $request->format_title;
        }
        $q->question = $request->question;
        $q->difficulty_level_id = $request->difficulty_level_id;
        $q->hint = $request->hint;
        // $q->level_id = $request->question_level;
        // $q->score = $request->question_score;
        // $q->hint = $request->question_hint;
        $q->save();
        $answers = McqanptAns::where('question_id', $q->id)->get();
        foreach($answers as $ans){
            $inputAnswer = 'answer'.$ans->id;
            $inputArrange = 'ans_correct'.$ans->id;
            $inputMedia = 'answer_media_'.$ans->id;
            $inputEngWord = 'eng_word'.$ans->id;
            $ans->answer = $request->$inputAnswer;
            $ans->eng_word = $request->$inputEngWord;
            if($request->$inputArrange){
                $ans->arrange = 1;
            }else{
                $ans->arrange = 0;
            }
            if($request->$inputMedia){
                $media = new Media();
                $request->$inputMedia->storeAs('public/answers', time() . $request->$inputMedia->getClientOriginalName());
                $media->url = 'answers/' . time() . $request->$inputMedia->getClientOriginalName();
                $media->save();
                $ans->media_id = $media->id;
            }
            $ans->save();
        }
        return back();
    }

    public function delete($id){
        $f = McqanptQues::where('id', $id)->first();
        $f->delete();
        $ans = McqanptAns::where('question_id', $f->id)->pluck('id');
        if($ans){
            foreach($ans as $a){
                $f_ans = McqanptAns::where('id', $a)->first();
                $f_ans->delete();
            }
        }
        return back();
    }
    public function inactive($id){
        $f = McqanptQues::where('id', $id)->first();
        $f->active = '0';
        $f->save();
        return back();
    }
    public function active($id){
        $f = McqanptQues::where('id', $id)->first();
        $f->active = '1';
        $f->save();
        return back();
    }
}
