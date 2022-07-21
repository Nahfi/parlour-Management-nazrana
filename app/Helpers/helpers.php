<?php
    function generalSettings(){
        $generalSettings = App\Models\GeneralSettings::latest()->first();
        return $generalSettings;
    }
    //pending attendance count
    function pendingAttendance(){
        return App\Models\Attendance::where('status','Pending')->count();
    }