<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Recipe;
use App\Models\Refferal;
use App\Models\RequestCall;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{

    public function kejadian($id, $format)
    {
        return $this->form_kejadian(null, $id, $format);
    }
    public function form_kejadian($id, $id_form, $format)
    {
        if (!empty($id)) {
            $data = RequestCall::with(['login_session', 'ref_emergency'])
                ->findOrFail($id);
        }
        $data_all = Form::find($id_form);
        // $jsonData = json_decode($data_all->form_data);
        $compact = [
            // 'dataContent' => $data,
            'dataForm' => $data_all,
            'format' => $format
        ];

        // $data = [
        //     'title' => 'Sample PDF Document',
        //     'content' => 'Hello, this is a sample PDF document created with Dompdf in Laravel.',
        // ];

        // return view('page.emergency.print', $compact);
        Pdf::setOption([
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'margin_top' => 2,    // Set top margin in millimeters
            'margin_right' => 2,  // Set right margin in millimeters
            'margin_bottom' => 2, // Set bottom margin in millimeters
            'margin_left' => 2,
        ]);
        // return view('page.emergency.print', $compact,);
        $pdf = PDF::loadView('page.emergency.print', $compact, [
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'margin_top' => 2,
            'margin_right' => 2,
            'margin_bottom' => 2,
            'margin_left' => 2,
        ]);
        $pdf->setPaper([0, 0, 596, 935], 'portrait');
        // return $pdf->stream('document.pdf');
        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=document.pdf',
        ]);
    }

    public function rujukan($id)
    {

        $data_all = Refferal::findOrFail($id);
        $compact = [
            'dataForm' => $data_all,
        ];

        Pdf::setOption([
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'margin_top' => 2,    // Set top margin in millimeters
            'margin_right' => 2,  // Set right margin in millimeters
            'margin_bottom' => 2, // Set bottom margin in millimeters
            'margin_left' => 2,
        ]);

        if ($data_all->format == 2) {
            $view = 'page.rujukan.print_gigi';
        } else {
            $view = 'page.rujukan.print2';
        }
        // dd($data_all->format);
        $pdf = PDF::loadView($view, $compact, [
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'margin_top' => 2,
            'margin_right' => 2,
            'margin_bottom' => 2,
            'margin_left' => 2,
        ]);
        $pdf->setPaper([0, 0, 596, 935], 'portrait');
        // $filePath = 'pdf/rujukan_' . $id . '.pdf';
        // $filename = 'rujukan_' . $id . '.pdf';

        // // Save the PDF to the 'public' disk in 'upload/rujukan' directory
        // $filePath = 'document/rujukan/' . $filename;
        // Storage::disk('local')->put($filePath, $pdf->output());


        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=document.pdf',
        ]);
    }

    public function recipe($id)
    {

        $data_all = Recipe::findOrFail($id);
        $compact = [
            // 'dataContent' => $data,
            'dataForm' => $data_all,
        ];

        Pdf::setOption([
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'margin_top' => 2,    // Set top margin in millimeters
            'margin_right' => 2,  // Set right margin in millimeters
            'margin_bottom' => 2, // Set bottom margin in millimeters
            'margin_left' => 2,
        ]);
        // return view('page.rujukan.print2', $compact,);
        $pdf = PDF::loadView('page.recipe.print2', $compact, [
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'margin_top' => 2,
            'margin_right' => 2,
            'margin_bottom' => 2,
            'margin_left' => 2,
        ]);
        $pdf->setPaper([0, 0, 298, 935], 'portrait');
        // return $pdf->stream('document.pdf');
        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=document.pdf',
        ]);
    }
}
