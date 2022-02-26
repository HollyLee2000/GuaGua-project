<?php
$this->title = '订单管理';
$this->context->layout = 'order';
$this->registerJsFile(Yii::$app->params['js_url'].'bootstrap-table.js');
use app\models\Order;
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">订单管理</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">等待接单列表
                    
                    </div>

                    <div class="panel-body">
                        <table data-toggle="table" data-url=""  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name,type" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true">订单编号</th>
                                <th data-field="userid" data-sortable="true">用户名</th>
                                <th data-field="order_time" data-sortable="true">订单生成时间</th>
                                <th data-field="pay_status">支付状态</th>
                                <th data-field="detail">订单详情</th>
                                <th data-field="total_price" data-sortable="true">订单的总价</th>
                                <th data-field="table_number" data-sortable="true">桌子编号</th>
                                <th data-field="remark" data-sortable="true">订单备注</th>
                                <th data-field="people" data-sortable="true">就餐人数</th>
                                <th data-field="delete">操作</th>
                            </tr>
                            
                            </thead>
                            <?php foreach($order as $k=>$v){?>
                                <tr>
                                    <td data-field="state" data-checkbox="true" >Item ID</td>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['wUser']['nickName']?></td>
                                    <td><?=date('Y-m-d H:i',$v['order_time'])?></td>
                                    <td><?=Order::$pay_status[$v['pay_status']]?></td>
                                    <td><?=$v['detail']?></td>
                                    <td><?='￥'.$v['total_price']?></td>
                                    <td><?=$v['table_number']?></td>
                                    <td><?=$v['remark']?></td>
                                    <td><?=$v['people']?></td>
                                    <td><a style="cursor: pointer;" data-target="#myModal1" data-toggle="modal" onclick="$('#confirm').attr('orderid','<?=$v['id']?>')">确认配送</a></td>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row--> 
</div>
        
   
   <!-- 删除模态框 -->
    <div class="modal inmodal" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog">

            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">你确定要配送吗？</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" orderid="" class="btn btn-primary" id="confirm">确定</button>
                </div>
            </div>
        </div>
    </div>
    
    

<script>
   

    $('#confirm').click(function(){
        var id = $(this).attr('orderid');
        var url = "<?=Yii::$app->urlManager->createUrl('order/ajax-confirm');?>"+"&id="+id;
        //ajax删除类型
        $.ajax({
            type : 'get',
            url : url,
            success : function(data){
                if(data =='success'){
                    //关闭模态框
                    $('#myModal').modal('hide');
                    //刷新页面
                    window.location.reload();
                }else{
                    toastr.error(data);
                }
            },

        });
    });

    
</script>

 
