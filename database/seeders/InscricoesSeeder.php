<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\User;
use Faker\Factory as Faker;

class InscricoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Recuperar todos os IDs de usuários
        $userIds = User::pluck('id')->toArray();

        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 8; $i++) {
            // Selecionar aleatoriamente um ID de usuário
            $userId = $userIds[array_rand($userIds)];

            $quantidade_inscritos = $faker->numberBetween(1, 10);
            $valor_curso = $faker->randomFloat(2, 1000, 10000);
            $subtotal = $faker->randomFloat(2, 0, 10000);
            $desconto = $faker->randomFloat(2, 0, 1000);
            $total = $faker->randomFloat(2, 0, 10000);
            $data_inicio = $faker->dateTimeBetween('2022-01-01', '2023-12-31')->format('Y-m-d');
            $data_realizacao = $faker->dateTimeBetween('2022-01-01', '2023-12-31')->format('Y-m-d');
            $data_termino = $faker->dateTimeBetween($data_realizacao, '2023-12-31')->format('Y-m-d');
            
            DB::table('inscricoes')->insert([
                'user_id' => $userId,
                'quantidade_inscritos' => $quantidade_inscritos,
                'valor_curso' => $valor_curso,
                'subtotal' => $subtotal,
                'desconto' => $desconto,
                'total' => $total,
                'id_empresa' => 1,
                'pdf_caminho' => null,
                'id_treinamento' => 1,
                'nome_empresa' => $faker->company,
                'data_inicio' => $data_inicio,
                'nome_juridico' => $faker->randomElement(['Câmara Municipal de', 'Prefeitura Municipal de']) . ' ' . $faker->city,
                'cnpj' => $faker->numerify('##.###.###/####-##'),
                'cep' => $faker->postcode,
                'cidade' => $faker->city,
                'bairro' => $faker->streetName,
                'rua' => $faker->streetName,
                'numero' => $faker->buildingNumber,
                'responsavel' => $faker->name,
                'telefone' => $faker->phoneNumber,
                'email' => $faker->email,
                'data_realizacao' => $data_realizacao,
                'status' => $faker->randomElement(['Processando', 'Concluido', 'Cancelado']),
                'data_termino' => $data_termino,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
