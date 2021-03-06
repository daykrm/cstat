<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\grade;
use App\user;
use App\report;
use App\manage_course;
use App\course_detail;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class gradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $student_id = Auth::user()->student_id;
        $course_id = Auth::user()->course_id;

       $course_detail = course_detail::latest()->paginate(1);

       $report = report::latest()->paginate(1);

        $sum_group = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->sum('subject_credit');

        $sum_category = grade::where('student_id', '=', $student_id)->Where('category_id', '1')->sum('subject_credit');

        $count_1 = grade::where('student_id', '=', $student_id)->Where('category_id', '1')->sum('subject_credit');
        $count_2 = grade::where('student_id', '=', $student_id)->Where('category_id', '2')->sum('subject_credit');
        $count_3 = grade::where('student_id', '=', $student_id)->Where('category_id', '3')->sum('subject_credit');

        $gpa_1 = grade::where('student_id', '=', $student_id)->Where('category_id', '1')->avg('grade1');
        $gpa_2 = grade::where('student_id', '=', $student_id)->Where('category_id', '2')->avg('grade1');
        $gpa_3 = grade::where('student_id', '=', $student_id)->Where('category_id', '3')->avg('grade1');

        $sum_gpa = grade::where('student_id', '=', $student_id)->avg('grade1');

        $sum_gpa_1 = grade::where('student_id', '=', $student_id)->Where('category_id', '2')->avg('grade1');

        $sum_credit = $count_1+$count_2+$count_3;
  

        $grade = grade::where('student_id', '=', $student_id)->Where('group_id', "101")->paginate($perPage);
        $grade_2 = grade::where('student_id', '=', $student_id)->Where('group_id', "102")->paginate($perPage);
        $grade_3 = grade::where('student_id', '=', $student_id)->Where('group_id', "103")->paginate($perPage);

        $grade_4= grade::where('student_id', '=', $student_id)->Where('group_id', "201")->paginate($perPage);
        $grade_5 = grade::where('student_id', '=', $student_id)->Where('group_id', "202")->paginate($perPage);
        $grade_6 = grade::where('student_id', '=', $student_id)->Where('group_id', "203")->paginate($perPage);
        $grade_7 = grade::where('student_id', '=', $student_id)->Where('group_id', "204")->paginate($perPage);



        $count_credit_1 = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->Where('grade1','!=', 'U')->Where('grade1','!=', '0')->sum('subject_credit');
        $count_credit_2 = grade::where('student_id', '=', $student_id)->Where('group_id', '102')->Where('grade1','!=', 'U')->Where('grade1','!=', '0')->sum('subject_credit');
        $count_credit_3 = grade::where('student_id', '=', $student_id)->Where('group_id', '103')->Where('grade1','!=', 'U')->Where('grade1','!=', '0')->sum('subject_credit');
        $count_credit_4 = grade::where('student_id', '=', $student_id)->Where('group_id', '201')->Where('grade1','!=', 'U')->Where('grade1','!=', '0')->sum('subject_credit');
        
        $count_credit_6 = grade::where('student_id', '=', $student_id)->Where('group_id', '202')->Where('grade1','!=', 'U')->Where('grade1','!=', '0')->sum('subject_credit');
        $count_credit_7 = grade::where('student_id', '=', $student_id)->Where('group_id', '203')->Where('grade1','!=', 'U')->Where('grade1','!=', '0')->sum('subject_credit');
        $count_credit_8 = grade::where('student_id', '=', $student_id)->Where('group_id', '204')->Where('grade1','!=', 'U')->Where('grade1','!=', '0')->sum('subject_credit');

        $count_credit_sum1 = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->sum('subject_credit');
        $count_credit_sum2 = grade::where('student_id', '=', $student_id)->Where('group_id', '102')->sum('subject_credit');
        $count_credit_sum3 = grade::where('student_id', '=', $student_id)->Where('group_id', '103')->sum('subject_credit');
        $count_credit_sum4 = grade::where('student_id', '=', $student_id)->Where('group_id', '201')->sum('subject_credit');
        
        $count_credit_sum6 = grade::where('student_id', '=', $student_id)->Where('group_id', '202')->sum('subject_credit');
        $count_credit_sum7 = grade::where('student_id', '=', $student_id)->Where('group_id', '203')->sum('subject_credit');
        $count_credit_sum8 = grade::where('student_id', '=', $student_id)->Where('group_id', '204')->sum('subject_credit');



        $gpa_credit_1 = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $gpa_credit_2 = grade::where('student_id', '=', $student_id)->Where('group_id', '102')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $gpa_credit_3 = grade::where('student_id', '=', $student_id)->Where('group_id', '103')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');

        $gpa_credit_4 = grade::where('student_id', '=', $student_id)->Where('group_id', '201')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        
        $gpa_credit_6 = grade::where('student_id', '=', $student_id)->Where('group_id', '202')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $gpa_credit_7 = grade::where('student_id', '=', $student_id)->Where('group_id', '203')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $gpa_credit_8 = grade::where('student_id', '=', $student_id)->Where('group_id', '204')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');

        $keyword = $request->get('search');
        $perPage = 1;

        if (!empty($keyword)) {
            $manage_course = manage_course::where('subject_id', $keyword)->first();

        } else {

            $manage_course = manage_course::latest()->paginate($perPage);
        }

        $manage_course = manage_course::latest()->paginate($perPage);
        $user = user::where('student_id', '=', $student_id)->latest()->paginate($perPage);

        $credit_sum = course_detail::where('course_id','=', $course_id)->pluck('sum_credit_coures')->first();


        $credit1 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '1')->pluck('sum_credit_group')->first();
        $credit2 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '2')->pluck('sum_credit_group')->first();
        $credit3 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '3')->pluck('sum_credit_group')->first();

        $credit4 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '1')->where('group_id','=', '101')->pluck('sum_credit_category')->first();
        $credit5 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '1')->where('group_id','=', '102')->pluck('sum_credit_category')->first();
        $credit6 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '1')->where('group_id','=', '103')->pluck('sum_credit_category')->first();

        $credit7 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '2')->where('group_id','=', '201')->pluck('sum_credit_category')->first();
        $credit8 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '2')->where('group_id','=', '202')->pluck('sum_credit_category')->first();
        $credit9 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '2')->where('group_id','=', '203')->pluck('sum_credit_category')->first();

        
        $edit_id = report::where('student_id',  $student_id)->value('id');
        
        return view('admin.grade.index', compact('user','count_credit_sum8','count_credit_sum7','count_credit_sum6','count_credit_sum4','count_credit_sum3','count_credit_sum2','count_credit_sum1','edit_id','student_id','report','credit_sum','credit9','credit8','credit7','credit6','credit5','credit4','credit3','credit2','credit1','count_credit_8','gpa_credit_8','grade_7','grade_4','grade_5','grade_6','gpa_credit_1','gpa_credit_2','gpa_credit_3','gpa_credit_4','gpa_credit_6','gpa_credit_7','count_credit_7','count_credit_6','count_credit_4','count_credit_3','count_credit_2','count_credit_1','sum_gpa_1','sum_category','sum_group','course_detail','sum_credit','manage_course','sum_gpa','gpa_2','gpa_3','gpa_1','grade','grade_2','grade_3','count_1','count_2','count_3'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */


    public function create(Request $request)
    {
        $keyword = $request->get('search');
      

        if (!empty($keyword)) {
            $manage_course = manage_course::where('subject_id', 'LIKE', "%$keyword%")->where('course_id','=', Auth::user()->course_id)
                ->orWhere('subject_name', 'LIKE', "%$keyword%")
                ->orWhere('group_name', 'LIKE', "%$keyword%")
                ->latest()->paginate(1);

            } else {

            $manage_course = manage_course::where('course_id','=', Auth::user()->course_id)->latest()->paginate(1);
       
            }
        return view('admin.grade.create' ,compact('manage_course'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        grade::create($requestData);

        return redirect('admin/grade/create')->with('flash_message', 'grade added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        
        $keyword = $request->get('search');
        $perPage = 25;

        $name = Auth::user()->name;

        $student_id = Auth::user()->student_id;
        $course_id = Auth::user()->course_id;

       $course_detail = course_detail::latest()->paginate(1);

       

        $sum_group = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->sum('subject_credit');

        $sum_category = grade::where('student_id', '=', $student_id)->Where('category_id', '1')->sum('subject_credit');

        $count_1 = grade::where('student_id', '=', $student_id)->Where('category_id', '1')->sum('subject_credit');
        $count_2 = grade::where('student_id', '=', $student_id)->Where('category_id', '2')->sum('subject_credit');
        $count_3 = grade::where('student_id', '=', $student_id)->Where('category_id', '3')->sum('subject_credit');

        $gpa_1 = grade::where('student_id', '=', $student_id)->Where('category_id', '1')->avg('grade1');
        $gpa_2 = grade::where('student_id', '=', $student_id)->Where('category_id', '2')->avg('grade1');
        $gpa_3 = grade::where('student_id', '=', $student_id)->Where('category_id', '3')->avg('grade1');

        $sum_gpa = grade::where('student_id', '=', $student_id)->avg('grade1');

        $sum_gpa_1 = grade::where('student_id', '=', $student_id)->Where('category_id', '2')->avg('grade1');

        $sum_credit = $count_1+$count_2+$count_3;
  

        $grade = grade::where('student_id', '=', $student_id)->Where('group_id', "101")->paginate($perPage);
        $grade_2 = grade::where('student_id', '=', $student_id)->Where('group_id', "102")->paginate($perPage);
        $grade_3 = grade::where('student_id', '=', $student_id)->Where('group_id', "103")->paginate($perPage);

        $grade_4= grade::where('student_id', '=', $student_id)->Where('group_id', "201")->paginate($perPage);
        $grade_5 = grade::where('student_id', '=', $student_id)->Where('group_id', "202")->paginate($perPage);
        $grade_6 = grade::where('student_id', '=', $student_id)->Where('group_id', "203")->paginate($perPage);
        $grade_7 = grade::where('student_id', '=', $student_id)->Where('group_id', "204")->paginate($perPage);

        $count_credit_1 = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->sum('subject_credit');
        $count_credit_2 = grade::where('student_id', '=', $student_id)->Where('group_id', '102')->sum('subject_credit');
        $count_credit_3 = grade::where('student_id', '=', $student_id)->Where('group_id', '103')->sum('subject_credit');

        $count_credit_4 = grade::where('student_id', '=', $student_id)->Where('group_id', '201')->sum('subject_credit');
        
        $count_credit_6 = grade::where('student_id', '=', $student_id)->Where('group_id', '202')->sum('subject_credit');
        $count_credit_7 = grade::where('student_id', '=', $student_id)->Where('group_id', '203')->sum('subject_credit');
        $count_credit_8 = grade::where('student_id', '=', $student_id)->Where('group_id', '204')->sum('subject_credit');




        $count_credit_p1 = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->Where('grade1', '>' ,'0')->sum('subject_credit');
        $count_credit_p2 = grade::where('student_id', '=', $student_id)->Where('group_id', '102')->Where('grade1', '>' ,'0')->sum('subject_credit');
        $count_credit_p3 = grade::where('student_id', '=', $student_id)->Where('group_id', '103')->Where('grade1', '>' ,'0')->sum('subject_credit');

        $count_credit_p4 = grade::where('student_id', '=', $student_id)->Where('group_id', '201')->Where('grade1', '>' ,'0')->sum('subject_credit');
        
        $count_credit_p6 = grade::where('student_id', '=', $student_id)->Where('group_id', '202')->Where('grade1', '>' ,'0')->sum('subject_credit');
        $count_credit_p7 = grade::where('student_id', '=', $student_id)->Where('group_id', '203')->Where('grade1', '>' ,'0')->sum('subject_credit');
        $count_credit_p8 = grade::where('student_id', '=', $student_id)->Where('group_id', '204')->Where('grade1', '>' ,'0')->sum('subject_credit');


        
        $gpa_credit_1 = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->avg('grade1');
        $gpa_credit_2 = grade::where('student_id', '=', $student_id)->Where('group_id', '102')->avg('grade1');
        $gpa_credit_3 = grade::where('student_id', '=', $student_id)->Where('group_id', '103')->avg('grade1');

        $gpa_credit_4 = grade::where('student_id', '=', $student_id)->Where('group_id', '201')->avg('grade1');
        
        $gpa_credit_6 = grade::where('student_id', '=', $student_id)->Where('group_id', '202')->avg('grade1');
        $gpa_credit_7 = grade::where('student_id', '=', $student_id)->Where('group_id', '203')->avg('grade1');
        $gpa_credit_8 = grade::where('student_id', '=', $student_id)->Where('group_id', '204')->avg('grade1');

        $keyword = $request->get('search');
        $perPage = 1;

        if (!empty($keyword)) {
            $manage_course = manage_course::where('subject_id', $keyword)->first();

        } else {

            $manage_course = manage_course::latest()->paginate($perPage);
        }

        $manage_course = manage_course::latest()->paginate($perPage);

        $credit_sum = course_detail::where('course_id','=', $course_id)->pluck('sum_credit_coures')->first();


        $credit1 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '1')->pluck('sum_credit_group')->first();
        $credit2 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '2')->pluck('sum_credit_group')->first();
        $credit3 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '3')->pluck('sum_credit_group')->first();

        $credit4 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '1')->where('group_id','=', '101')->pluck('sum_credit_category')->first();
        $credit5 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '1')->where('group_id','=', '102')->pluck('sum_credit_category')->first();
        $credit6 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '1')->where('group_id','=', '103')->pluck('sum_credit_category')->first();

        $credit7 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '2')->where('group_id','=', '201')->pluck('sum_credit_category')->first();
        $credit8 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '2')->where('group_id','=', '202')->pluck('sum_credit_category')->first();
        $credit9 = course_detail::where('course_id','=', $course_id)->where('category_id','=', '2')->where('group_id','=', '203')->pluck('sum_credit_category')->first();


        $gpa_credit_1 = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $gpa_credit_2 = grade::where('student_id', '=', $student_id)->Where('group_id', '102')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $gpa_credit_3 = grade::where('student_id', '=', $student_id)->Where('group_id', '103')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');

        $gpa_credit_4 = grade::where('student_id', '=', $student_id)->Where('group_id', '201')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        
        $gpa_credit_6 = grade::where('student_id', '=', $student_id)->Where('group_id', '202')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $gpa_credit_7 = grade::where('student_id', '=', $student_id)->Where('group_id', '203')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $gpa_credit_8 = grade::where('student_id', '=', $student_id)->Where('group_id', '204')->whereRaw("grade1 regexp '[0-9]'")->avg('grade1');
        $user = user::where('student_id', '=', $student_id)->latest()->paginate($perPage);

        $count_credit_sum1 = grade::where('student_id', '=', $student_id)->Where('group_id', '101')->sum('subject_credit');
        $count_credit_sum2 = grade::where('student_id', '=', $student_id)->Where('group_id', '102')->sum('subject_credit');
        $count_credit_sum3 = grade::where('student_id', '=', $student_id)->Where('group_id', '103')->sum('subject_credit');
        $count_credit_sum4 = grade::where('student_id', '=', $student_id)->Where('group_id', '201')->sum('subject_credit');
        
        $count_credit_sum6 = grade::where('student_id', '=', $student_id)->Where('group_id', '202')->sum('subject_credit');
        $count_credit_sum7 = grade::where('student_id', '=', $student_id)->Where('group_id', '203')->sum('subject_credit');
        $count_credit_sum8 = grade::where('student_id', '=', $student_id)->Where('group_id', '204')->sum('subject_credit');

        return view('admin.grade.show', compact('count_credit_sum8','count_credit_sum7','count_credit_sum6','count_credit_sum4','count_credit_sum3','count_credit_sum2','count_credit_sum1','user','count_credit_p1','count_credit_p2','count_credit_p3','count_credit_p4','count_credit_p6','count_credit_p7','count_credit_p8','name','student_id','credit_sum','credit9','credit8','credit7','credit6','credit5','credit4','credit3','credit2','credit1','count_credit_8','gpa_credit_8','grade_7','grade_4','grade_5','grade_6','gpa_credit_1','gpa_credit_2','gpa_credit_3','gpa_credit_4','gpa_credit_6','gpa_credit_7','count_credit_7','count_credit_6','count_credit_4','count_credit_3','count_credit_2','count_credit_1','sum_gpa_1','sum_category','sum_group','course_detail','sum_credit','manage_course','sum_gpa','gpa_2','gpa_3','gpa_1','grade','grade_2','grade_3','count_1','count_2','count_3'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $grade = grade::findOrFail($id);

        return view('admin.grade.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $grade = grade::findOrFail($id);
        $grade->update($requestData);

        return redirect('admin/grade')->with('flash_message', 'grade updated!');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        grade::destroy($id);

        return redirect('admin/grade')->with('flash_message', 'grade deleted!');
    }

}