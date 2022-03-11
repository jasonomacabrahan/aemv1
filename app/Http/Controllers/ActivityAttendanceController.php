<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityAttendance;
use App\Models\Program;
use Illuminate\Http\Request;

class ActivityAttendanceController extends Controller
{
    public function __construct()
	{
	    $this->middleware('auth')->except('index');;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        $activityattendances = ActivityAttendance::paginate(15);
        return view('activity.attendance',['activityattendances'=>$activityattendances, 'activities'=>$activities]); //
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendance($id)
    {
        $users = User::all();
        $activity = Activity::where('id',$id)->first();
        $program = Program::where('id',$activity->papID)->first();
        $activityattendances = ActivityAttendance::paginate(15);
//        dd($activity, $id, $program);
        return view('activity.attendance',['activityattendances'=>$activityattendances, 'users'=>$users, 'program'=>$program, 'activity'=>$activity]); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

   

    public function create(Request $req)
    {
        
        $activityattendance = new ActivityAttendance;
        $activityattendance->RegisteredID  =  auth()->user()->id;
        $activityattendance->ActivityID    =  $req->ActivityID;
        $activityattendance->registrationDate =  $req->registrationDate;
        $activityattendance->created_at = now();
        $activityattendance->updated_at = now();
        $activity = ActivityAttendance::where('RegisteredID',$activityattendance->RegisteredID)->where('registrationDate', $activityattendance->registrationDate)->first();
        if ($activity) {
            return redirect()->route('activity.reg')
                    ->with('error', 'Event');
        }else{
            $activityattendance->save();
            return redirect()->route('activity.reg')
                    ->with('success', 'Event');
          
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityAttendance  $activityAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityAttendance $activityAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityAttendance  $activityAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityAttendance $activityAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActivityAttendance  $activityAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityAttendance $activityAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityAttendance  $activityAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityAttendance $activityAttendance)
    {
        //
    }
}
