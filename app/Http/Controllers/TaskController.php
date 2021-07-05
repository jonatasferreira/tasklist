<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     */
    protected $task;

    /**
     * Create a new controller instance.
     *
     * @param  Task  $task
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get one or all tasks.
     *
     * @param  int  $id
     * @return response
     */
    public function show($id = null)
    {
        try {
            if ($id) {
                $data = Task::find(intval($id));
            } else {
                $data = $this->task->all();
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
     * Store a task.
     *
     * @param  Request  $request
     * @return response
     */
    public function store(Request $request)
    {
        try {

            if ( ! $request->filled('title')) {
                return response()->json(["erro" => "Campo title requerido."], 412);
            }
            if ( ! $request->filled('description')) {
                return response()->json(["erro" => "Campo description requerido."], 412);
            }
            if ( ! $request->has('priority') || ! ($request->input('priority')>=1 && $request->input('priority')<=5)) {
                return response()->json(["erro" => "Campo priority requerido [1..5]."], 412);
            }
            if ( ! $request->has('status') || ! ( in_array($request->input('status'),['TODO', 'DOING', 'DONE']) )) {
                return response()->json(["erro" => "Campo status requerido ['TODO', 'DOING', 'DONE']."], 412);
            }
            if ( ! $request->has('user_id') || ! $request->input('user_id')>0) {
                return response()->json(["erro" => "Campo user_id requerido."], 412);
            }
            $userTask = User::find(intval($request->input('user_id')));
            if ( ! $userTask) {
                return response()->json(['erro' => 'Usuário id não encontrado na base de dados.'], 412);
            }

            $this->task->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'priority' => $request->input('priority'),
                'status' => $request->input('status'),
                'user_id' => intval($request->input('user_id')),
            ]);

            return response()->json(["sucesso" => "Tarefa salva com sucesso."], 201);

        } catch (Exception $exception) {
            if (config('app.debug')) {
                return response()->json(['erro' => $exception->getMessage()], 500);
            } else {
                return response()->json(['erro' => "Errou ao processar. Tente novamente."], 500);
            }
        }
    }

    /**
     * Update a task.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return response
     */
    public function update(Request $request, $id)
    {
        try {
            $task = Task::find(intval($id));
            if ( ! $task) {
                return response()->json(['erro' => 'Task id não encontrada na base de dados.'], 412);
            }
            $isUpdatedSomeValue = false;

            if ($request->filled('title')) {
                $task->title = $request->input('title');
                $isUpdatedSomeValue = true;
            }
            if ($request->filled('description')) {
                $task->description = $request->input('description');
                $isUpdatedSomeValue = true;
            }
            if ($request->has('priority')) {
                if ($request->input('priority')<1 || $request->input('priority')>5) {
                    return response()->json(["erro" => "Campo priority requerido [1..5]."], 412);
                }
                $task->priority = $request->input('priority');
                $isUpdatedSomeValue = true;
            }
            if ($request->has('status')) {
                if ( ! in_array($request->input('status'),['TODO', 'DOING', 'DONE']) ) {
                    return response()->json(["erro" => "Campo status requerido ['TODO', 'DOING', 'DONE']."], 412);
                }
                $task->status = $request->input('status');
                $isUpdatedSomeValue = true;
            }
            if ($request->has('user_id')) {
                $userTask = User::find(intval($request->input('user_id')));
                if ( ! $userTask) {
                    return response()->json(['erro' => 'Usuário id não encontrado na base de dados.'], 412);
                }
                $task->user_id = $request->input('user_id');
                $isUpdatedSomeValue = true;
            }
            if ( ! $isUpdatedSomeValue) {
                return response()->json(["erro" => "Envie o(s) campo(s) para atualizar."], 412);
            }

            $task->save();

            return response()->json(["sucesso" => "Task atualizada com sucesso."], 201);

        } catch (Exception $exception) {
            if (config('app.debug')) {
                return response()->json(['erro' => $exception->getMessage()], 500);
            } else {
                return response()->json(['erro' => "Errou ao processar. Tente novamente."], 500);
            }
        }
    }

    /**
     * Delete an task.
     *
     * @param  int  $id
     * @return response
     */
    public function delete($id)
    {
        try {
            $task = Task::find(intval($id));
            if ( ! $task) {
                return response()->json(['erro' => 'Task não encontrado na base de dados.'], 412);
            }

            $task->delete();

            return response()->json(['sucesso'=>'Removido com sucesso.'], 200);

        } catch (Exception $exception) {
            if (config('app.debug')) {
                return response()->json(['erro' => $exception->getMessage()], 500);
            } else {
                return response()->json(['erro' => "Errou ao processar. Tente novamente."], 500);
            }
        }
    }
}