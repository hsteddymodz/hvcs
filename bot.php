<?php echo 'ON'; ?>

<?php


error_reporting(0);

//Data From Webhook
$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chat_id = $update["message"]["chat"]["id"];
$type = $update["message"]["chat"]["type"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];
$id = $update["message"]["from"]["id"];
$username = $update["message"]["from"]["username"];
$firstname = $update["message"]["from"]["first_name"];
$idioma = $update["message"]["from"]["language_code"];


$dono = "@teddyzinofc";


//debita saldo do usuario (id , valor)
 // DebitaSaldo (109087373 , 1);

function DebitaSaldo($chat_id , $valor){

    include("./conexao.php");

    $sql = "select count(*) as total from usuarios where usuario = $chat_id";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);


    if ($row['total'] == 1){

        $sql = "select * from usuarios where usuario = $chat_id";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row['saldo'] > 0){

            $saldo = $row['saldo'];

            if ($saldo - $valor >= 0 ){

                $re = $saldo - $valor;

                $result_usuario = "UPDATE usuarios SET saldo= $re where usuario = $chat_id";
                $resultado_usuario = mysqli_query($conexao, $result_usuario);

            }else{
                $result_usuario = "UPDATE usuarios SET saldo= 0 where usuario = $chat_id";
                $resultado_usuario = mysqli_query($conexao, $result_usuario);
            }

            
        }else{
            return;
        }

        
    }else{
        return;
    }
    
}

//carrega os usuarios  !

include("./conexao.php");
$sql = "select * from usuarios";
$result = mysqli_query($conexao, $sql);

$vip = [];

while ($row = mysqli_fetch_assoc($result)) {
    $vip[] = $row['usuario'];
}

//verifica os usuarios !

