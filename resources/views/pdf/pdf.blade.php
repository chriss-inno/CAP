$pdf = App::make('dompdf');
$pdf->loadHTML('<h1>Test</h1>');
return $pdf->stream();
Or use the facade:

$pdf = PDF::loadView('pdf.invoice', $data);
return $pdf->download('invoice.pdf');