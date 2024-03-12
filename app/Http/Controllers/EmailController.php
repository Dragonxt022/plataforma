<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function enviarEmail(Request $request)
    {


        $to = 'pissinatti2019@gmail.com'; // Substitua pelo seu endereço de e-mail
        $subject = 'PlataformaPL'; // Assunto do e-mail
        $message = 'Mensagem enviada do site Plataforma'; // Conteúdo do e-mail

        // Envie o e-mail
        Mail::raw($message, function ($mail) use ($to, $subject) {
            $mail->to($to)->subject($subject);
        });
        

        $notification = [
            'message' => 'Treinamento cadastrado com sucesso!',
            'alert-type' => 'success',
        ];
        
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
    }
}
