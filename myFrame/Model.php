<?php
namespace myFrame;

use Exception;

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
            $this->table = $this->db->getConfig('prefix').strtolower(basename(get_class($this)));
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
    public function first(array $field = []): array|bool
    {
        if (!$this->options['limit']) $this->limit(1);
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
        // 根据field的元素数量填充？占位符
        $value = array_fill(0,count($field),'?');
        // 将值拼接成(?,?)
        $value = '('.implode(',',$value).')';
        // 根据插入的条数count，将值拼成(?,?),(?,?)
        $value = implode(',', array_fill(0, $count, $value));

        $table = $this->table;

        $field = implode(',', $field);

        return "INSERT INTO $table ($field) VALUES $value";
    }
    /**
     * 新增数据<br>
     * $student->insert(['name'=>'jame','gender'=>'男']); <br>
     * $student->insert([
     *     ['name'=>'jame,'gender'=>'男'],
     *     ['name'=>'Sven','gender'=>'女']
     * ]);
     * @param array $data 参数支持一维数组和二维数组，分别表示插入一条数据或多条数据。
     * @return int 返回新增的记录数
     */
    public function insert(array $data = []): int
    {
        if (isset($data[0]) && is_array($data[0])){
            // 一次新增多条数据
            $sql = $this->buildInsert(array_keys($data[0]), count($data));
            /*
             * array: 输入的 array。
             * callback:
             *      callback ( mixed $carry , mixed $item ) : mixed
             *      carry
             *      携带上次迭代的返回值； 如果本次迭代是第一次，那么这个值是 initial。
             *      item
             *      携带了本次迭代的值。
             *      initial
             *      如果指定了可选参数 initial，该参数将用作处理开始时的初始值，如果数组为空，则会作为最终结果返回。
             * 返回值：如果数组为空，并且没有指定 initial 参数，array_reduce() 返回 null。
             */
            $data = array_reduce($data, function ($carry, $item){
                return array_merge($carry, array_values($item));
            }, []);

        }else{
            // 一次新增一条数据
            $sql = $this->buildInsert(array_keys($data));
            $data = array_values($data);
        }
        echo "<pre>";
        $res = $this->db->execute($sql, $data);
        $this->resetOptions();
        return $res;
    }


    protected function buildUpdate(array $field = [])
    {
        $table = $this->table;
        // array_map() : 返回为数组中每个元素应用回调函数后的数组。
        $field = implode(',', array_map(function ($v){
            return $v.' = ?';
        }, $field));
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "UPDATE $table SET $field $where $order $limit";
    }

    /**
     * 更新数据 <br>
     * $student->where('id',5)->update([
     *  'name'=>'foo',
     *  'gender'=>'bar'
     * ]);
     * @param array $data
     * @return int 返回受影响的行数
     * @throws Exception
     */
    public function update(array $data = []): int
    {
        if (empty($this->options['where'])) throw new Exception("UPDATE 缺少 WHERE 条件！");
        $sql = $this->buildUpdate(array_keys($data));
        // 将要修改的数据和where中的数据合并
        $data = array_merge(array_values($data), $this->options['data']);
        $res = $this->db->execute($sql,$data);
        $this->resetOptions();
        return $res;
    }

    protected function buildDelete(): string
    {
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "DELETE FROM $table $where $order $limit";
    }
    /**
     * 返回受影响的行数
     */
    public function delete(): int
    {
        if (empty($this->options['where'])) throw new Exception("DELETE 缺少 WHERE 条件！");
        $res = $this->db->execute($this->buildDelete(),$this->options['data']);
        $this->resetOptions();
        return $res;
    }
}
