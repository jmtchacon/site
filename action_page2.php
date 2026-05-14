<?php

/* apenas dispara o envio do formulário caso exista $_POST['enviarFormulario']*/
if (isset($_POST['Enviar'])){
 
 
/*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/

//Nome do destinatário que receberá formulário (somente para exibição de um nome ao invés de só o email)
$enviaFormularioParaNome = 'Contato - Gelatina';
//E-mail do destinatário
$enviaFormularioParaEmail = 'vendas@gelatinaomega.com.br';

//Nome do remetente
$caixaPostalServidorNome = 'Contado - Gelatina Omega';
//E-mail (usuário) remetente (de onde sairá a mensagem)
$caixaPostalServidorEmail = 'contato@gelatinaomega.com.br';
//Senha da conta de email que irá enviar a mensagem
$caixaPostalServidorSenha = 'CONT2019@';

/*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/ 
  
/* Variáveis que irão armazenar os dados que virão do formulario*/
$remetenteNome  = $_POST['nome'];
$remetenteEmail = $_POST['email'];
$assunto  = $_POST['assunto'];
$mensagem = $_POST['mensagem'];

//Mensagem que será o corpo do email
$mensagemConcatenada = '<html>';
$mensagemConcatenada .= '<body>';
$mensagemConcatenada .= '<h2>Mensagem enviada pelo formulário de contato - gelatinaomega</h2><br/><br/>';
$mensagemConcatenada .= '-------------------------------<br/>'; 
$mensagemConcatenada .= 'Nome: '.$remetenteNome.'<br/>'; 
$mensagemConcatenada .= 'E-mail: '.$remetenteEmail.'<br/>'; 
$mensagemConcatenada .= 'Assunto: '.$assunto.'<br/>';
$mensagemConcatenada .= '-------------------------------<br/><br>'; 
$mensagemConcatenada .= 'Mensagem: <i>'.$mensagem.'</i><br/><br>';
$mensagemConcatenada .= '</body>';
$mensagemConcatenada .= '</html>';
 
 
/************* CONFIGURAÇÃO DOS MÉTODOS - NÃO É NECESSÁRIO ALTERAR **************************/ 

require_once('phpmailer/PHPMailerAutoload.php');

$mail = new PHPMailer();
 
$mail->IsSMTP();
$mail->SMTPAuth  = true;
$mail->Charset   = 'utf8_decode()';
$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
$mail->Port  = '587';
$mail->Username  = $caixaPostalServidorEmail;
$mail->Password  = $caixaPostalServidorSenha;
$mail->From  = $caixaPostalServidorEmail;
$mail->FromName  = utf8_decode($caixaPostalServidorNome);
$mail->IsHTML(true);
$mail->Subject  = utf8_decode($assunto);
$mail->Body  = utf8_decode($mensagemConcatenada);

/************************* FIM DA CONFIGURAÇÃO DOS MÉTODOS *******************************/  
 
$mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
 
 //Método para envio do email
if(!$mail->Send()){
$mensagemRetorno = 'Erro ao enviar formulário: '. print($mail->ErrorInfo);
}else{
$mensagemRetorno = 'Mensagem enviada com sucesso!';
}

echo $mensagemRetorno; 
 
}
?>