<?php

namespace App\Http\Controllers;

use App\Helpers\Wizard;
use App\Http\Requests\WebAddressRequest;
use App\Models\WebAddress;
use Illuminate\Http\Request;

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

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha ao listar as urls.', 'status_code' => 500]);
        }
    }

    public function store(WebAddressRequest $request)
    {
        try {

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha no cadastro da url.', 'status_code' => 500]);
        }
    }

    public function show(int $id)
    {
        try {

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha ao exibir os dados.', 'status_code' => 500]);
        }
    }

    public function update(WebAddressRequest $request, int $id)
    {
        try {

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha ao atualizar os dados.', 'status_code' => 500]);
        }
    }

    public function destroy(int $id)
    {
        try {

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['success' => false, 'message' => 'Falha ao excluir a url.', 'status_code' => 500]);
        }
    }
}
