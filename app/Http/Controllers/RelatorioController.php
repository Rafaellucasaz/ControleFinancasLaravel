<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Programa;
use Illuminate\Http\Request;
use Mpdf\Mpdf;


class RelatorioController extends Controller
{
    public function gerarRelatorio(Request $request){

        $programasProap = Programa::whereYear('created_at', $request->ano)->where('tipo_prog','proap')->get();
        $programasProapinho = Programa::whereYear('created_at', $request->ano)->where('tipo_prog','proapinho')->get();
        $pedidos = Pedido::whereYear('created_at', $request->ano)->get();


        $html = "<!DOCTYPE html>
        <html>
        <head>
        <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        
        td, th {
          border: 1px solid black;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        h2{text-align:center;}
        </style>
        </head>
        <body>
        
        <h1>Proap</h1>
        
        <table>
        <caption> Valores recebidos </caption>
          <tr>
            <th>Programa</th>
            <th>Diária civil</th>
            <th>Diária internacional</th>
            <th>Passagem</th>
            <th>SEPE</th>
            <th>Não servidor</th>
            <th>Auxílio estudantil</th>
            <th>Auxílio pesquisador</th>
            <th>Mat. de consumo</th>
            <th>Serv. de terceiros</th>
            <th>Transporte</th>
            <th>total</th>
          </tr>";
          foreach($programasProap as $programa){
              $html .=
                "<tr>
                    <td>". $programa->nom_prog ."</td>
                    <td>". number_format($programa->dia_civ/100,2,',','.') . "</td>
                    <td>". number_format($programa->dia_int/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->pass/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->sepe/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->nao_serv/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->aux_estu/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->aux_pesq/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->cons/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->ser_ter/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->tran/100,2, ',', '.') . "</td>
                    <td>". number_format($programa->total/100,2, ',', '.') . "</td>
                  </tr>
                ";
          }

          $html .= "
 
          </table>
        
          <table>
            <caption> Valores gastos </caption>
              <tr>
              <th>Programa</th>
              <th>Diária civil</th>
              <th>Diária internacional</th>
              <th>Passagem</th>
              <th>SEPE</th>
              <th>Não servidor</th>
              <th>Auxílio estudantil</th>
              <th>Auxílio pesquisador</th>
              <th>Mat. de consumo</th>
              <th>Serv. de terceiros</th>
              <th>Transporte</th>
              <th>total</th>
            </tr>";

          foreach($programasProap as $programa){
           
            $html .= "<tr> 
            <td> "  .$programa->nom_prog ." </td>
            <td> " .  number_format(calcularTotalPedidos("dia_civ",$pedidos,$programa->id_prog),2, ',', '.') ." </td>
            <td> " .  number_format(calcularTotalPedidos("dia_int",$pedidos,$programa->id_prog),2, ',', '.') ." </td>
            <td> " .  number_format(calcularTotalPedidos("pass",$pedidos,$programa->id_prog),2, ',', '.') ." </td>
            <td> " .  number_format(calcularTotalPedidos("sepe",$pedidos,$programa->id_prog),2, ',', '.') ." </td>
            <td> " .  number_format(calcularTotalPedidos("nao_serv",$pedidos,$programa->id_prog),2, ',', '.') ." </td>
            <td> " .  number_format(calcularTotalPedidos("aux_estu",$pedidos,$programa->id_prog),2, ',', '.') ." </td>
            <td> " .  number_format(calcularTotalPedidos("aux_pesq",$pedidos,$programa->id_prog),2, ',', '.') ."</td>
            <td> " .  number_format(calcularTotalPedidos("cons",$pedidos,$programa->id_prog),2, ',', '.') ."</td>
            <td> " .  number_format(calcularTotalPedidos("ser_ter",$pedidos,$programa->id_prog),2, ',', '.') ."</td>
            <td> " .  number_format(calcularTotalPedidos("tra",$pedidos,$programa->id_prog),2, ',', '.') ."</td>
            <td> " .  number_format(calcularTotalPedidos("todos",$pedidos,$programa->id_prog),2, ',', '.') ."</td>
          </tr>";
          }

          $html.= 
            "</table>";
          
          foreach($programasProap as $programa){
            $html.= " <h2> Pedidos " . $programa->nom_prog ."</h2>";
            $atributos = $programa->only(['dia_civ','dia_int','pass','sepe','nao_serv','aux_estu','aux_pesq','cons','ser_ter','tran']);
            foreach($atributos as $atributo => $columnValue){
              $html .=
              "<table>
                <caption>" .  getTipoPed($atributo) . "</caption>
                <thead>
                  <tr>
                    <th>Número do pedido</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Detalhamento</th>
                    <th>Beneficiado</th>
                    <th>Número PCDP</th>
                    <th>Prestação de contas</th>
                  </tr> 
                </thead>
                <tbody>";
              foreach($pedidos as $pedido){
                if($pedido->id_progfk === $programa->id_prog && $pedido->tipo_ped === $atributo){
                  $html.=  
                  "<tr>
                    <td>" . $pedido->num_ped .  "</td>
                    <td>" . $pedido->data . "</td>
                    <td>" . $pedido->val .  "</td>
                    <td>" . $pedido->det . "</td>
                    <td>" . $pedido->ben . "</td>
                    <td>" . $pedido->pcdp . "</td>
                    <td>" . $pedido->prest . "</td>
                  </tr>";
                }
              }
              $html .= " </tbody></table>";
            }
          }
          $html .= " 
           </body> </html>";
         
        $relatorio = new Mpdf();
        $relatorio->SetDisplayMode('fullpage');
        $relatorio->WriteHTML($html);
        
          return response($relatorio->output());
    }
}
