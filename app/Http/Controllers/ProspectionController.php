<?php

namespace App\Http\Controllers;

use App\Exports\ProspectionExport;
use App\Http\Requests\ProspectionRequest;
use App\Models\Prospection;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

class ProspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $success = $request->session()->get('success');
        $failure = $request->session()->get('failure');

        $first_date = $request->input('first_date');
        $last_date = $request->input('last_date');

        $query = Prospection::query();

        if ($first_date and $last_date) {
            $query->whereBetween('date', [$first_date, $last_date]);
        }

        $prospections = $query->orderBy('date', 'desc')->paginate(15);
        return view('prospections')->with(compact('prospections', 'failure', 'success', 'first_date', 'last_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prospection-create-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProspectionRequest $request)
    {
        $prospectionData = $request->validated();

        $prospection = Prospection::create($prospectionData);

        if ($prospection) {
            return redirect()->back()->with('success', 'Prospection enrégistrée avec succes');
        } else {
            return redirect()->back()->with('failure', 'Erreur lors de l\'enregistrement de la prospection');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prospection $prospection)
    {
        return view('prospection-show')->with('prospection', $prospection);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prospection $prospection)
    {
        return view('prospection-edit-form')->with('prospection', $prospection);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProspectionRequest $request, Prospection $prospection)
    {
        $prospectionData = $request->validated();
        $updateResult = $prospection->update($prospectionData);

        if ($updateResult) {
            return redirect()->back()->with('success', 'Prospection modifiée avec succes');
        } else {
            return redirect()->back()->with('failure', 'Erreur lors de la modification');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, UrlGenerator $urlGenerator, Prospection $prospection)
    {
        $previousUrl = $urlGenerator->previous();
        $previousRouteName = Route::getRoutes()->match($request->create($previousUrl))->getName();

        $nextPage = redirect()->route('prospections.index')->with('success', 'Informations de prospection supprimées');

        if (!$prospection->delete()) {
            if ($previousRouteName == 'prospections.show') {
                $nextPage = redirect()->back()->with('failure', 'Erreur lors de la suppression');
            } else {
                $nextPage = redirect()->route('prospections.index')->with('failure', 'Erreur lors de la suppression');
            }
        }

        return $nextPage;
    }

    /**
     * Download an excel file of datas
     */
    public function export(Request $request) {
        $first_date = $request->input('first_date_exp');
        $last_date = $request->input('last_date_exp');

        return Excel::download(new ProspectionExport($first_date, $last_date), 'prospections.xlsx');
    }
}
