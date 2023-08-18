<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginaController extends Controller
{

    public function show($idRol)
    {
        $pages = DB::table('permissionsRoles')
            ->join('roles', 'roles.id', '=', 'permissionsRoles.idRole')
            ->join('pages', 'pages.id', '=', 'permissionsRoles.idPage')
            ->where('roles.id', $idRol)
            ->select('pages.*')
            ->get();

        return response()->json($pages);
    }
}
