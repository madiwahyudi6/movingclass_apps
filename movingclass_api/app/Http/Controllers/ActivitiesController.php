<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Activities;
use App\Classroom;
use Carbon\Carbon;

class ActivitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show()
    {

      $activities = Classroom::select('classroom.id', 'classroom.room_name', 'activities.subject_id')
      ->leftjoin('activities', 'activities.classroom_id', '=', 'classroom.id')
      ->orderBy('classroom.room_name', 'desc')
      ->get();

      if(empty($activities)) {
        return [
          'status'    => 'error',
          'message'   => 'Activities Not Found',
          'result'    => null
        ];
      }

      return [
        'status'    => 'success',
        'result'    => $activities
      ];

    }

    public function create(Request $request)
    {

      $validation = Validator::make($request->all(), [
        'classroom_id'    => 'required',
        'subject_id'      => 'required',
        'studentclass_id' => 'required',

      ]);

      if($validation->fails()) {

        $errors = $validation->errors();

        return [
          'status'    => 'error',
          'message'   => $errors,
          'result'    => null
        ];

      }

      $check_activity = Activities::where('classroom_id', $request->classroom_id)
      ->first();

      if(! empty($check_activity)) {
        Activities::where('classroom_id', $request->classroom_id)
        ->delete();
      }

      $result = Activities::create(
        $request->all()
      );

      $after_result = Classroom::select('classroom.id', 'classroom.room_name', 'activities.subject_id')
      ->leftjoin('activities', 'activities.classroom_id', '=', 'classroom.id')
      ->orderBy('classroom.room_name', 'desc')
      ->get();

      if($result) {

        return [
          'status'    => 'success',
          'message'   => 'Activity was inserted',
          'result'    => $after_result
        ];
      }
      else {

        return [
          'status'    => 'error',
          'message'   => 'Subject not inserted',
          'result'    => null
        ];
      }

    }

    public function detail($id)
    {

      $activity = Classroom::select('classroom.room_name', 'activities.created_at',
      'studentclass.studentclass', 'subjects.subject', 'classroom.id')
      ->where('classroom.id', $id)
      ->leftjoin('activities', 'activities.classroom_id', '=', 'classroom.id')
      ->leftjoin('subjects', 'subjects.id', 'activities.subject_id')
      ->leftjoin('studentclass', 'studentclass.id', 'activities.studentclass_id')
      ->first();


      $activity['since'] = Carbon::parse($activity['created_at'])->diffForHumans();

      if(empty($activity)) {

        return [
          'status'    => 'error',
          'message'   => 'Activity Not Found',
          'result'    => null
        ];
      }

      return [
        'status'  => 'success',
        'result'  => $activity
      ];

    }
    //
    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), [
          'classroom_id'      => 'required',
          'studentclass_id'   => 'required',
          'subject_id'        => 'required'
        ]);

        if($validation->fails()) {

          $errors = $validation->errors();

          return [
            'status'    => 'error',
            'message'   => $errors,
            'result'    => null
          ];

        }

        $activity = Activities::find($id);

        if(empty($activity)) {

          return [
            'status'    => 'error',
            'message'   => 'Activity Not Found',
            'result'    => null
          ];
        }

        $result = $activity->update(
          $request->all()
        );

        $after_result = $activity->get();

        if($result)
        {

          return [
            'status'    => 'success',
            'message'   => 'Activity was inserted',
            'result'    => $after_result
          ];

        }
        else {

          return [
            'status'    => 'error',
            'message'   => 'Activity not inserted',
            'result '   => null
          ];
        }
    }

    public function delete(Request $request, $id)
    {

      $activity = Activities::where('classroom_id', $id)
      ->first();

      if(empty($activity)) {

        return [
          'status'    => 'error',
          'message'   => 'Activity Not Found',
          'result'    => null
        ];

      }

      $result = Activities::where('classroom_id', $id)
      ->delete();

      $after_result = Classroom::select('classroom.id', 'classroom.room_name', 'activities.subject_id')
      ->leftjoin('activities', 'activities.classroom_id', '=', 'classroom.id')
      ->orderBy('classroom.room_name', 'desc')
      ->get();

      if($result) {

        return [
          'status'    => 'success',
          'message'   => 'Activity was deleted',
          'result'    => $after_result
        ];
      }
      else {

        return [
          'status'    => 'error',
          'message'   => 'Activity not deleted',
          'result '   => null
        ];
      }
    }
}
