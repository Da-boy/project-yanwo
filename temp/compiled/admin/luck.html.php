<?php echo $this->fetch('pageheader.htm'); ?>
<div class="list-div">
    <table cellpadding="3" cellspacing="1" id="list-table">
        <tr>
            <!--<th>
                <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" /><a href="javascript:listTable.sort('order_sn', 'DESC'); "><?php echo $this->_var['lang']['order_sn']; ?></a><?php echo $this->_var['sort_order_sn']; ?>
            </th>
            <th><a href="javascript:listTable.sort('add_time', 'DESC'); "><?php echo $this->_var['lang']['order_time']; ?></a><?php echo $this->_var['sort_order_time']; ?></th>
            <th><a href="javascript:listTable.sort('consignee', 'DESC'); "><?php echo $this->_var['lang']['consignee']; ?></a><?php echo $this->_var['sort_consignee']; ?></th>
            <th><a href="javascript:listTable.sort('total_fee', 'DESC'); "><?php echo $this->_var['lang']['total_fee']; ?></a><?php echo $this->_var['sort_total_fee']; ?></th>
            <th><a href="javascript:listTable.sort('order_amount', 'DESC'); "><?php echo $this->_var['lang']['order_amount']; ?></a><?php echo $this->_var['sort_order_amount']; ?></th>
            <th><?php echo $this->_var['lang']['all_status']; ?></th>
            <th><?php echo $this->_var['lang']['handler']; ?></th>-->
            <th>id</th>
            <th>姓名</th>
            <th>电话</th>
            <th>地址</th>
        </tr>
        <?php $_from = $this->_var['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'values');if (count($_from)):
    foreach ($_from AS $this->_var['values']):
?>
        <tr>
            <?php $_from = $this->_var['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
            <td align="center">
                <?php echo $this->_var['value']; ?>
            </td>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </tr>


        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
</div>
</body>
</html>