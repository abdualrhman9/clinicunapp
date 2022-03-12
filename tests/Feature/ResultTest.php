<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResultTest extends TestCase
{
    
    /** @test */
    public function store_test() {
        $this->post('/api/patients/results',$this->getdata());
    }

    private function getData(){
        
    }
}
