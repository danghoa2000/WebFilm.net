<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatisticalRequest;
use App\Models\Film;
use App\Models\ViewsFromTimeToTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class StatisticalController extends Controller
{
    public function index(StatisticalRequest $request)
    {
        $charts = ViewsFromTimeToTime::where('id', '!=', 0);
        switch ($request->order) {
            case 'week':
                $startDate = Carbon::now()->add(-7, 'week')->format('Y-m-d');
                $endDate = Carbon::now();
                $charts = $charts->select(DB::raw('SUM(luot_xem) AS views'), DB::raw('WEEK(created_at) AS date'), DB::raw('YEAR(created_at) AS year'))
                    ->groupBy( DB::raw('WEEK(created_at)'), DB::raw('YEAR(created_at)'));

                break;
            case 'month':
                $startDate = Carbon::now()->add(-12, 'month')->format('Y-m-d');
                $endDate = Carbon::now();
                $charts = $charts->select(DB::raw('SUM(luot_xem) AS views'), DB::raw('MONTH(created_at) AS date'), DB::raw('YEAR(created_at) AS year'))
                    ->groupBy( DB::raw('MONTH(created_at)'),  DB::raw('YEAR(created_at)'));

                break;
            default:
                $startDate = Carbon::now()->add(-30, 'day')->format('Y-m-d');
                $endDate = Carbon::now();
                $charts = $charts->select(DB::raw('SUM(luot_xem) AS views'), DB::raw('DAY(created_at) AS date'), DB::raw('DATE(created_at) AS createDate'))
                    ->groupBy(DB::raw('DATE(created_at)'), DB::raw('DAY(created_at)'));

                break;
        }
        if (isset($request->startDate) && isset($request->endDate)) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
        }
        $charts = $charts->where('created_at', '>=', $startDate)
                        ->where('created_at', '<=', $endDate)->get();
        switch ($request->order) {
            case 'week':
                $startDate2 = new Carbon($startDate);
                $endDate = new Carbon($endDate);
                do {
                    $a[$startDate2->format('Y').'-'.$startDate2->format('W')] = ['date' => $startDate2->week, 'views' => 0];
                } while ($startDate2->add(1, 'week')->lte($endDate));
                foreach ($charts as $chart) {
                    $a[$chart->year.'-'.$chart->date]['views'] = $chart->views;
                }
                break;
            case 'month':
                $startDate2 = new Carbon($startDate);
                $endDate = new Carbon($endDate);
                do {
                    $a[$startDate2->format('Y').'-'.$startDate2->format('m')] = ['date' => $startDate2->month, 'views' => 0];
                } while ($startDate2->add(1, 'month')->lte($endDate));
                foreach ($charts as $chart) {
                    $chart->date = $chart->date < 10 ? $a[$chart->year.'-0'.$chart->date]['views'] = $chart->views : $a[$chart->year.'-'.$chart->date]['views'] = $chart->views;                    ;
                }
                break;
            default:
                $startDate2 = new Carbon($startDate);
                $endDate = new Carbon($endDate);
                do {
                    $a[$startDate2->format('Y-m-d')] = ['date' => $startDate2->day, 'views' => 0];
                } while ($startDate2->add(1, 'day')->lte($endDate));
                foreach ($charts as $chart) {
                    $a[$chart->createDate]['views'] = $chart->views;
                }
                break;
        }

        return view('admin.statistical.chart', ['charts' => $a]);
    }

    public function showList(Request $request)
    {
        $films = Film::leftjoin('views_from_time_to_time', 'views_from_time_to_time.id_film', '=', 'film.id');
        switch ($request->order) {
            case 'day':
                $films = $films->select('film.id', 'film.name', DB::raw('SUM(views_from_time_to_time.luot_xem) AS view'), DB::raw('date(views_from_time_to_time.created_at) AS time'));
                break;
            case 'week':
                $films = $films->select('film.id', 'film.name', DB::raw('SUM(views_from_time_to_time.luot_xem) AS view'), DB::raw('week(views_from_time_to_time.created_at) AS time'));
                break;
            case 'month':
                $films = $films->select('film.id', 'film.name', DB::raw('SUM(views_from_time_to_time.luot_xem) AS view'), DB::raw('month(views_from_time_to_time.created_at) AS time'));
                break;

            default:
                $films = $films->select('film.id', 'film.name', DB::raw('SUM(views_from_time_to_time.luot_xem) AS view'));
                break;
        }
        $films = isset($request->order) ? $films->groupBy('film.id', 'film.name', 'time') : $films->groupBy('film.id', 'film.name');
            if (isset($request->sort)) {
                $films = $request->sort == 'View' ? $films->orderBy('view', $request->direction) : $films;
                $films = $request->sort == 'time' ? $films->orderBy('time', $request->direction) : $films;
            } else {
                $films = isset($request->order) ? $films->orderBy('time', 'desc') : $films->orderBy('view', 'desc');
            }

            $films = $films->get();

        return view('admin.statistical.list', ['films' => $films]);
    }

    public function csv(Request $request)
    {
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename = Statistical.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $callback = function () use($request)
        {
            $file = fopen('php://output', 'w');
            $data = $this->showList($request)->films;

            $array = json_decode(json_encode($data),true);

            fputcsv($file, ["id", "name", "views", "time"]);
            foreach ($array as $fields) {
                fputcsv($file, $fields);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function pdf(Request $request)
    {
        $data = $this->showList($request)->films;
    	$pdf = PDF::loadView('admin.statistical.viewPdf',
        [
            'films' => $data
        ]);

        $pdf->setPaper('A4', 'landscape');

    	return $pdf -> download('Statistical.pdf');
    }
}
