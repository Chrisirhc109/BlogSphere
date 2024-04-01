<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function linechart()//LINE CHART
    {
        $userCountsLine = Post::selectRaw('MONTH(created_at) as monthLine, COUNT(*) as countLine')
        ->groupBy('monthLine')
        ->orderBy('monthLine')
        ->get();

        $labelsLine=[];
        $colorsLine=['#FF5733'];
        $dataLine = $userCountsLine->pluck('countLine')->toArray();

        foreach($userCountsLine as $UserCountsLine)
        {
            $monthLine = date('F',mktime(0,0,0,$UserCountsLine->monthLine, 1,0));
            $labelsLine[]=$monthLine;
        }
        return view("pages.dashboards.Line_Graph", ["labelsLine" => $labelsLine, "dataLine" => $dataLine, "colorsLine" => $colorsLine]);
    }

    public function barchartGOOGLE()
    {
        $userCountsGoo = User::selectRaw('MONTH(created_at) as monthGoogle, COUNT(*) as countGoogle')
        ->groupBy('monthGoogle')
        ->orderBy('monthGoogle')
        ->get();

        $data = [['Month','Number of Users']];
        foreach ($userCountsGoo as $UserCountsGoogle){
            $monthName = date('F',mktime(0,0,0,$UserCountsGoogle->monthGoogle,1,0));
            $data[] = [$monthName,$UserCountsGoogle->countGoogle];

        }
        return view("pages.dashboards.Google_chart", compact('data'));
    }

    public function threeD(){
        $userCountsD = User::selectRaw('MONTH(created_at) as monthD, COUNT(*) as countD')
        ->groupBy('monthD')
        ->orderBy('monthD')
        ->get();

        $data3D = [['Month','Number of Users']];
        foreach ($userCountsD as $UserCountsD){
            $monthNama = date('F',mktime(0,0,0,$UserCountsD->monthD,1,0));
            $data3D[] = [$monthNama,$UserCountsD->countD];

        }
        return view('pages.dashboards.Three_D',compact('data3D')); 
    }
    
    public function Tigad()
    {
        $userCountsD = User::selectRaw('MONTH(created_at) as monthD, COUNT(*) as countD')
        ->groupBy('monthD')
        ->orderBy('monthD')
        ->get();

        $data3D = [['Month','Number of Users']];
        foreach ($userCountsD as $UserCountsD){
            $monthNama = date('F',mktime(0,0,0,$UserCountsD->monthD,1,0));
            $data3D[] = [$monthNama,$UserCountsD->countD];

        }
        return view('partials.graphs.hehe',compact('data3D')); 
    }


}
