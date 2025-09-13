<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tender;

class DatabaseSeeder extends Seeder {
    public function run() {
        // create admin
        User::create([
            'name'=>'Admin User',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password'),
            'role'=>'admin'
        ]);

        // create parties
        $party1 = User::create([
            'name'=>'Party One',
            'email'=>'party1@example.com',
            'password'=>Hash::make('password'),
            'role'=>'party',
            'company_name'=>'Party One Ltd'
        ]);

        $party2 = User::create([
            'name'=>'Party Two',
            'email'=>'party2@example.com',
            'password'=>Hash::make('password'),
            'role'=>'party',
            'company_name'=>'Party Two Co'
        ]);

        // create users
        $u1 = User::create([
            'name'=>'Normal User',
            'email'=>'user@example.com',
            'password'=>Hash::make('password'),
            'role'=>'user'
        ]);

        // create sample tender (pending)
        Tender::create([
            'title'=>'Road Construction Tender',
            'description'=>'Construct 10 km road.',
            'created_by'=>$u1->id,
            'party_id'=>$party1->id,
            'status'=>'pending',
            'closing_date'=>now()->addWeeks(2)->toDateString()
        ]);

        Tender::create([
            'title'=>'IT Infrastructure Tender',
            'description'=>'Set up servers and network.',
            'created_by'=>$u1->id,
            'party_id'=>$party2->id,
            'status'=>'approved',
            'closing_date'=>now()->addWeeks(1)->toDateString()
        ]);
    }
}
