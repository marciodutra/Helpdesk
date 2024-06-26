<?php	

	include_once("../include/banco.php");
	$html = '<table border=2';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Setor:</th>';
	$html .= '<th>Solicitação:</th>';
	$html .= '<th>Problema:</th>';
	$html .= '<th>Nº da Maquina:</th>';
    $html .= '<th>Data do chamado:</th>';
	$html .= '<th>Status:</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
	$result_transacoes = "SELECT * FROM chamados where status = 'Pendente'";
	$resultado_trasacoes = mysqli_query($con, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		$html .= '<tr><td>'.$row_transacoes['setorcall'] . "</td>";
		$html .= '<td>'.$row_transacoes['solicitacao'] . "</td>";
		$html .= '<td>'.$row_transacoes['problema'] . "</td>";
		$html .= '<td>'.$row_transacoes['numaquina'] . "</td>";
        $html .= '<td>'.$row_transacoes['data'] . "</td>";
		$html .= '<td>'.$row_transacoes['status'] . "</td></tr>";		
	}
	
	$html .= '</tbody>';
	$html .= '</table';

	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$dompdf->loadHtml('
			<h1 style="text-align: center;">System Help Desk - Relatório de chamados pendentes</h1>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"Chamados_Pendentes", 
		array(
			"Attachment" => true //Para realizar o download somente alterar para true
		)
	);
?>