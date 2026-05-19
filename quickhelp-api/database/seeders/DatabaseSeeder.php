<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use App\Models\Address;
use App\Models\Message;
use App\Models\Sos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar Usuários
        $admin = User::create([
            'name_user' => 'Administrador',
            'email_user' => 'admin@example.com',
            'password_user' => Hash::make('password123'),
            'rule_user' => 'backoffice',
        ]);

        $alice = User::create([
            'name_user' => 'Alice Silva',
            'email_user' => 'alice@example.com',
            'password_user' => Hash::make('password123'),
            'rule_user' => 'user',
        ]);

        $bob = User::create([
            'name_user' => 'Bob Souza',
            'email_user' => 'bob@example.com',
            'password_user' => Hash::make('password123'),
            'rule_user' => 'user',
        ]);

        // 2. Criar Contatos para Alice
        Contact::create([
            'id_user' => $alice->id_user,
            'name_contact' => 'Mãe Alice',
            'phone_contact' => '11999999999',
        ]);

        Contact::create([
            'id_user' => $alice->id_user,
            'name_contact' => 'Pai Alice',
            'phone_contact' => '11988888888',
        ]);

        // 3. Criar Endereços para Alice
        Address::create([
            'id_user' => $alice->id_user,
            'state_address' => 'SP',
            'city_address' => 'São Paulo',
            'neighborhood_address' => 'Bela Vista',
            'street_address' => 'Avenida Paulista',
            'number_address' => '1000',
            'complement_address' => 'Apto 12',
        ]);

        // 4. Criar Mensagens de Teste
        Message::create([
            'name_message' => 'Carlos Pereira',
            'email_message' => 'carlos@example.com',
            'message_message' => 'Gostaria de saber mais sobre as parcerias da Quickhelp.',
            'date_message' => now(),
        ]);

        Message::create([
            'name_message' => 'Mariana Costa',
            'email_message' => 'mariana@example.com',
            'message_message' => 'Parabéns pela plataforma! Muito útil.',
            'date_message' => now(),
        ]);

        // 5. Criar Ocorrências (SOS)
        Sos::create([
            'id_user' => $alice->id_user,
            'date_sos' => now()->subHours(2),
        ]);

        Sos::create([
            'id_user' => $bob->id_user,
            'date_sos' => now()->subHours(1),
        ]);

        Sos::create([
            'id_user' => $bob->id_user,
            'date_sos' => now(),
        ]);
    }
}
