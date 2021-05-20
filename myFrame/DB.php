<?php
namespace myFrame;

use Exception;
use PDO;
use PDOException;

class DB
{
    protected static $instance; // 保存单例模式的DB类实例
    protected static $initConfig = []; // 供App类的构造方法调用静态init方法初始化config/database.php配置文件用
    protected $config = [
        'type' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => '',
        'charset' => 'utf8',
        'user' => 'root',
        'pwd' => '',
        'prefix' => ''
    ]; // 缺省配置文件
    private $pdoLink; // PDO 连接

    /**
     * @description DB constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
        $this->initDB();
    }

    /**
     * @description 返回DB实例（单例模式）
     * @return DB
     */
    public static function getInstance(): DB
    {
        // self引用的是当前类(current class)而static允许函数调用在运行时绑定调用类(calling class)（继承时用）
        if (!self::$instance) {
            self::$instance = new static(static::$initConfig); // 后期静态绑定
        }
        return self::$instance;
    }

    /**
     * @description 传入连接配置
     * @param array $config
     */
    public static function init(array $config = [])
    {
        self::$initConfig = $config;
    }

    /**
     * @description 初始化PDO连接
     * @throws Exception
     */
    public function initDB()
    {
        $type = $this->getConfig('type');
        $host = $this->getConfig('host');
        $port = $this->getConfig('port');
        $dbname = $this->getConfig('dbname');
        $charset = $this->getConfig('charset');
        $user = $this->getConfig('user');
        $pwd = $this->getConfig('pwd');
        try {
            $this->pdoLink = new PDO(
                "$type:host=$host;port=$port;dbname=$dbname;charset=$charset",
                "$user",
                "$pwd"
            );
        }catch (Exception $ex){
            throw new Exception("初始化PDO异常:".$ex->getMessage());
        }

        // $this->pdoLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @description 获取单条数据
     * @param $sql
     * @param array $args
     * @return array
     * @throws Exception
     */
    public function fetch($sql, array $args = []): array
    {
        try {
            $stmt = $this->pdoLink->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $ex){
            throw new Exception(__CLASS__." 的 ".__FUNCTION__." 方法执行异常 : ".$ex->getMessage());
        }
    }

    /**
     * @description 获取多条数据
     * @param $sql
     * @param array $args
     * @return array
     * @throws Exception
     */
    public function fetchAll($sql, array $args = []): array
    {
        try {
            $stmt = $this->pdoLink->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $ex){
            throw new Exception(__CLASS__." 的 ".__FUNCTION__." 方法执行异常 : ".$ex->getMessage());
        }
    }

    /**
     * @description 执行sql，返回受影响行数
     * @param $sql
     * @param array $args
     * @return int
     * @throws Exception
     */
    public function execute($sql, array $args = []): int
    {
        try {
            $stmt = $this->pdoLink->prepare($sql);
            $stmt->execute($args);
            return $stmt->rowCount();
        }catch (PDOException $ex){
            throw new Exception(__CLASS__." 的 ".__FUNCTION__." 方法执行异常 : ".$ex->getMessage());
        }
    }

    public function getConfig($key = null)
    {
        return $key ? $this->config[$key] : $this->config;
    }
}
