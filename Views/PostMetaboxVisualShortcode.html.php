<?php
/**
* 
*/

// No direct access
defined('ABSPATH') or die();

?>
<div class="cb-visual-shortcode-post-metabox">

    <div class="cb-visual-shortcode-pm-visualize-block">
    
        <p><?php CBVSPlugin::_e('Click "Visualize !" Button below to make all -- Textual Shortcodes inside current post editor -- visualized') ?></p>
        <p><?php CBVSPlugin::_e('After visualize process is finished all shortcodes will be clickable, and then would be possible to edit Shortcode attributes via Web form instead of doing that manually') ?></p>
        <input id="cb-visual-shortcode-button-visualize" type="button" value="<?php CBVSPlugin::_e('Visualize Shortcodes !') ?>" />    
        
    </div>

<?php if ($viewDisplayExtensionsBlock) : ?>

    <div class="cb-visual-shortcode-pm-get-pro-block">
        <p>Download XXX</p>
    </div>
    
<?php endif; ?>

<?php ob_start() ?>

    <template   id="cb-visual-shortcode-shortcode-wrapper-template" 
                data-expression='<?php echo $visualizedShortcodesExpression; ?>'>
                
         <template>
         
            <div class="cb-visual-shortcode-wrapper mceNonEditable"><div class="cb-visual-shortcode-name">%shortcode_name%</div><div class="cb-visual-shortcode-shortcode">%shortcode%</div></div>
            
         </template>
        
    </template>

<?php
    // Filter Visualized Shortcode template
    $visualizedShortcodeTemplate = ob_get_clean();
    
    $visualizedShortcodeTemplate = CBVSPlugin::hooks()->
    visualizeShortcodeWrapperTemplate(
        $visualizedShortcodeTemplate
    );
    
    echo $visualizedShortcodeTemplate;
?>


</div>