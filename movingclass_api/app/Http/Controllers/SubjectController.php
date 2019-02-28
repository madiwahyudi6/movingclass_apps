<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Subject;

class SubjectController extends Controller
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

      $subject = Subject::get();

      if(empty($subject)) {
        return [
          'status'    => 'error',
          'message'   => 'Subject Not Found',
          'result'    => null
        ];
      }

      return [
        'status'    => 'success',
        'result'    => $subject
      ];

    }

    //
    public function create(Request $request)
    {

      $validation = Validator::make($request->all(), [
        'subject' => 'required|max:20'
      ]);

      if($validation->fails()) {

        $errors = $validation->errors();

        return [
          'status'    => 'error',
          'message'   => $errors,
          'result'    => null
        ];

      }

      $result = Subject::create(
        $request->all()
      );

      $after_result = Subject::get();

      if($result) {

        return [
          'status'    => 'success',
          'message'   => 'Subject was inserted',
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

      $subject = Subject::find($id);

      if(empty($subject)) {

        return [
          'status'    => 'error',
          'message'   => 'Subject Not Found',
          'result'    => null
        ];
      }

      return [
        'status'  => 'success',
        'result'  => $subject
      ];

    }

    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), [
          'subject'      => 'required|max:20',
        ]);

        if($validation->fails()) {

          $errors = $validation->errors();

          return [
            'status'    => 'error',
            'message'   => $errors,
            'result'    => null
          ];

        }

        $subject = Subject::find($id);

        if(empty($subject)) {

          return [
            'status'    => 'error',
            'message'   => 'Subject Not Found',
            'result'    => null
          ];
        }

        $result = $subject->update(
          $request->all()
        );

        $after_result = $subject->get();

        if($result)
        {

          return [
            'status'    => 'success',
            'message'   => 'Subject was inserted',
            'result'    => $after_result
          ];

        }
        else {

          return [
            'status'    => 'error',
            'message'   => 'Subject not inserted',
            'result '   => null
          ];
        }
    }

    public function delete(Request $request, $id)
    {

      $subject = Subject::find($id);

      if(empty($subject)) {

        return [
          'status'    => 'error',
          'message'   => 'Subject Not Found',
          'result'    => null
        ];

      }

      $result = Subject::where('id', $id)
      ->delete();

      $after_result = Subject::get();

      if($result) {

        return [
          'status'    => 'success',
          'message'   => 'Subject was deleted',
          'result'    => $after_result
        ];
      }
      else {

        return [
          'status'    => 'error',
          'message'   => 'Subject not deleted',
          'result '   => null
        ];
      }
    }
}
