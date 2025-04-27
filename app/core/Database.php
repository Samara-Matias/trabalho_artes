<?php
    // Criando uma classe 'Database' para criar uma conexão com um banco de dados
    class Database {
        // Criando propriedade privada (só é acessada dentro de uma classe) e atributo estático (pertence a classe, não ao objeto em si)
            // Não é preciso criar um objeto Database para acessá-lo
        private static $pdo = null;

        // Função para criar a conexão com o banco de dados ou retornar uma conexão já existente
        public static function conectarDB() {
            // Veficando se o $pdo ainda não foi estabelecida. Se ela for null, criamos uma conexão nova com o banco de dados
            // OBS: o 'self::' é usado para quando variável ou método de uma classe é definida como estática; o $this é usada para cada objeto específico criado
            if (self::$pdo === null) {
                try {
                    $host = DB_HOST;
                    $dbName = DB_NAME;
                    $dbUsername = DB_USERNAME;
                    $dbSenha = DB_PASSWORD;

                    // Criando nova conexão com o banco de dados
                    self::$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $dbUsername, $dbSenha);

                    // Adicionando atributos para a conexão com o banco de dados em caso de erros de conexão
                        // ATTR_ERRMODE define o modo como os erros do PDO deverão ser tratados
                        // PDO::ERRMODE_EXCEPTION -> lança uma excessão além do de avisos ou warnings caso haja erro na execução de consultas
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch (PDOException $erro) {
                    // Caso haja algum erro, envia-se uma mensagem de erro e encerra-se a execução do código
                    die('Erro ao conectar ao banco de dados: ' . $erro->getMessage());
                }
            }
            return self::$pdo;
        }
    }
?>