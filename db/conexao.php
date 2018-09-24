 <?php 

 //configura conexão
 define('HOST', '127.0.0.1'); // Desenv
 define('DBNAME', 'u136429679_facul'); // Desenv
 define('CHARSET', 'utf8'); // Desenv
 define('USER', 'root'); // Desenv
 define('SENHA', ''); // Desenv

// define('HOST', '185.201.11.44');
// define('DBNAME', 'u136429679_facul');
// define('CHARSET', 'utf8');
// define('USER', 'u136429679_facul');
// define('SENHA', 'trabalho');


 class Conexao {  

   private static $conn;

   private function __construct() {  
     //  
   } 
 
   /* 
   Método estático para retornar uma conexão válida  
   Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão  
    */  
   public static function getInstance() {  
     if (!isset(self::$conn)) {  
       try {  
        
         self::$conn = mysqli_connect(HOST,USER,SENHA,DBNAME);
         mysqli_set_charset(self::$conn, CHARSET); 

       } catch (Exception $e) {  
         print "Erro: " . $e->getMessage();  
       }  
     }  
     return self::$conn;  
   }

  /* Metodo para fechar a conexao */
  public function fecharConexao($conexao){
      mysqli_close($conexao) or die(mysqli_error($conexao));
  }

 }

