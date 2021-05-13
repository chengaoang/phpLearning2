<?php
namespace myFrame;

class Model
{
    protected $db;
    protected $table = "";
    protected $options; // 保存SQL的各部分子句
    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->initTable();
        $this->resetOptions();
    }

    protected function initTable()
    {
        if ($this->table === "") {
            $this->table = strtolower(basename(get_class($this)));
        }
    }

    protected function resetOptions()
    {
        $this->options = [
            'where' => '',
            'order' => '',
            'limit' => '',
            'data' => [] // WHERE 字句中的数据部分
        ];
    }

    protected function buildSelect(array $field = []): string
    {
        $field = empty($field) ? '*' : implode(',', $field);
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
        if (!$this->options['limit']) {
            $this->options['limit'] = "limit 1";
        }
        $sql = $this->buildSelect($field);
        $data = $this->db->fetch($sql, $this->options['data']);
        $this->resetOptions();
        return $data;
    }
    // 查询单个字段，参数为字段名
    public function value($field)
    {
        $data = $this->first([$field]);
        return $data ? $data[$field] : null;
    }

    /**
     * 两个参数：（字段，值）
     * 三个参数：（字段，操作符，值）
     * 传递数组参数，用数组的键值来表示字段和值
     */
    public function buildWhere($field, $op, $value, $join = 'AND')
    {
        if (is_array($field)) { // 对数组形式的参数进行处理
            foreach ($field as $key => $value) {
                $this->buildWhere($key, $op, $value, $join);
            }
            return;
        } elseif (is_null($value)) { // 对两个参数的情况进行处理
            $value = $op;
            $op = '=';
        }
        if (empty($this->options['where'])) { // 在第一次调用buildWhere时将$join='WHERE'
            $join = 'WHERE';
        }
        $this->options['where'] .= "$join $field $op ?"; // 拼接WHERE字句
        $this->options['data'][] = $value; // options['data'] 用于为？占位符绑定数据
    }
    // 用AND连接多个WHERE条件
    public function where($field, $op = '=', $value = null)
    {
        $this->buildWhere($field, $op, $value, 'AND');
        $f = $this->options['where'];
        echo $f;
        return $this;
    }
    // 用OR连接多个WHERE条件
    public function orWhere($field, $op = '=', $value = null)
    {
        $this->buildWhere($field, $op, $value, 'OR');
        return $this;
    }

    // 拼接 order by 子句
    public function orderBy($field, $sort = 'ASC')
    {
        $this->options['order'] = "ORDER BY $field $sort";
        return $this;
    }

    // 拼接 limit 子句
    public function limit($offset, $limit = '')
    {
        $limit = $limit ? ", $limit" : '';
        $this->options['limit'] = "LIMIT $offset $limit";
        return $this;
    }

    protected function buildInsert(array $field = [], $count = 1)
    {
        return "INSERT INTO $table ($field) VALUES $value";
    }
    // 返回新增的记录数
    public function insert(array $data = [])
    {
    }
    // 返回最后插入的ID
    public function insertGetId(array $data = [])
    {
    }

    protected function buildUpdate(array $field = [])
    {
        return "UPDATA $table SET $field $where $order $limit";
    }
    // 返回受影响的行数
    public function update(array $field = [])
    {
    }

    protected function buildDelete()
    {
        return "DELETE FROM $table $where $order $limit";
    }
    // 返回受影响的行数
    public function delete()
    {
    }
}
