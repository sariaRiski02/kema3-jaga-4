<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function show(Family $family)
    {
        $family->load([
            'headFamily.resident',
            'familyRelationships.resident',
        ]);

        return view('dashboard.show-family', compact('family'));
    }

    public function edit(Family $family)
    {
        $family->load([
            'headFamily.resident',
            'familyRelationships.resident',
        ]);

        return view('dashboard.edit-family', compact('family'));
    }

    public function export(Family $family)
    {
        $family->load([
            'headFamily.resident',
            'familyRelationships.resident',
        ]);

        return Pdf::loadView('dashboard.export-family', compact('family'))
            ->setPaper('a4', 'landscape')
            ->setOption('margin-top', 8)
            ->setOption('margin-bottom', 8)
            ->setOption('margin-left', 8)
            ->setOption('margin-right', 8)
            ->download('kk_' . $family->family_number . '.pdf');
    }
}
