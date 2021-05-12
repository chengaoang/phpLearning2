<?php
namespace myFrame;

class Model{
    protected $db;
    protected $table = "";
    protected $options; // 保存SQL的各部分子句
    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->initTable();
        $this->resetOptions();
    }

    protected function initTable(){
        if ($this->table === ""){
            $this->table = strtolower(basename(get_class($this)));
        }
    }

    protected function resetOptions(){
        $this->options = [
            'where' => '',
            'order' => '',
            'limit' => '',
            'data' => [] // WHERE 字句中的数据部分
        ];
    }

    protected function buildSelect(array $field = []): string
    {
        $field = empty($field) ? '*' : implode(',',$field);
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "SELECT $field FROM $table $where $order $limit";
    }
    // 查询多条记录，参数为字段数组，省略参数则表示所有字段
    public function get(array $field = []): array
    {
        $sql = $this->buildSelect($field);
        $data = $this->db->fetchAll($sql, $this->options['data']);
        $this->resetOptions();
        return $data;
    }
    // 查询单条记录，参数为字段数组，省略参数则表示所有字段
    public function first(array $field = []): array
    {
        if (!$this->options['limit']){
            $this->options['limit'] = "limit 1";
        }
        $sql = $this->buildSelect($field);
        echo $sql;
        $data = $this->db->fetch($sql, $this->options['data']);
        $this->resetOptions();
        return $data;
    }
    // 查询单个字段，参数为字段名
    public function value($field){
        $data = $this->first([$field]);
        return $data ? $data[$field] : null;
    }

}
