<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@nafero.com";
        $administrator->role_id = 1;
        $administrator->password = \Hash::make("erporate");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->status = "ACTIVE";
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
