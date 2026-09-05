<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherEvaluation;
use Illuminate\Http\Request;

class TeacherEvaluationAdminController extends Controller
{
    /**
     * Liste des avis avec filtres de modération.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending'); // 'pending', 'approved', 'all'

        $query = TeacherEvaluation::with(['student', 'teacher'])->latest();

        if ($status === 'pending') {
            $query->where('is_approved', false);
        } elseif ($status === 'approved') {
            $query->where('is_approved', true);
        }

        $evaluations = $query->paginate(15);

        // Statistiques pour les badges
        $counts = [
            'pending' => TeacherEvaluation::where('is_approved', false)->count(),
            'approved' => TeacherEvaluation::where('is_approved', true)->count(),
            'all' => TeacherEvaluation::count(),
        ];

        return view('admin.evaluations.index', compact('evaluations', 'status', 'counts'));
    }

    /**
     * Approuver un avis.
     */
    public function approve($id)
    {
        $evaluation = TeacherEvaluation::findOrFail($id);
        $evaluation->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'L\'avis a été approuvé avec succès.');
    }

    /**
     * Rejeter (Désapprouver) un avis sans le supprimer.
     */
    public function reject($id)
    {
        $evaluation = TeacherEvaluation::findOrFail($id);
        $evaluation->update(['is_approved' => false]);

        return redirect()->back()->with('success', 'L\'avis a été rejeté (masqué).');
    }

    /**
     * Supprimer définitivement un avis.
     */
    public function destroy($id)
    {
        $evaluation = TeacherEvaluation::findOrFail($id);
        $evaluation->delete();

        return redirect()->back()->with('success', 'L\'avis a été supprimé définitivement.');
    }
}
