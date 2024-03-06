<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
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
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('inscricoes')->insert([
                'quantidade_inscritos' => $faker->randomNumber(2),
                'valor_curso' => $faker->randomFloat(2, 1000, 10000),
                'subtotal' => $faker->randomFloat(2, 0, 10000),
                'desconto' => $faker->randomFloat(2, 0, 1000),
                'total' => $faker->randomFloat(2, 0, 10000),
                'id_empresa' => 1,
                'pdf_caminho' => null,
                'nome_treinamento' => $faker->sentence(),
                'id_treinamento' => 1,
                'nome_empresa' => $faker->company,
                'data_inicio' => $faker->date(),
                'nome_juridico' => $faker->companySuffix,
                'cnpj' => $faker->numerify('##.###.###/####-##'),
                'cep' => $faker->postcode,
                'cidade' => $faker->city,
                'bairro' => $faker->streetName,
                'rua' => $faker->streetName,
                'numero' => $faker->buildingNumber,
                'responsavel' => $faker->name,
                'telefone' => $faker->phoneNumber,
                'email' => $faker->email,
                'data_realizacao' => $faker->date(),
                'status' => $faker->randomElement(['Processando', 'Pago', 'Cancelado']),
                'data_termino' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
