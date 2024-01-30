<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaolControllerGrafico extends Controller
{
    public function exibirResultados()
    {
        $resultados = DB::select
        ("SELECT
        cao_usuario.*,
        permissao_sistema.co_sistema,
        permissao_sistema.in_ativo,
        permissao_sistema.co_tipo_usuario,
        DATE_FORMAT(cao_fatura.data_emissao, 'Mês %m') AS mes_referencia,
        ROUND(SUM(cao_fatura.valor - cao_fatura.total_imp_inc), 3) AS receita_liquida,
        cao_salario.brut_salario AS custo_fixo,
        SUM((cao_fatura.valor - cao_fatura.total_imp_inc) * cao_fatura.comissao_cn / 100) AS comissao,
        (SUM(cao_fatura.valor - cao_fatura.total_imp_inc) - cao_salario.brut_salario - SUM((cao_fatura.valor - cao_fatura.total_imp_inc) * cao_fatura.comissao_cn / 100)) AS lucro,
        (SELECT AVG(cao_salario.brut_salario) 
        FROM cao_usuario 
        INNER JOIN permissao_sistema ON cao_usuario.co_usuario = permissao_sistema.co_usuario 
        LEFT JOIN cao_salario ON cao_usuario.co_usuario = cao_salario.co_usuario 
        WHERE permissao_sistema.co_sistema = 1 
        AND permissao_sistema.in_ativo = 'S' 
        AND permissao_sistema.co_tipo_usuario <= 2) AS custo_fixo_medio
    FROM 
        cao_usuario
    INNER JOIN 
        permissao_sistema ON cao_usuario.co_usuario = permissao_sistema.co_usuario
    INNER JOIN 
        cao_os ON cao_usuario.co_usuario = cao_os.co_usuario
    INNER JOIN 
        cao_fatura ON cao_os.co_os = cao_fatura.co_os
    LEFT JOIN 
        cao_salario ON cao_usuario.co_usuario = cao_salario.co_usuario
    WHERE 
        permissao_sistema.co_sistema = 1 
        AND permissao_sistema.in_ativo = 'S' 
        AND permissao_sistema.co_tipo_usuario <= 2
    GROUP BY 
        cao_usuario.co_usuario, 
        permissao_sistema.co_sistema, 
        permissao_sistema.in_ativo, 
        permissao_sistema.co_tipo_usuario,
        cao_salario.brut_salario,
        mes_referencia;
    ");

        return view('resultado-do-botao-grafico')->with('resultados', $resultados);
    }
}
