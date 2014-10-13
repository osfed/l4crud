<?php 
$value = date('Y-m-d H:i');

if (isset($raw->item->$key))
    $value = $raw->item->$key;
elseif (isset($field['default']))
{
    if ($field['default'] == 'date')
        $value = date('Y-m-d');
    else
        $value = $field['default'];
}
?>
<div class="form-group">
    <label for="field_<?php echo $key ?>"><?php echo $field['title']?></label>
    <div class='input-group date'>        
        <?php if ((isset($field['readonly']) && ($raw->getState() == 'add' || $raw->getState() == 'edit')) || $raw->getState() == 'view'):?>
        <p class="form-control-static"><?php echo $value ?></p>
        <?php else:?>
        <input name="<?php echo $key ?>" id="field_<?php echo $key ?>" type="text" class="form-control" placeholder="<?php echo $value ?>" value="<?php echo $value ?>"/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
    </div>
<?php endif;?>
</div>

            
<script type="text/javascript">
    $(function () {
        $('.date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'            
        });
    });
</script>    
