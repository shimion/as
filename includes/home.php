<?php
global $wpdb;

//Get the slider information
$sliders = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'avartan_sliders');
?>

<!-- Display slider on home page -->
<table class="as-sliders-list as-table">
    <thead>
        <tr>
            <th colspan="5"><?php _e('Sliders List', AVARTANSLIDER_TEXTDOMAIN); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr class="as-table-header">
            <td><?php _e('Sr. No.', AVARTANSLIDER_TEXTDOMAIN); ?></td>
            <td><?php _e('Name', AVARTANSLIDER_TEXTDOMAIN); ?></td>
            <td><?php _e('Alias', AVARTANSLIDER_TEXTDOMAIN); ?></td>
            <td><?php _e('Shortcode', AVARTANSLIDER_TEXTDOMAIN); ?></td>
            <td><?php _e('Actions', AVARTANSLIDER_TEXTDOMAIN); ?></td>
        </tr>
        <?php
        if (!$sliders) {
            echo '<tr>';
            echo '<td colspan="5">';
            _e('No Sliders found.', AVARTANSLIDER_TEXTDOMAIN);
            echo '</td>';
            echo '</tr>';
        } else {
            $slider_cnt = 0;
            foreach ($sliders as $slider) {
                $slider_cnt++;
                echo '<tr>';
                echo '<td>' . $slider_cnt . '</td>';
                echo '<td><a href="?page=avartanslider&view=edit&id=' . $slider->id . '">' . $slider->name . '</a></td>';
                echo '<td>' . $slider->alias . '</td>';
                echo '<td>[avartanslider alias="' . $slider->alias . '"]</td>';
                echo '<td>
                        <a class="as-edit-slider as-button as-button as-is-success" href="?page=avartanslider&view=edit&id=' . $slider->id . '"><span class="dashicons dashicons-admin-generic mr5"></span>' . __('Settings', AVARTANSLIDER_TEXTDOMAIN) . '</a>
                        <a class="as-edit-slider as-button as-button as-is-primary" href="?page=avartanslider&view=edit&id=' . $slider->id . '#as-slides"><span class="dashicons dashicons-edit mr5"></span>' . __('Edit Slides', AVARTANSLIDER_TEXTDOMAIN) . '</a>
                        <a class="as-export-slider as-button as-button as-is-warning as-is-temp-disabled as-pro-version" href="javascript:void(0);"><span class="dashicons dashicons-share-alt2 mr5"></span>' . __('Export Slider', AVARTANSLIDER_TEXTDOMAIN) . '</a>
                        <a class="as-delete-slider as-button as-button as-is-danger" href="javascript:void(0)" data-delete="' . $slider->id . '" title="' . __('Delete Slider', AVARTANSLIDER_TEXTDOMAIN) . '"><span class="dashicons dashicons-trash"></span></a>
                        <a class="as-duplicate-slider as-button as-button as-is-secondary as-is-temp-disabled as-pro-version" href="javascript:void(0)" data-duplicate="' . $slider->id . '" title="' . __('Duplicate Slider', AVARTANSLIDER_TEXTDOMAIN) . '"><span class="dashicons dashicons-format-gallery"></span></a>
                     </td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>

<!-- Create new slider -->
<a class="as-button as-is-primary as-add-slider" href="?page=avartanslider&view=add">
    <?php _e('Create New Slider', AVARTANSLIDER_TEXTDOMAIN); ?>
</a>
<!-- Import slider block -->
<div class="as-import-wrapper">
    <a href="javascript:void(0);" class="as-button as-is-success as-call-import-slider as-is-temp-disabled as-pro-version">
        <?php _e('Import Slider', AVARTANSLIDER_TEXTDOMAIN); ?>
    </a>
</div>