<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\AnalyticsController;

use App\Models\User;



class AdminControlller extends Controller
{
   public function AdminDashboard(){

    
    $analyticsController = new AnalyticsController();
    $estatisticasTreinamentos = $analyticsController->calcularEstatisticasTreinamentos();

    // Retornar a view com os dados
    return view('admin.index', ['estatisticasTreinamentos' => $estatisticasTreinamentos]);

   } // loga no Dashborard

   public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');

    } // Desconeca to painel administrativo

    public function AdminLogin(){

      return view('admin.admin_login');

    } // Painel de login personalizado

    public function AdminProfile(){

      $id = Auth::user()->id;
      $profileData = User::find($id);

      return view('admin.admin_profile_view', compact('profileData'));
      

    } // Painel de login personalizado
    
    public function AdminProfileStore(Request $request){

      $id = Auth::user()->id;
      $data = User::find($id);
  
      $data->username = $request->username;
      $data->name = $request->name;
      $data->email = $request->email;
      $data->phone = $request->phone;
      $data->address = $request->address;
  
      if ($request->file('photo')){
          // Remover a foto antiga do diretório e do banco de dados
          if ($data->photo) {
              @unlink(public_path('upload/admin_images/' . $data->photo));
              // Remover a foto antiga do banco de dados
              $data->photo = null;
          }
  
          // Carregar a nova foto de perfil
          $file = $request->file('photo');
          $filename = date('YmdHi') . $file->getClientOriginalName();
          $file->move(public_path('upload/admin_images'), $filename);
          $data->photo = $filename;
      }
  
      $data->save();
  
      $notification = array(
          'message' => 'Seu perfil foi atualizado',
          'alert-type' => 'success',
      );
  
      // Retornar a notificação ou redirecionar para a página desejada
      return redirect()->back()->with($notification);

    } // Fim do metodo atualziação perfil


    public function AdminChangePassword(){

      $id = Auth::user()->id;
      $profileData = User::find($id);

      return view('admin.admin_change_password', compact('profileData'));


    } // Fim do metodo
    
    public function AdminUpdatePassword(Request $request){

      $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed'
      ], [
          'old_password.required' => 'O campo Senha antiga é obrigatório.',
          'new_password.required' => 'O campo Nova Senha é obrigatório.',
          'new_password.confirmed' => 'O campo Nova Senha não corresponde ao campo de confirmação.'
      ]);
    

      // Metodo da Nova Senha

      if (!Hash::check($request->old_password, auth::user()->password)){

        $notification = array(
          'message' => 'Sua senha antiga esta digitada incorretamente!',
          'alert-type' => 'error'
        );

        // Retornar a notificação ou redirecionar para a página desejada
        return back()->with($notification);

      }

      // Atualizando a senha
      User::whereId(auth()->user()->id)->update([

        'password' => Hash::make($request->new_password)

      ]);

      $notification = array(
        'message' => 'Sussesso, Sua senha foi atualizada!',
        'alert-type' => 'success',
      );

      // Retornar a notificação ou redirecionar para a página desejada
      return back()->with($notification);

    } // Fim do Metodo

    
    public function ListaDeUsuarios(){

      $id = Auth::user()->id;
      $usuarios = User::all();
  
      return view('admin.admin_lista_profile', compact('usuarios'));
    } // fim do metodo


    public function edit($id){

        $usuarios = User::find($id);

        if (!$usuarios) {
            // Tratar caso o usuário não seja encontrado
            return redirect()->route('admin.admin_lista_profile')->with('error', 'Usuário não encontrado.');
        }

        $roles = User::all(); // Recuperar todas as roles disponíveis do banco de dados

        // Obter o cargo atual do usuário
        $usuarioCargo = $usuarios->role;

        return view('admin.admin_editar_profile', compact('usuarios', 'roles', 'usuarioCargo'));
    } // fim do metodo

  

    public function atualizaPerfil(Request $request, $id){

      // Busca o usuário pelo ID recebido como parâmetro
      $usuario = User::find($id);

      // Verifica se o usuário foi encontrado
      if (!$usuario) {
          // Tratar caso o usuário não seja encontrado
          return redirect()->route('sua_rota_de_redirecionamento')->with('error', 'Usuário não encontrado.');
      }

      // Atualiza os dados do usuário com os dados recebidos do formulário
      $usuario->username = $request->username;
      $usuario->name = $request->name;
      $usuario->email = $request->email;
      $usuario->phone = $request->phone;
      $usuario->address = $request->address;
      $usuario->role = $request->role;

      // Verifica se foi enviada uma nova foto
      if ($request->file('photo')){
          // Remove a foto antiga do diretório e do banco de dados
          if ($usuario->photo) {
              @unlink(public_path('upload/admin_images/' . $usuario->photo));
              // Remove a foto antiga do banco de dados
              $usuario->photo = null;
          }

          // Carrega a nova foto de perfil
          $file = $request->file('photo');
          $filename = date('YmdHi') . $file->getClientOriginalName();
          $file->move(public_path('upload/admin_images'), $filename);
          $usuario->photo = $filename;
      }

      // Salva as alterações no banco de dados
      $usuario->save();

      // Notifica o usuário sobre o sucesso da operação
      $notification = array(
          'message' => 'Perfil foi atualizado',
          'alert-type' => 'success',
      );

      // Redireciona de volta para a página anterior com a notificação
      return redirect()->back()->with($notification);
  }

  public function destroy($id){

      $usuario = User::find($id);
      if (!$usuario) {
          return redirect()->route('admin.lista.profile')->with('error', 'Usuário não encontrado.');
      }

      $usuario->delete();

      $notification = array(
        'message' => 'Sussesso, Usuario foi Excluido!',
        'alert-type' => 'success',
      );

      // Retornar a notificação ou redirecionar para a página desejada
      return back()->with($notification);
  } // fim do metodo

  public function cadastrar(){
    

    return view('admin.admin_cadastrar_profile');

  }

  public function salvar(Request $request)
  {
      // Validação dos dados do formulário com mensagens personalizadas
      $request->validate([
        'username' => 'required|unique:users',
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|email|unique:users',
        'address' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      ], [
        'username.required' => 'O campo de usuário é obrigatório.',
        'username.unique' => 'Este nome de usuário já está em uso.',
        'name.required' => 'O campo de nome é obrigatório.',
        'phone.required' => 'O campo de Celular é obrigatório.',
        'email.required' => 'O campo de email é obrigatório.',
        'email.email' => 'O email fornecido não é válido.',
        'email.unique' => 'Este email já está registrado.',
        'address.required' => 'O campo de endereço é obrigatório.',
        'photo.image' => 'O arquivo deve ser uma imagem.',
        'photo.mimes' => 'O arquivo deve ser do tipo: jpeg, png, jpg ou gif.',
        'photo.max' => 'O tamanho máximo do arquivo é de 2048 KB.'
      ]);

      // Processamento do upload da foto do perfil, se fornecida
      $photoPath = null;
      if ($request->hasFile('photo')) {
          $photoPath = $request->file('photo')->store('upload/admin_images');
      }

      // Criação do novo usuário com base nos dados do formulário
      $novoUsuario = new User();
      $novoUsuario->username = $request->username;
      $novoUsuario->name = $request->name;
      $novoUsuario->phone = $request->phone;
      $novoUsuario->email = $request->email;
      $novoUsuario->address = $request->address;
      $novoUsuario->password = $request->password;
      $novoUsuario->role = $request->role;
      $novoUsuario->photo = $photoPath;

      // Salva o novo usuário no banco de dados
      $novoUsuario->save();

      $notification = array(
        'message' => 'Sussesso, Usuario cadastrado!',
        'alert-type' => 'success',
      );

      // Retornar a notificação ou redirecionar para a página desejada
      return back()->with($notification);
  }

}
