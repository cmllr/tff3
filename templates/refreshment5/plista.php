<?php if ($this->view['ADDONS']['plista_id']): ?>
    <div id="plista_widget_standard_1"></div>
    <script type="text/javascript" src="<?= $this->view['ADDONS']['plista_id'] ?>"></script>
    <script type="text/javascript">

        // take care to escape quotes and line breaks
        PLISTA.items.push({
            objectid: "<?php echo $value['p_id'] ?>", //unique ID, alphanumeric
            title: "<?php echo $this->view['title'] ?>",
            text: "<?php echo $this->view['DESCRIPTION'] ?>", //up to 255 characters
            url: "<?php echo $this->view['MY_LOCATION'] ?>",
            img: "<?php echo $this->view['OGIMAGE'] ?>",
            created_at: "<?php echo $value['times'] ?>", //UNIX Timestamp
            category: "<?php echo $value['categories'][0]['title'] ?>"
        });

        PLISTA.partner.init();
    </script>

<?php endif; ?>