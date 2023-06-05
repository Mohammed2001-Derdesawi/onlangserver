<?php
namespace Modules\Admin\Repositories\Interfaces;

interface SettingInterface{


    public function updateHomePage($request);
    public function updateuAboutUsPage($request);
    public function updateMonthlySubscribesPage($request);
    public function getSettingBykey($key);
    public function updateGeneralInfo($request);




}
