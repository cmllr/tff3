<?php if ($this->view['USER']->get_level() == 1): ?>
    <div class="quickadmin">
        <a href="<?php echo $this->view['PAGEROOT'] ?>admin/blog/edit/<?php echo $value['p_id'] ?>">
            <img title="Diese Seite bearbeiten" src="<?php echo $this->view['PAGEROOT'] ?>templates/resources/icons/application_edit.png" alt="Edit" />
        </a>
    </div>
<?php endif; ?>
