<?php

class JobAds {

    private $job_ads = [
        1=>[
            'id'=>1,
            'title'=>'Architect'
        ],
        2=>[
            'id'=>2,
            'title'=>'Doctor'
        ],
        3=>[
            'id'=>3,
            'title'=>'Nurse'
        ]        
    ];
    

    public function __construct()
    {
    }

    public function getAllJobAds()
    {
        return $this->job_ads;
    }

}
