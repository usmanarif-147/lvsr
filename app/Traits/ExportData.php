<?php

namespace App\Traits;

trait ExportData
{

    public function downloadCsv()
    {
        $fileName = session()->get('file_name');
        $cards = session()->get('data');

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Card UUID', 'Activation Code', 'Status');

        $callback = function () use ($cards, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($cards as $card) {
                $row['Card UUID']  = request()->getSchemeAndHttpHost() . '/card_id/' . $card->uuid;
                $row['Activation Code'] = $card->activation_code;
                $row['Status'] = $card->status;

                fputcsv($file, array($row['Card UUID'], $row['Activation Code'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
