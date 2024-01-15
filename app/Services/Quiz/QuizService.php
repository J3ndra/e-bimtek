<?php

namespace Services\Quiz;

use App\Models\Quiz;
use App\Models\Question;
use Services\UserService;
use Services\Course\CourseService;
use Services\Quiz\AnswerService;
use Services\Quiz\ScoreService;
use Services\Quiz\CertificateService;

class QuizService
{
    protected $course;
    protected $user;
    protected $answer;
    protected $score;
    protected $certificate;

    public function __construct(CourseService $course, UserService $user, AnswerService $answer, ScoreService $score, CertificateService $certificate)
    {
        $this->course      = $course;
        $this->user        = $user;
        $this->answer      = $answer;
        $this->score       = $score;
        $this->certificate = $certificate;
    }

    public function model()
    {
        return Quiz::with('course', 'questions', 'answers', 'scores');
    }

    public function question()
    {
        return Question::with('quiz');
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function allByTeam()
    {
        return $this->model()->whereHas('course', function ($q) {
            $q->where('team_id', auth('team')->id());
        })->paginate(12);
    }

    public function paginate($amount = 10)
    {
        return $this->model()->paginate($amount);
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model()->findOrFail($id);
    }

    public function findWithTeam($id)
    {
        return $this->model()->whereHas('course', function ($q) {
            $q->where('team_id', auth('team')->id());
        })->whereId($id)->firstOrFail();
    }

    public function isStartQuiz($id, $type = 'Pre Test')
    {
        $data = $this->model()->where(['course_id' => $id, 'type' => $type])->first();

        if ($data) {
            $check = $this->score->check($data->id, $data->min);

            if ($check) {
                return false;
            } else {
                return $data;
            }
        } else {
            return false;
        }
    }

    public function create($request)
    {
        return $this->model()->create([
            'title'     => $request->title,
            'type'      => $request->type,
            'amount'    => $request->amount,
            'min'       => $request->min,
            'course_id' => $request->course_id
        ]);
    }

    public function createWithTeam($request)
    {
        $course = $this->course->findWithTeam($request->course_id);

        return $course()->quizzes()->create([
            'title'     => $request->title,
            'type'      => $request->type,
            'amount'    => $request->amount,
            'min'       => $request->min,
            'course_id' => $request->course_id
        ]);
    }

    public function update($request, $id)
    {
        return $this->model()->find($id)->update([
            'title'     => $request->title,
            'type'      => $request->type,
            'amount'    => $request->amount,
            'min'       => $request->min,
            'course_id' => $request->course_id
        ]);
    }

    public function updateWithTeam($request, $id)
    {
        $quiz = $this->findWithTeam($id);

        return $quiz->update([
            'title'     => $request->title,
            'type'      => $request->type,
            'amount'    => $request->amount,
            'min'       => $request->min,
            'course_id' => $request->course_id
        ]);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function deleteWithTeam($id)
    {
        $quiz = $this->findWithTeam($id);

        return $quiz->delete();
    }

    public function start($quiz)
    {
        $quiz = $this->model()->find($quiz);
        $check = $this->answer->isThere($quiz->id);

        if (!$check) {
            $data = $this->question()
                ->where('quiz_id', $quiz->id)
                ->inRandomOrder()
                ->limit($quiz->amount)
                ->get();

            foreach ($data as $row) {
                $this->answer->create($quiz->id, $row->id);
            }
        }

        return $this->answer->firstQuestion($quiz->id);
    }

    public function finish($quiz)
    {
        $quiz = $this->findOrFail($quiz);
        $data = $this->answer->allByQuiz($quiz->id);

        $true = 0;
        foreach ($data as $row) {
            if ($row->answer == $row->question->answer) {
                $true += 1;
            }

            // $row->delete();
        }

        $score = $true / $data->count() * 100;

        if ($quiz->type == "Post Test" && $score >= $quiz->min) {
            $this->certificate->create($quiz->id);
        }

        $score_record = $this->score->create($quiz->id, $score);
        // dd($score_record);
        foreach ($data as $row) {
            $row->update([
                'score_id' => $score_record->id,
            ]);
        }

        return $score_record;
    }

    public function validation($course, $type, $exists = null)
    {
        $data = $this->model()->where(['course_id' => $course, 'type' => $type])->first();

        if ($data) {
            if (!is_null($exists)) {
                return $data->id == $exists ? false : true;
            }

            return true;
        }

        return false;
    }

    public function active()
    {
        return [];
        // return $this->model()->whereHas('answers')->whereDoesntHave('scores', function($query) {
        //     return $query->where('user_id', auth('web')->id());
        // })->get();
    }
}
