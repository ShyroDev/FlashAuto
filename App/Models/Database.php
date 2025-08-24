<?


class Database
{
    private  string $DATABASE_ADRESS = "";
    private static string $DATABASE_NAME = "";
    private static string $DATABASE_USERNAME = "";
    private static string $DATABASE_PASSWORD = "";
    private static PDO $connexion;

    public static function Init() : bool
    {
        if(!isset(Database::$connexion))
        {
            try
            {
                Database::$connexion = new PDO("mysql:host=" . Database::$DATABASE_ADRESS . ";dbname=" . Database::$DATABASE_NAME,
                Database::$DATABASE_USERNAME, Database::$DATABASE_PASSWORD);
            }
            catch(PDOException $pdoExeption)
            {
                echo "PDO Exeption : " . $pdoExeption->getMessage();
                return false;
            }

        }

        return true;

    }

    public static function getInstance() : PDO | null
    {
        if(!isset(Database::$connexion))
        {
            return Database::$connexion;
        }

        return null;
    }
}


?>