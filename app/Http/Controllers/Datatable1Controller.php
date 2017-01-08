<?php

namespace App\Http\Controllers;

use App\Datatable1Model;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class Datatable1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('datatable1.index');
    }
    //
    public function getDatas() {
        /*$datas = Datatable1Model::orderBy('id', 'DESC')->get();
        return Datatables::collection($datas)->make(true);*/

        /*$datas = Datatable1Model::select(['id', 'name', 'sex', 'age', 'email']);
        return Datatables::of($datas)->make();*/

        /*$datas = Datatable1Model::orderBy('name')->get();
        $i = 0;
        foreach ($datas as $data) {
            $data['no'] = ++$i;
        }
        return Datatables::collection($datas)->make(true);*/

        $datas = Datatable1Model::select(['id', 'disporder AS no', 'name', 'sex', 'age', 'email']);
        return Datatables::of($datas)->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $name = $request->input('name');
        $sex = $request->input('sex');
        $age = $request->input('age');
        $email = $request->input('email');

        if ($name == '' && $sex == '' && $age == '' && $email == '') {
            echo 'field empty'; exit;
        }

        //store
        $user = new Datatable1Model();

        $user->name = $request->input('name');
        $user->sex = $request->input('sex');
        $user->age = $request->input('age');
        $user->email = $request->input('email');
        //get disporder
        /*$row = Datatable1Model::select(DB::raw('COUNT(id) AS cnt'))->get();
        var_dump($row[0]['cnt']);exit;*/
        $count = Datatable1Model::count();
        $user->disporder = $count+1;
        
        $user->save();

        echo 'success'; exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate
        $name = $request->input('name');
        $sex = $request->input('sex');
        $age = $request->input('age');
        $email = $request->input('email');
        $disporder = $request->input('no');

        if ($name == '' && $sex == '' && $age == '' && $email == '' && $disporder == '') {
            echo 'field empty'; exit;
        }

        //update
        $user = Datatable1Model::find($id);

        $user->name = $name;
        $user->sex = $sex;
        $user->age = $age;
        $user->email = $email;
        $user->disporder = $disporder;
        
        $user->save();

        //process disporder
        $o_disporder = $request->input('o_no');
        $sql = "UPDATE users SET disporder=disporder+1 WHERE id != {$id} AND disporder >= {$disporder} AND disporder < {$o_disporder}";
        // $datas = DB::select($sql);
        DB::statement($sql);

        echo 'success'; exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = Datatable1Model::find($id);

        $user->delete();

        echo 'success'; exit;
    }
}
