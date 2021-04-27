<?php
namespace myFrame;

use PDO;

class DB
{
    protected static $pdoLink;
    protected static $initConfig = []; // 供App类的构造方法调用静态init方法初始化DB+配置文件用
    protected $config = [
        'type' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => '',
        'charset' => 'utf8',
        'user' => 'root',
        'pwd' => ''
    ];
    public function __construct(array $config = [])
    {
        \array_merge($this->config, $config); // TODO：有返回值，面向过程？
        $this->initDB();
    }
    public static function getInstance()
    {
        if (!self::$pdoLink) {
            self::$pdoLink = new static(static::$initConfig);
        }
        return self::$pdoLink;
    }
    public static function init(array $config = [])
    {
        self::$initConfig = $config;
    }

    public function initDB()
    {
        $type = $this->config['type'];
        $host = $this->config['host'];
        $port = $this->config['port'];
        $dbname = $this->config['dbname'];
        $charset = $this->config['charset'];
        $user = $this->config['user'];
        $pwd = $this->config['pwd'];
        $this->pdoLink = new PDO(
            "$type:host=$host;port=$port;dbname=$dbname;charset=$charset",
            "$user",
            "$pwd"
        );
        $this->pdoLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function fetch($sql, array $args = [])
    {
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->execute($args);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function fetchAll($sql, array $args = [])
    {
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->execute($args);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function execute($sql, array $args = [])
    {
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->execute($args);
        return $stmt->rowCount();
    }
}
