<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classroom;

class ClassroomController extends Controller
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

      $classroom = Classroom::get();

      if(empty($classroom)) {
        return [
          'status'    => 'error',
          'message'   => 'Classroom Not Found',
          'result'    => null
        ];
      }

      return [
        'status'    => 'success',
        'result'    => $classroom
      ];

    }

    public function create(Request $request)
    {

      $validation = Validator::make($request->all(), [
        'room_name' => 'required|max:10'
      ]);

      if($validation->fails()) {

        $errors = $validation->errors();

        return [
          'status'    => 'error',
          'message'   => $errors,
          'result'    => null
        ];

      }

      $result = Classroom::create(
        $request->all()
      );

      $after_result = Classroom::get();

      if($result) {

        return [
          'status'    => 'success',
          'message'   => 'Class Room was inserted',
          'result'    => $after_result
        ];
      }
      else {

        return [
          'status'    => 'error',
          'message'   => 'Class Room not inserted',
          'result'    => null
        ];
      }

    }

    public function detail($id)
    {

      $classroom = Classroom::find($id);

      if(empty($classroom)) {

        return [
          'status'    => 'error',
          'message'   => 'Classroom Not Found',
          'result'    => null
        ];
      }

      return [
        'status'  => 'success',
        'result'  => $classroom
      ];

    }
    //
    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), [
          'room_name'      => 'required|max:10',
        ]);

        if($validation->fails()) {

          $errors = $validation->errors();

          return [
            'status'    => 'error',
            'message'   => $errors,
            'result'    => null
          ];

        }

        $classroom = Classroom::find($id);

        if(empty($classroom)) {

          return [
            'status'    => 'error',
            'message'   => 'Classroom Not Found',
            'result'    => null
          ];
        }

        $result = $classroom->update(
          $request->all()
        );

        $after_result = $classroom->get();

        if($result)
        {

          return [
            'status'    => 'success',
            'message'   => 'Classroom was inserted',
            'result'    => $after_result
          ];

        }
        else {

          return [
            'status'    => 'error',
            'message'   => 'Classroom not inserted',
            'result '   => null
          ];
        }
    }

    public function delete(Request $request, $id)
    {

      $classroom = Classroom::find($id);

      if(empty($classroom)) {

        return [
          'status'    => 'error',
          'message'   => 'Classroom Not Found',
          'result'    => null
        ];

      }

      $result = Classroom::where('id', $id)
      ->delete();

      $after_result = Classroom::get();

      if($result) {

        return [
          'status'    => 'success',
          'message'   => 'Classroom was deleted',
          'result'    => $after_result
        ];
      }
      else {

        return [
          'status'    => 'error',
          'message'   => 'Classroom not deleted',
          'result '   => null
        ];
      }
    }
}
