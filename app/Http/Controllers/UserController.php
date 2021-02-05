<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class UserController extends Controller
{
  private function getUsers()
  {
    // Busca os dados na API usando o protocolo GET
    $get_response = Http::withHeaders([
      'accept' => 'application/json'
    ])
      ->get('https://eagle-backend-dev.somosagility.com.br/getTeste')
      ->body();

    // Busca os dados na API usando o protocolo POST
    $post_response = Http::withHeaders([
      'accept' => 'application/json'
    ])
      ->post('https://eagle-backend-dev.somosagility.com.br/postTeste?key=%4056a9yRoC%23M56y0tW')
      ->body();

    // Decodifica o JSON, e busca a propriedade onde os objetos de usuário estão
    $get_response_users = json_decode($get_response, true)['user'];
    $post_response_users = json_decode($post_response, true)['user']['entries'];

    // Une os resultados das duas chamadas em um único array de usuários
    $users = Arr::collapse([$get_response_users, $post_response_users]);

    // Cria uma coleção e ordena por empresa
    $collection = collect($users);
    $sorted = $collection->sortBy('customer', SORT_NATURAL);

    $sorted_users = $sorted->values()->all();

    return $sorted_users;
  }

  public function listUsers()
  {
    $users = $this->getUsers();

    return view('listUser')->with(['users' => json_decode(json_encode($users))]);
  }

  public function filterUsers(Request $request)
  {
    $name = $request->name;
    $email = $request->email;
    $customer = $request->customer;

    $users = $this->getUsers();

    if ($name) {
      $users = array_filter($users, function ($user) use ($name) {
        return $user['name'] == $name;
      });
    }

    if ($customer) {
      $users = array_filter($users, function ($user) use ($customer) {
        return $user['customer'] == $customer;
      });
    }

    if ($email) {
      $users = array_filter($users, function ($user) use ($email) {
        return $user['email'] == $email;
      });
    }

    return view('listUser')->with(['users' => json_decode(json_encode($users))]);
  }
}
