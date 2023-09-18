<?php

namespace App\Http\Controllers;

use App\Models\AcrPartOne;
use App\Models\AcrPartTwo;
use App\Models\AcrTraining;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcrPartOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Request $request)
    {
//        dd($user->EmployementDetails->first()->join_date);
        return view('acr.acrPartOne', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request->all());
        try {
            DB::beginTransaction();
            $acr_part_one = AcrPartOne::create($request->all());
            foreach ($request->training as $training) {
                AcrTraining::create(
                    [
                        'acr_part_one_id' => $acr_part_one->id,
                        'subject' => $training['subject'],
                        'institute' => $training['institute'],
                        'country' => $training['country'],
                        'from' => $training['from'],
                        'to' => $training['to'],
                    ]
                );
            }
            $acr_part_two = AcrPartTwo::create([
                'acr_part_one_id' => $acr_part_one->id,
                'user_id' => $request->user_id,
                'job_description' => $request->job_description,
                'brief_account_achievements' => $request->brief_account_achievements,
            ]);
            DB::commit();
            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();
            session()->flash('message', 'Due to some internal problem of server your data is not save please retry.');
            return redirect()->route('acrPartOne.create', auth()->id());
            /* Transaction failed. */
        }

        session()->flash('message', 'ACR report has been saved into the database...');
        return redirect()->route('employees.edit', auth()->id());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\AcrPartOne $acrPartOne
     * @return \Illuminate\Http\Response
     */
    public function show(AcrPartOne $acrPartOne)
    {
        return view('acr.showAcrBS1920', compact('acrPartOne'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\AcrPartOne $acrPartOne
     * @return \Illuminate\Http\Response
     */
    public function edit(AcrPartOne $acrPartOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcrPartOne $acrPartOne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcrPartOne $acrPartOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AcrPartOne $acrPartOne
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcrPartOne $acrPartOne)
    {
        //
    }


}
