<?php
    echo $html;
?>
<script>
    let router   =<?php echo json_encode(base_url())?>,
        _assets   =<?php echo json_encode(base_url()."assets/")?>,
        myCode  ='2G18';
    onload(<?php echo json_encode($pendidikan);?>);
</script>