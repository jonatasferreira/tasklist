<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get one or all users.
     *
     * @param  int  $id
     * @return response
     */
    public function show($id = null)
    {
        try {
            if ($id) {
                $data = User::find(intval($id));
            } else {
                $data = $this->user->all();
            }

            return response()->json(["sucesso" => "Operação realiza com sucesso.", "data" => $data], 200);

        } catch (Exception $exception) {
            if (config('app.debug')) {
                return response()->json(['erro' => $exception->getMessage()], 500);
            } else {
                return response()->json(['erro' => "Errou ao processar. Tente novamente."], 500);
            }
        }
    }

    /**
     * Store an user.
     *
     * @param  Request  $request
     * @return response
     */
    public function store(Request $request)
    {
        try {

            if ( ! $request->filled('name')) {
                return response()->json(["erro" => "Campo name requerido."], 412);
            }
            if ( ! $request->filled('email')) {
                return response()->json(["erro" => "Campo email requerido."], 412);
            }
            if ( ! $request->filled('password')) {
                return response()->json(["erro" => "Campo password requerido."], 412);
            }

            $this->user->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),// Hash::make($request->input('password')),
            ]);

            return response()->json(["sucesso" => "Usuário salvo com sucesso."], 201);

        } catch (Exception $exception) {
            if (config('app.debug')) {
                return response()->json(['erro' => $exception->getMessage()], 500);
            } else {
                return response()->json(['erro' => "Errou ao processar. Tente novamente."], 500);
            }
        }
    }

    /**
     * Update an user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find(intval($id));
            if ( ! $user) {
                return response()->json(['erro' => 'Usuário id não encontrado na base de dados.'], 412);
            }
            $isUpdatedSomeValue = false;

            if ($request->filled('name')) {
                $user->name = $request->input('name');
                $isUpdatedSomeValue = true;
            }
            if ($request->filled('email')) {
                $user->email = $request->input('email');
                $isUpdatedSomeValue = true;
            }
            if ($request->filled('password')) {
                $user->password = $request->input('password');// Hash::make($request->input('password'));
                $isUpdatedSomeValue = true;
            }
            if ( ! $isUpdatedSomeValue) {
                return response()->json(["erro" => "Envie o(s) campo(s) para atualizar."], 412);
            }

            $user->save();

            return response()->json(["sucesso" => "Usuário atualizado com sucesso."], 201);

        } catch (Exception $exception) {
            if (config('app.debug')) {
                return response()->json(['erro' => $exception->getMessage()], 500);
            } else {
                return response()->json(['erro' => "Errou ao processar. Tente novamente."], 500);
            }
        }
    }

    /**
     * Delete an user.
     *
     * @param  int  $id
     * @return response
     */
    public function delete($id)
    {
        try {
            $user = User::find(intval($id));
            if ( ! $user) {
                return response()->json(['erro' => 'Usuário não encontrado na base de dados.'], 412);
            }

            $tasks = Task::where('user_id', $user->id)->get();
            if (count($tasks)>0) {
                return response()->json(['erro' => 'Usuário possui '.count($tasks).' task(s). Remova a(s) task(s).'], 412);
            }

            $user->delete();

            return response()->json(['sucesso'=>'Removido com sucesso.'], 200);

        } catch (Exception $exception) {
            if (config('app.debug')) {
                return response()->json(['erro' => $exception->getMessage()], 500);
            } else {
                return response()->json(['erro' => "Errou ao processar. Tente novamente."], 500);
            }
        }
    }

    /**
     * Get all tasks by user.
     *
     * @param  int  $id
     * @return response
     */
    public function showTasks($id)
    {
        try {
            $user = User::find(intval($id));
            if ( ! $user) {
                return response()->json(['erro' => 'Usuário não encontrado na base de dados.'], 412);
            }
            $tasks = Task::where('user_id', $user->id)->get();

            return response()->json(["sucesso" => "Operação realiza com sucesso.", "data" => $tasks], 200);

        } catch (Exception $exception) {
            if (config('app.debug')) {
                return response()->json(['erro' => $exception->getMessage()], 500);
            } else {
                return response()->json(['erro' => "Errou ao processar. Tente novamente."], 500);
            }
        }
    }
}