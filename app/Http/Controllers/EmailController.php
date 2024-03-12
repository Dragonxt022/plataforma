<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function enviarEmail(Request $request)
    {
        // Prepare os dados para o e-mail
        $dadosEmail = [
            'nome' => $request->input('name'),
            'telefone' => $request->input('phone'),
            'email' => $request->input('email'),
            'tipo_direito' => $request->input('law_type'),
            'mensagem' => $request->input('message'),
        ];

        // Log dos dados do e-mail
        Log::info('Dados do e-mail a serem enviados: ' . json_encode($dadosEmail));

        // Envie o e-mail
        Mail::send('emails.contato', $dadosEmail, function ($message) {
            $message->to('pissinatti2019@gmail.com', 'PlataformaPL')
                    ->subject('CONTATO - Novo e-mail');
        });

        // Retorne uma resposta de sucesso ou redirecione com uma mensagem de sucesso
        return redirect()->back()->with('success', 'E-mail enviado com sucesso!');

    }
}
