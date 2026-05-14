<?php
  // Destinatário
$para = "vendas@gelatinaomega.com.br";

// Assunto do e-mail
$assuntoemail = "Contato do através do site ...";

// Campos do formulário de contato
$nome = $_POST['Name'];
$email = $_POST['Email'];
$assunto = $_POST['Subject'];
$mensagem = $_POST['Message'];

// Monta o corpo da mensagem com os campos
$corpo = "<html><body>";
$corpo .= "Nome: $nome ";
$corpo .= "Email: $email Assunto: $assunto Mensagem: $mensagem";
$corpo .= "</body></html>";

// Cabeçalho do e-mail
$email_headers = implode("\n", array("From: $nome", "Reply-To: $email", "Subject: $assuntoemail", "Return-Path: $email", "MIME-Version: 1.0", "X-Priority: 3", "Content-Type: text/html; charset=UTF-8"));

//Verifica se os campos estão preenchidos para enviar então o email
if (!empty($nome) && !empty($email) && !empty($mensagem)) {
    mail($para, $assunto, $corpo, $email_headers);
    $msg = "Sua mensagem foi enviada com sucesso.";
    echo "<script>alert('$msg');window.location.assign('http://www.seusite.com.br/contato');</script>";
} else {
    $msg = "Erro ao enviar a mensagem.";
    echo "<script>alert('$msg');window.location.assign('http://www.seusite.com.br/contato');</script>";
}
?>