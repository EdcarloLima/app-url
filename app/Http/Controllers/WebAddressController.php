<?php

namespace App\Http\Controllers;

use App\Helpers\Wizard;
use App\Http\Requests\WebAddressRequest;
use App\Http\Resources\WebAddressResource;
use App\Models\WebAddress;
use App\Http\Resources\WebAddressResource as WebResource;

class WebAddressController extends Controller
{
    use Wizard;

    protected $web;

    public function __construct()
    {
        $this->web = new WebAddress();
    }

    public function index()
    {
        try {
            $address = $this->web->all();

            return response()->json(['success' => true, 'message' => 'Lista de URLs cadastradas.', 'data' => WebResource::collection($address)], 200);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha ao listar as urls.', 'data' => []],500);
        }
    }

    public function store(WebAddressRequest $request)
    {
        try {
            $inputs = [
                'url'         => $request->url,
                'status_code' => $request->status_code,
                'visible'     => $request->visible,
                'content'     => $request->contents
            ];

            $address = $this->web->create($inputs);

            return response()->json(['success' => true, 'message' => 'URL cadastrada com sucesso.', 'data' => new WebAddressResource($address)], 201);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha no cadastro da url.', 'data' => []],500);
        }
    }

    public function show(int $id)
    {
        try {
            $status = 200;
            $items  = [
                'success' => true,
                'message' => 'URL encontrada.',
                'data'    => []
            ];

            $address = $this->web->find($id);
            if (empty($address)) {
                $status           = 404;
                $items['success'] = false;
                $items['message'] = 'URL não encontrada.';
            } else {
                $items['data'] = new WebAddressResource($address);
            }

            return response()->json($items, $status);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha ao exibir os dados.', 'data' => []],500);
        }
    }

    public function update(WebAddressRequest $request, int $id)
    {
        try {
            $status = 200;
            $items  = [
                'success' => true,
                'message' => 'URL atualizada com sucesso.',
                'data'    => []
            ];

            $address = $this->web->find($id);
            if (empty($address)) {
                $status  = 404;
                $items['success'] = false;
                $items['message'] = 'URL não encontrada.';
            } else {
                $inputs = [
                    'url'         => $request->url,
                    'status_code' => $request->status_code,
                    'visible'     => $request->visible,
                    'content'     => $request->contents
                ];

                $feedback = $address->update($inputs);
                $items['data'] = !empty($feedback) ? new WebAddressResource($this->web->find($id)) : $address;
            }

            return response()->json($items, $status);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha ao atualizar os dados.', 'data' => []],500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $status  = 204;
            $items  = [
                'success' => true,
                'message' => 'URL excluída com sucesso.',
                'data'    => []
            ];

            $address = $this->web->find($id);
            if (empty($address)) {
                $status  = 404;
                $items['success'] = false;
                $items['message'] = 'URL não encontrada.';
            } else {
                $address->delete();
            }

            return response()->json($items, $status);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha ao excluir a url.', 'data' => []],500);
        }
    }
}
