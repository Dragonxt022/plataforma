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

        // Iterar sobre os anos (2022 a 2024)
        for ($ano = 2022; $ano <= 2023; $ano++) {
            // Iterar sobre os meses (janeiro a dezembro)
            for ($mes = 1; $mes <= 12; $mes++) {
                // Determinar o número de dias no mês
                $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
                
                // Iterar sobre os dias do mês
                for ($dia = 1; $dia <= $diasNoMes; $dia++) {
                    // Gerar uma data dentro do mês e ano atual
                    $data = "$ano-$mes-$dia";
                    
                    // Determinar a quantidade de inscritos para este dia (número aleatório)
                    $quantidade_inscritos = $faker->numberBetween(1, 10);

                    // Selecionar aleatoriamente um ID de usuário
                    $userId = $userIds[array_rand($userIds)];

                    // Gerar outros dados aleatórios
                    $valor_curso = $faker->randomFloat(2, 1000, 10000);
                    $subtotal = $faker->randomFloat(2, 0, 10000);
                    $desconto = $faker->randomFloat(2, 0, 1000);
                    $total = $faker->randomFloat(2, 0, 10000);
                    $data_inicio = $faker->dateTimeBetween("$ano-01-01", "$ano-12-31")->format('Y-m-d');
                    $data_realizacao = $faker->dateTimeBetween("$ano-01-01", "$ano-12-31")->format('Y-m-d');
                    $data_termino = $faker->dateTimeBetween($data_realizacao, "$ano-12-31")->format('Y-m-d');

                    // Inserir os dados no banco de dados
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
                        'acessibilidade' => $faker->boolean,
                        'data_realizacao' => $data_realizacao,
                        'status' => ($data_realizacao < now()->format('Y-m-d')) ? 'Processando' : (($data_realizacao > now()->format('Y-m-d')) ? 'Concluido' : 'Cancelado'),
                        'data_termino' => $data_termino,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }


}
