<?php
    include "conn.php";
    $report = $_POST['report'];
    $BPID = $_GET['BPID'];

    if($report == 'daily'){
        $dailydate = $_POST['date'];
        echo "<script>window.location.href='DailyReport.php?BPID=$BPID&date=$dailydate';</script>";
    }else if($report == 'weekly'){
        $w_startdate = $_POST['startdate'];
        $w_enddate = $_POST['enddate'];
        echo "<script>window.location.href='WeeklyReport.php?BPID=$BPID&startdate=$w_startdate&enddate=$w_enddate';</script>";
    }else if($report == 'monthly'){
        $m_month = $_POST['m_month'];
        $m_year = $_POST['m_year'];
        echo "<script>window.location.href='MonthlyReport.php?BPID=$BPID&month=$m_month&year=$m_year';</script>";
    }else if($report == 'annual'){
        $a_year = $_POST['a_year'];
        echo "<script>window.location.href='AnnualReport.php?BPID=$BPID&year=$a_year';</script>";
    }

?>