if (in_array($chat_id, $vip)) {


    // verifica se tem saldo !
    $sql = "select * from usuarios where usuario = $chat_id";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['saldo'] <=0){
        SendMessage($chat_id , '' , "
⚠️ Fundos insuficientes. Aumente o seu saldo.

\n ✅ 𝗣𝗟𝗔𝗡𝗢𝗦 𝗘 𝗩𝗔𝗟𝗢𝗥𝗘𝗦
━━━━━━━━━━━━━━━━━━━━━━━━━━
25 Créditos - R$ 25 (R$ 1,00 por Consulta)
35 Créditos - R$ 35 (R$ 1,00 por Consulta)
45 Créditos - R$ 45 (R$ 1,00 por Consulta)
50 Créditos - R$ 50 (R$ 1,00 por Consulta)

Consultas Debitando -1 Do Seu Saldo


 FORMAS DE PAGAMENTO

TRANSFERÊNCIA PIX


Chamar   : $dono");
        die();
    }


$sql = "select * from usuarios";
$result = mysqli_query($conexao, $sql);

$vip = [];

while ($row = mysqli_fetch_assoc($result))
{
    $vip[] = $row['usuario'];
}



  
$total_users = count($vip);

if ((strpos($message, "!send") === 0) || (strpos($message, "/send") === 0)){
$mensagem = substr($message, 6);
$broadcast = urlencode($mensagem);
if ($id == 970330968 || $id == 1464534086 ) { 

 foreach ($vip as $usuarios) {
  $token = file_get_contents('./config/token.txt');
file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$usuarios&text=$broadcast");
   }
SendMessage($chat_id, $message_id, "✅Mensagem enviada para todos usuarios do bot
"); 
}else {
SendMessage($chat_id,$message_id, "⚠️Somente Admins Membro Comum ");
}}

//--------------------------------------------------------------------------------------//

    if ((strpos($message, "!start") === 0)||(strpos($message, "/start") === 0)){
    	
 
    
 SendMessage($chat_id,$message_id, "Olá $firstname \n
/menu para obter lista de comandos \n
/config para ver configurações do bot \n
/perfil exibe suas informacões saldo etc..\n
/donate doacao para manter bot vivo \n
 ");
 
}


if ((strpos($message, "!donate") === 0)||(strpos($message, "/donate") === 0)){
SendMessageMarkdown($chat_id,$message_id, "Enderecos  
	
PIX: `021f3a14-f941-4bfc-b778-ab5c98f3fee6` \n
BTC : `bc1qjf2jjqzt0cl6hylzmr86q5eymv3vmczcjg9nrr` \n
ETH : `0x42138b5e2494e2a80a4783fd3d3a15e955a427f8` \n

 ");
 
}
    
//--------------------------------------------------------------------------------------//

if ((strpos($message, "!config") === 0)||(strpos($message, "/config") === 0)){

	
SendMessage($chat_id,$message_id, "⚙️Informações do bot \n
💾 Versão: 1.0 \n
📆 Date Create: 30/05/2022 \n
⚙️ Linguagem : PHP , MYSQL \n
📥 Ultima Atualização : 19/11/2021 \n
👤Criador Dono bot : @teddyzinofc \n ");

   
}

    // exibe o perfil usuario !
    
    $sql = "select * from usuarios where usuario = $chat_id";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);
    $creditos = $row['saldo'];

//--------------------------------------------------------------------------------------//

    if ((strpos($message, "!perfil") === 0)||(strpos($message, "/perfil") === 0)){
    if ($type == "supergroup"){
$tipo = "GRUPO";
}else{
$tipo = "PRIVADO";
};

    
SendMessage($chat_id,$message_id, "
📜Suas Informações \n
🆔 Seu ID : $chat_id 
🌍 Idioma : $idioma 
🗄️Tipo Chat : $tipo
💰 Seu saldo em reais : R$ $creditos ");
  
 
}
 
 
  
//------------------------------------------------------------------------------------------------------//

    if ((strpos($message, "!menu") === 0)||(strpos($message, "/menu") === 0)){
  

   SendMessageMarkdown($chat_id,$message_id, "
✅ MENU DE COMANDOS
Escolha uma das opções a baixo 

/bin CONSULTA DADOS BIN
/cpf CONSULTA CPF RECEITA

✅ MODO DE USO

Query Disponiveis ( / ou ! )

`/bin 506775`
`/cpf 728.613.557-00`   ");
    
}
//------------------------------------------------------------------------------------------------------//

if ((strpos($message, "!bin") === 0)||(strpos($message, "/bin") === 0)){
$bin = substr($message, 5);


if(empty($bin)){
SendMessage($chat_id,$message_id, "⚠️ Insira Uma Bin");
die();
}

 function GetStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);  
    return $str[0];
};

	  $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://bins-ws-api.herokuapp.com/api/'.$bin.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);         
        $r0 = curl_exec($ch);
        
        // Se Api Der Erro Bot Envia Mensagem erro
if (curl_errno($ch)) {
SendMessage($chat_id, $message_id, "⚠️ Erro Grave Na Api  , Contate Admin ");
die();
}
curl_close($ch);
        
$bin = GetStr($r0, 'bin":"','"');
$tipo = GetStr($r0, 'type":"','"');
$level = GetStr($r0, 'level":"','"');
$bandeira = GetStr($r0, 'brand":"','"');      
$banco = GetStr($r0, 'bank":"','"');  

if ($tipo == ""){
  $tipo = "N/E";
}    

if ($level == ""){
  $level = "N/E";
}    
if ($bandeira == ""){
  $bandeira = "N/E";
}    

if ($banco == ""){
  $banco = "N/E";
}    

if (strpos($r0, 'bin')) {
SendMessageMarkdown($chat_id,$message_id, "
🔎 𝗖𝗢𝗡𝗦𝗨𝗟𝗧𝗔 𝗥𝗘𝗔𝗟𝗜𝗭𝗔𝗗𝗔 🔎

Bin : `$bin`
Tipo : `$tipo`
Level : `$level`
Bandeira : `$bandeira`
Banco : `$banco` ");
}else{
SendMessage($chat_id, $message_id, "❌ BIN NAO ENCONTRADA ");
}}


//consulta dados cnh pelo cpf

if ((strpos($message, "!cpf") === 0) || (strpos($message, "/cpf") === 0)){
$cpf = substr($message, 5);


function GetStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);  
    return $str[0];
};

include("./config/validaCpf.php");
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://botalphacheckers.link/cpf2.php?cpf='.$cpf.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);         
        $r1 = curl_exec($ch);
    
     
// Se Api Der Erro Bot Envia Mensagem erro
if (curl_errno($ch)) {
SendMessage($chat_id, $message_id, "⚠️ Erro Grave Na Api  , Contate Admin ");
die();
}
curl_close($ch);

$nome = GetStr($r1, 'nome": "','"');
$nascimento = GetStr($r1, 'nascimento": "','"');
$sexo = GetStr($r1, 'sexo": "','"');
$nomeMae = GetStr($r1, 'nomeMae": "','"');
$situacao_cadastral = GetStr($r1, 'situacaoCadastral": "','"');


$naturalidade = GetStr($r1, 'naturalidade": "','"');

$rua = GetStr($r1, 'rua": "','"');
$bairro = GetStr($r1, 'bairro": "','"');
$numero = GetStr($r1, 'numeroResidencia": "','"');
$complemento = GetStr($r1, 'complemento": "','"');
$cidade = GetStr($r1, 'cidade": "','"');
$cep = GetStr($r1, 'cep": "','"');
$uf = GetStr($r1, 'uf": "','"');
$signo = GetStr($r1, 'signo": "','"');
$idade = GetStr($r1, 'idade": "','"');


$nascimento = str_replace('\/', '/', $nascimento);

if ($complemento == ""){
  $complemento = "N/E";
}    

if ($numero == ""){
  $numero = "N/E";
}    

if ($cep == ""){
  $cep = "N/E";
}    

if ($uf == ""){
  $uf = "N/E";
}    

    if (strpos($r1, '200')) {
SendMessageMarkdown($chat_id, $message_id, "
🔎 𝗖𝗢𝗡𝗦𝗨𝗟𝗧𝗔 𝗥𝗘𝗔𝗟𝗜𝗭𝗔𝗗𝗔 🔎

Cpf : `$cpf`
Nome : `$nome`
Nascimento : `$nascimento`
Sexo : `$sexo`
Signo : `$signo`
Idade : `$idade`
Mae : `$nomeMae`
Situacao : `$situacao_cadastral`

Naturalidade : `$naturalidade`
Rua : `$rua` Numero `$numero`
Bairro : `$bairro`
Cidade : `$cidade`
Complemento : `$complemento`
Cep : `$cep`
Uf : `$uf`

Foi Descontado - 1 Credito Pela Consulta"); 
DebitaSaldo($chat_id , 1);
}else{
SendMessage($chat_id, $message_id, "❌ CNH NAO ENCONTRADA ");
}}

//-----------------------------------------------------------------------------------------------------------//

}else{
    SendMessage($chat_id,$message_id, "Voce Não Tem Acesso Contate : @teddyzinofc");  

}

function SendMessage($chat_id,$message_id,$message){
    $text = urlencode($message);
    $token = file_get_contents('./config/token.txt');
    file_get_contents("https://api.telegram.org/bot$token/SendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text");
    }
    
    
function SendMessageMarkdown($chat_id,$message_id,$message){
       $text = urlencode($message);
       $token = file_get_contents('./config/token.txt');
       file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text&parse_mode=Markdown");
    }


    
?>
