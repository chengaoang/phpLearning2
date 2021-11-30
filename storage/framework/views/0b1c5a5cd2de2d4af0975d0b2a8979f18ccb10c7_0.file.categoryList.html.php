<?php
/* Smarty version 3.1.39, created on 2021-05-29 21:07:48
  from 'C:\My_php\phpLearning2\resources\views\admin\categoryList.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b23ca493d137_37918319',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0b1c5a5cd2de2d4af0975d0b2a8979f18ccb10c7' => 
    array (
      0 => 'C:\\My_php\\phpLearning2\\resources\\views\\admin\\categoryList.html',
      1 => 1622293510,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b23ca493d137_37918319 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="bg-dark" style="margin-top: 30px">
    <!-- table 参考于：https://getbootstrap.com/docs/5.0/content/tables/#accented-tables -->
    <table class="table table-striped table-dark table-hover">
        <thead>
        <tr>
            <th scope="col">栏目名称</th>
            <th scope="col">排序值</th>
            <th scope="col">操作</th>
            <th scope="col">拖动以排序</th>
        </tr>
        </thead>
        <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
            <tr id="ROW">
                <td hidden id="ID"><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
                <td>
                    <textarea id="name" class="input-group text-white" style="background:rgba(0, 0, 0, 0);" rows="1" type="text"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</textarea>
                </td>
                <td id="sort"><?php echo $_smarty_tpl->tpl_vars['item']->value['sort'];?>
</td>
                <td>
<!--                    <a href="#">编辑</a>-->
                    <div href="/admin/Category/delete?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" draggable="true" class="text-danger" id="del">删除</div>
                </td>
                <td draggable="true">
                    <img class="" src="/static/images/drag.svg" alt="托我">
                </td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        <tr id="hiddenRow" hidden>
            <td>
                <textarea id="name" class="input-group text-white" style="background:rgba(0, 0, 0, 0);" rows="1" type="text"></textarea>
            </td>
            <td id="sort"><?php echo $_smarty_tpl->tpl_vars['item']->value['sort']+1;?>
</td>
            <td>
                <!--                    <a href="#">编辑</a>-->
<!--                <a href="#" class="text-danger">删除</a>-->
            </td>
            <td draggable="true">
                <img class="" src="/static/images/drag.svg" alt="托我">
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <a id="addBtn" class="btn text-danger">添加栏目</a> <!-- 用js新增一行 -->
            </td>
        </tr>

        </tbody>
    </table>
    <button id="saveBtn" class="btn btn-dark bg-primary">保存修改</button>
</div>

<?php }
}
