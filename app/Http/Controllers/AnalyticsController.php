<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// models
use App\Models\Inscricoes;
use App\Models\Participante;
use App\Models\Treinamento;

class AnalyticsController extends Controller
{   
    // Analiza o a quantidade de participantes por treinamento e o valor arrecadado, fora os cancelados
    public function calcularEstatisticasTreinamentos()
    {
        
         // Obter os 5 primeiros treinamentos distintos
        $treinamentos = Treinamento::distinct()->take(5)->get();

        // Inicializar array para armazenar os resultados
        $resultados = [];

        // Iterar sobre os treinamentos
        foreach ($treinamentos as $treinamento) {
            // Obter todas as inscrições para este treinamento
            $inscricoes = Inscricoes::where('id_treinamento', $treinamento->id)->get();

            // Inicializar variáveis para calcular estatísticas
            $quantidadeTotalInscritos = 0;
            $valorTotalVendido = 0;

            // Iterar sobre as inscrições
            foreach ($inscricoes as $inscricao) {
                // Somar a quantidade de inscritos
                $quantidadeTotalInscritos += $inscricao->quantidade_inscritos;

                // Calcular o valor total vendido
                $valorTotalVendido += $inscricao->total;
            }

            

            // Adicionar os resultados ao array
            $resultados[] = [
                'id' => $treinamento->id,
                'imagem' => $treinamento->banner ? asset('upload/cursos_images/' . $treinamento->banner) : asset('upload/cursos_images/semimagembanner.png'),
                'nome' => $treinamento->nome,
                'data_inicio' => $treinamento->data_inicio,
                'status' => $treinamento->status,
                'quantidade_inscritos' => $quantidadeTotalInscritos,
                'valor_total_vendido' => $valorTotalVendido,
                'data_termino' => $treinamento->data_termino,
            ];

            
        }

        // Ordenar os resultados pelo número de inscritos
        usort($resultados, function($a, $b) {
            return $b['quantidade_inscritos'] - $a['quantidade_inscritos'];
        });

        // dd($resultados);

        return $resultados;
    }

    // Analiza a quantidade de participantes dos mêses durante o ano
    public function participantesPorMes()
    {
        // Coletar os dados das inscrições excluindo os cancelados
        $inscricoes = Inscricoes::where('status', '!=', 'Cancelado')->get();

        // Inicializar um array para armazenar o número de participantes de cada mês
        $participantesPorMes = [];

        // Iterar sobre as inscrições e agrupar os dados por mês
        foreach ($inscricoes as $inscricao) {
            $dataRealizacao = Carbon::parse($inscricao->data_realizacao);
            $mesAno = $dataRealizacao->format('m/Y'); // Formato: mês/ano

            // Adicionar a quantidade de inscritos ao contador de participantes do mês correspondente
            if (!isset($participantesPorMes[$mesAno])) {
                $participantesPorMes[$mesAno] = 0;
            }
            $participantesPorMes[$mesAno] += $inscricao->quantidade_inscritos;
        }

        // Preencher os meses ausentes com zero
        $mesAtual = Carbon::now();
        $mesAtual->subMonths(11); // Retrocede 11 meses a partir do mês atual
        for ($i = 0; $i < 12; $i++) {
            $mes = $mesAtual->format('m/Y');
            if (!isset($participantesPorMes[$mes])) {
                $participantesPorMes[$mes] = 0;
            }
            $mesAtual->addMonth(); // Avança para o próximo mês
        }

        // Ordenar o array pelos meses
        ksort($participantesPorMes);

        // Formatar os dados para o formato esperado pelo gráfico
        $labels = [];
        $valores = [];

        foreach ($participantesPorMes as $mes => $participantes) {
            $labels[] = $mes;
            $valores[] = $participantes;
        }

        // Retornar os dados para serem utilizados no gráfico
        return response()->json([
            'labels' => $labels,
            'valores' => $valores,
        ]);
    }

    // Analiza por dia do mês inteiro a quantidade de participante
    public function participantesPorDiaMes()
    {
        // Obter todas as inscrições para o mês atual que não estejam canceladas
        $inscricoes = Inscricoes::whereMonth('created_at', date('m'))
            ->where('status', '!=', 'Cancelado')
            ->get();

        // Inicializar um array para armazenar a quantidade de inscritos por dia
        $inscritosPorDia = [];

        // Loop pelas inscrições e somar a quantidade de inscritos em cada dia do mês
        foreach ($inscricoes as $inscricao) {
            // Extrair o dia do timestamp de criação da inscrição
            $dia = date('d', strtotime($inscricao->created_at));

            // Extrair o mês do timestamp de criação da inscrição
            $mes = date('M', strtotime($inscricao->created_at));

            // Formatar a data no formato desejado (dia, mês, quantidade)
            $dataFormatada = "$dia $mes";

            // Somar a quantidade de inscritos para o dia correspondente
            if (isset($inscritosPorDia[$dataFormatada])) {
                $inscritosPorDia[$dataFormatada] += $inscricao->quantidade_inscritos;
            } else {
                $inscritosPorDia[$dataFormatada] = $inscricao->quantidade_inscritos;
            }
        }

        // Retornar os dados no formato JSON
        return response()->json($inscritosPorDia);
    }

    // Informações de Ganhos perdas e descontos dados
    public function informacoesInscricoes()
    {
        // Calcular a soma total das inscrições com status Processando
        $totalProcessando = Inscricoes::where('status', 'Processando')->sum('total');

        // Calcular a soma total das inscrições com status Concluído
        $totalConcluido = Inscricoes::where('status', 'Concluido')->sum('total');

        // Calcular a soma total das inscrições com status Cancelado
        $totalCancelado = Inscricoes::where('status', 'Cancelado')->sum('total');

        // Calcular a soma total dos descontos dados em todas as inscrições, excluindo as com status Cancelado
        $totalDescontos = Inscricoes::where('status', '!=', 'Cancelado')->sum('desconto');

        // Montar os dados para retornar
        $dados = [
            'totalProcessando' => $totalProcessando,
            'totalConcluido' => $totalConcluido,
            'totalCancelado' => $totalCancelado,
            'totalDescontos' => $totalDescontos,
        ];

        // Retornar os dados no formato JSON
        return response()->json($dados);
    }




}
