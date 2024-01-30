<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaolControllerRelatorioCliente extends Controller
{
    public function exibirResultados()
    {
        $resultados = DB::select
        ("SELECT 
        cao_cliente.co_cliente,
        cao_cliente.no_contato,
        cao_cliente.nu_telefone,
        DATE_FORMAT(cao_fatura.data_emissao, '%Y-%m') AS mes_referencia,
        ROUND(SUM(cao_fatura.valor - cao_fatura.total_imp_inc), 3) AS receita,
        CASE WHEN ROUND(SUM(cao_fatura.valor - cao_fatura.total_imp_inc), 3) = MAX(ROUND(SUM(cao_fatura.valor - cao_fatura.total_imp_inc), 3)) OVER (PARTITION BY DATE_FORMAT(cao_fatura.data_emissao, '%Y-%m')) THEN 1 ELSE 0 END AS is_champion
    FROM 
        cao_cliente
    INNER JOIN 
        cao_fatura ON cao_cliente.co_cliente = cao_fatura.co_cliente
    WHERE 
        cao_cliente.tp_cliente = 'A'
    GROUP BY 
        cao_cliente.co_cliente, mes_referencia
    ORDER BY 
        mes_referencia, receita DESC;");

        return view('resultado-do-botao-relatorio-cliente')->with('resultados', $resultados);
    }
}
