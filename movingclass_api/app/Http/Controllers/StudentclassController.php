<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Studentclass;

class StudentclassController extends Controller
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

      $studentclass = Studentclass::get();

      if(empty($studentclass)) {
        return [
          'status'    => 'error',
          'message'   => 'Studentclass Not Found',
          'result'    => null
        ];
      }

      return [
        'status'    => 'success',
        'result'    => $studentclass
      ];

    }

    public function create(Request $request)
    {

      $validation = Validator::make($request->all(), [
        'studentclass' => 'required|max:10'
      ]);

      if($validation->fails()) {

        $errors = $validation->errors();

        return [
          'status'    => 'error',
          'message'   => $errors,
          'result'    => null
        ];

      }

      $result = Studentclass::create(
        $request->all()
      );

      $after_result = Studentclass::get();

      if($result) {

        return [
          'status'    => 'success',
          'message'   => 'Student Class was inserted',
          'result'    => $after_result
        ];
      }
      else {

        return [
          'status'    => 'error',
          'message'   => 'Student Class not inserted',
          'result'    => null
        ];
      }

    }
    //
    public function detail($id)
    {

      $studentclass = Studentclass::find($id);

      if(empty($studentclass)) {

        return [
          'status'    => 'error',
          'message'   => 'Studentclass Not Found',
          'result'    => null
        ];
      }

      return [
        'status'  => 'success',
        'result'  => $studentclass
      ];

    }

    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), [
          'studentclass'      => 'required|max:10',
        ]);

        if($validation->fails()) {

          $errors = $validation->errors();

          return [
            'status'    => 'error',
            'message'   => $errors,
            'result'    => null
          ];

        }

        $studentclass = Studentclass::find($id);

        if(empty($studentclass)) {

          return [
            'status'    => 'error',
            'message'   => 'Student Class Not Found',
            'result'    => null
          ];
        }

        $result = $studentclass->update(
          $request->all()
        );

        $after_result = $studentclass->get();

        if($result)
        {

          return [
            'status'    => 'success',
            'message'   => 'Student Class was inserted',
            'result'    => $after_result
          ];

        }
        else {

          return [
            'status'    => 'error',
            'message'   => 'Student Class not inserted',
            'result '   => null
          ];
        }
    }

    public function delete(Request $request, $id)
    {

      $studentclass = Studentclass::find($id);

      if(empty($studentclass)) {

        return [
          'status'    => 'error',
          'message'   => 'Studentclass Not Found',
          'result'    => null
        ];

      }

      $result = Studentclass::where('id', $id)
      ->delete();

      $after_result = Studentclass::get();

      if($result) {

        return [
          'status'    => 'success',
          'message'   => 'Studentclass was deleted',
          'result'    => $after_result
        ];
      }
      else {

        return [
          'status'    => 'error',
          'message'   => 'Studentclass not deleted',
          'result '   => null
        ];
      }
    }
}
