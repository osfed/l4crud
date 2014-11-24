<?php
    $primary_key = $raw->primary_key;
?><!-- /.row -->
@include('raw::tabs')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $raw->subtitle ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="raw-list">
                        <thead>
                            <tr>
                                <?php foreach ($raw->getFields() as $field):?>
                                    <?php if (isset($field['column']) && $field['column']):?>
                                    <th><?php echo $field['title']?></th>
                                    <?php endif;?> 
                                <?php endforeach?>
                                <th style="width:120px;" class="center"><?php echo $raw->strings['actions']?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $items = $raw->getItems();
                            //Webtools::pre($items);
                            if (!empty($items)):?>
                            <?php foreach ($items as $key=>$item):?>
                                <tr class="<?php if ($key%2==0) echo 'even'; else echo 'odd'?> gradeX">
                                    <?php foreach ($raw->getFields() as $key_field=>$field):?>
                                        <?php if (isset($field['column']) && $field['column']):?>
                                            <td><?php 
                                            if (isset($field['callback_column']))
                                            { 
                                                echo call_user_func($raw->class.'::'.$field['callback_column'],$item); 
                                            }
                                            else if (isset($raw->relations[$key_field]))
                                            {
                                                $key_relation = $raw->relations[$key_field]['relation_display'];
                                                echo $item->$key_relation;
                                            }
                                            else if ($field['type'] == 'upload')
                                            {                                                
                                                if (isset($field['preset']) && $field['preset'] == 'image')
                                                {
                                                    if ($item->$key_field!='' && file_exists(public_path().$field['upload_path'].'/'.$item->$key_field))
                                                    {
                                                        echo '<a href="#" data-toggle="modal" data-target="#image-'.md5($item->$key_field).'"><img width="100" src="'.URL::to($field['upload_path'].'/'.$item->$key_field).'" alt=""/></a>';
                                                        echo '<div class="modal fade" id="image-'.md5($item->$key_field).'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="'.URL::to($field['upload_path'].'/'.$item->$key_field).'" width="100%"/>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>';
                                                    }    
                                                }
                                                else
                                                    echo '<a href="'.URL::to($field['upload_path'].'/'.$item->$key_field).'">'.$item->$key_field.'</a>';
                                            }
                                            else 
                                                echo $item->$key_field ;
                                            ?></td> 
                                        <?php endif;?> 
                                    <?php endforeach;?>
                                    <td class="center actions">
                                        @include('raw::actions')
                                    </td>
                                </tr>
                            <?php endforeach;?>

                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#raw-list').dataTable(
            {
                <?php if ($raw->order && false):?> "aaSorting": [[ <?php ?>, "desc" ]],<?php endif;?>
                <?php if ($raw->ajax_listing):?>
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?php echo URL::to($raw->path)?>",
                "sServerMethod": "POST"
                <?php endif;?>

            });

    });
</script>