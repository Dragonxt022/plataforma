<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

// models
use App\Models\Inscricoes;
use App\Models\Participante;
use App\Models\Treinamento;
use App\Models\Notification;

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
            $mesAno = Carbon::parse($inscricao->created_at)->format('m/Y'); // Formato: mês/ano

            // Adicionar a quantidade de inscritos ao contador de participantes do mês correspondente
            if (!isset($participantesPorMes[$mesAno])) {
                $participantesPorMes[$mesAno] = 0;
            }
            $participantesPorMes[$mesAno] += $inscricao->quantidade_inscritos;
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

    // Analiza a diferença de inscrições do mês atual com do mês passado
    public function calcularParticipantesMesAtual()
    {
        // Obter todas as inscrições para o mês atual que não estejam canceladas
        $inscricoes = Inscricoes::whereMonth('created_at', date('m'))
            ->where('status', '!=', 'Cancelado')
            ->get();

        // Calcular a quantidade total de participantes do mês atual
        $quantidadeParticipantesAtual = $inscricoes->sum('quantidade_inscritos');

        // Calcular a quantidade total de participantes do mês passado (considerando os últimos 30 dias)
        $quantidadeParticipantesMesPassado = Inscricoes::whereBetween('created_at', [now()->subDays(30), now()])
            ->where('status', '!=', 'Cancelado')
            ->sum('quantidade_inscritos');

        // Calcular a diferença de participantes entre o mês atual e o mês passado
        $diferencaParticipantes = $quantidadeParticipantesAtual - $quantidadeParticipantesMesPassado;

        // Retornar os dados calculados
        return [
            'quantidadeParticipantesAtual' => $quantidadeParticipantesAtual,
            'diferencaParticipantes' => $diferencaParticipantes,
        ];
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

        // Convertendo os valores para string '0' se eles forem zero
        $totalProcessando = $totalProcessando != 0 ? (string)$totalProcessando : '0';
        $totalConcluido = $totalConcluido != 0 ? (string)$totalConcluido : '0';
        $totalCancelado = $totalCancelado != 0 ? (string)$totalCancelado : '0';
        $totalDescontos = $totalDescontos != 0 ? (string)$totalDescontos : '0';

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

    // Calcula o valor total das inscrições do Mês de me retorna o valor total e o valor de diferença do mês passado
    public function calcularTotalInscricoesMesAtual()
    {
        // Calcular a soma total das inscrições do mês atual excluindo as inscrições canceladas
        $totalMesAtual = Inscricoes::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('status', '!=', 'Cancelado')
            ->sum('total');

        // Calcular a soma total das inscrições do mês anterior
        $totalMesAnterior = Inscricoes::whereMonth('created_at', now()->subMonth()->format('m'))
            ->whereYear('created_at', now()->subMonth()->format('Y'))
            ->sum('total');

        // Calcular a diferença percentual entre os meses
        $diferencaPercentual = 0;
        if ($totalMesAnterior != 0) {
            $diferencaPercentual = (($totalMesAtual - $totalMesAnterior) / $totalMesAnterior) * 100;
        }

        // Convertendo os valores para string '0' se eles forem zero
        $totalMesAtual = $totalMesAtual != 0 ? (string) $totalMesAtual : '0';

        // Formatar a diferença percentual para exibir no formato "-2.8%" ou "0%" se for igual a zero
        $diferencaFormatada = sprintf("%.1f%%", $diferencaPercentual);

        // Montar os dados para retornar
        $dadosGanhos = [
            'totalMesAtual' => $totalMesAtual,
            'diferencaFormatada' => $diferencaFormatada,
        ];

        return $dadosGanhos;
    }

    // Caucula as inscrições por dia durante o mês vingente
    public function prepararDadosGrafico()
    {
        // Obter todas as inscrições para o mês atual que não estejam canceladas
        $inscricoes = Inscricoes::whereDate('created_at', '>=', now()->startOfMonth())
            ->whereDate('created_at', '<=', now()->endOfMonth())
            ->where('status', '!=', 'Cancelado')
            ->get();

        // Inicializar arrays para armazenar as categorias e os dados
        $categorias = [];
        $dados = [];

        // Iterar sobre as inscrições para construir as categorias e os dados
        foreach ($inscricoes as $inscricao) {
            // Extrair a data da inscrição
            $dataInscricao = $inscricao->created_at;

            // Formatar a data no formato esperado pelo gráfico
            $categoria = $dataInscricao->format('M d Y'); // Exemplo: Jan 01 2023
            $quantidadeInscritos = $inscricao->total;

            // Adicionar a categoria ao array de categorias (se ainda não estiver presente)
            if (!in_array($categoria, $categorias)) {
                $categorias[] = $categoria;
            }

            // Adicionar a quantidade de inscritos aos dados
            $dados[] = $quantidadeInscritos;
        }

        // Retornar os dados formatados
        return [
            'categories' => $categorias,
            'data' => $dados,
        ];
    }


    // Pesquisa inscrições
    public function pesquisar(Request $request)
    {
        $termo = $request->input('termo');

        // Realize a busca nos modelos desejados
        $inscricoes = Inscricoes::where('id', 'LIKE', "%$termo%")
            ->orWhere('nome_juridico', 'LIKE', "%$termo%")
            ->orWhere('cidade', 'LIKE', "%$termo%")
            ->get();

        $participantes = Participante::where('id', 'LIKE', "%$termo%")
            ->orWhere('nome', 'LIKE', "%$termo%")
            ->orWhere('email', 'LIKE', "%$termo%")
            ->get();

        // Retorne os resultados para a view
        return view('admin.admin_resultado_pesquisa', compact('inscricoes', 'participantes'));
    }

    // Sistema de notificação
    public function showNotifications()
    {
        // Recupere as notificações ordenadas pela data de criação, mais recente primeiro
        $notifications = Notification::orderBy('created_at', 'desc')->take(6)->get();
    
        // Retorne a view da sua sidebar (admin.body.sidebar.blade.php) e passe as notificações como um parâmetro
        return view('admin.body.sidebar', ['notifications' => $notifications]);
    }

    public function ultimasInscricoes()
    {
        // Recupere as últimas 6 inscrições realizadas, ordenadas pela data de criação, mais recente primeiro
        $ultimasInscricoes = Inscricoes::orderBy('created_at', 'desc')->take(6)->get();

        // Retorne as últimas inscrições
        return $ultimasInscricoes;
    }








}
